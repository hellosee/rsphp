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
			fwrite($fp, date('Y-m-d H:i:s') . ' ' . getip() . ' ' . $logs_txt . ' ' . chr(10));
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
}