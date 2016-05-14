<?php
class Log {
	/**
	 * 记录文本日志，如果根目录有 logs 目录才会记录
	 *
	 * @param  $logs_type 日志类型，日志文件名称
	 * @param  $logs_txt 日志内容
	 */
	public static function logs($logs_txt = "",$logs_type = "", $level = "INFO" ) {
		$log_dir = $GLOBALS['config']['log_path'];
		try {
			// 创建缓存目录
			if(!file_exists($log_dir)) {self::mkDirs($log_dir);}
			if($logs_type != ""){
				$log_path = $log_dir . $logs_type . '_' . date('Y_m_d') . '.log';
			} else {
				$log_path = $log_dir . date('Y_m_d') . '.log';
			}
			$fp = fopen($log_dir . $logs_type . '_' . date('Y_m_d') . '.log', 'a');
			fwrite($fp, date('Y-m-d H:i:s') . ' ' . self::getip() . ' ' . $logs_txt . ' ' . chr(10));
			fclose($fp);
		}
		catch(Exception $e) {
			echo($e -> getMessage());
		}
	}
	public static function mkDirs($dir) {

		if(!is_dir($dir)){
			if(!self::mkDirs(dirname($dir))){
				return false;
			}
			if(!mkdir($dir,0777)){
				return false;
			}
		}
		return true;

    }
	/**
	 * 获取客户端IP地址
	 */
	public static function getip() {
		$onlineip = '';
		if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$onlineip = getenv('HTTP_CLIENT_IP');
		} elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$onlineip = getenv('REMOTE_ADDR');
		} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$onlineip = $_SERVER['REMOTE_ADDR'];
		}
		if(!@ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$",$onlineip)) {
			return "";
		}else{
			return addslashes(htmlspecialchars($onlineip));
		}
	}
}