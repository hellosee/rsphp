<?php
class Html {
    private $_data = array();
    public function assign($name = "",$value = array()){
      $this->_data[$name] = $value;
    }
    public function __set($name,$value) {
        $this->assign($name,$value);
    }
    /**
     * 取得模板显示变量的值
     * @access protected
     * @param string $name 模板显示变量
     * @return mixed
     */
    public function get($name='') {
        return $this->_data[$name];      
    }

    public function __get($name) {
        return $this->_data[$name]; 
    }
    
    /**
     * 检测模板变量的值
     * @access public
     * @param string $name 名称
     * @return boolean
     */
    public function __isset($name) {
        return $this->get($name);
    }
    /**
     * 魔术方法 有不存在的操作的时候执行
     * @access public
     * @param string $method 方法名
     * @param array $args 参数
     * @return mixed
     */
    public function __call($method,$args) {
        if( 0 === strcasecmp($method,ACTION_NAME.C('ACTION_SUFFIX'))) {
            if(method_exists($this,'_empty')) {
                // 如果定义了_empty操作 则调用
                $this->_empty($method,$args);
            } else {
                die($method." not found");
            }
        }else{
            E(__CLASS__.':'.$method.L('_METHOD_NOT_EXIST_'));
            return;
        }
    }
    /**
      * 调用模板,$file 为当前主程序的文件名，需要根据文件名去找对应目录的模板文件,$app_dir 应用目录名称
      * @param $file 主程序文件
      * @param $app_dir 主程序所在APP目录名
      * @param $tpl_prefix 模板前缀
      * @param $is_die 是否中止页面执行（一般模板内的模板引用会中止）
      * @param $skin_user 不读取默认皮肤，指定皮肤
      */
     function display($file='index') {
         if(!defined('CORE_PATH')) die("Access Denied");//防止直接访问模板页面
         //指定模板
         $tpl_file = APP_PATH.'view'.DS.$GLOBALS['c'].DS.$file.$GLOBALS['config']['tpl_ext'];
         if(!file_exists($tpl_file)){
            $tpl_file = CORE_PATH.'view'.DS.$GLOBALS['c'].DS.$file.$GLOBALS['config']['tpl_ext'];
            if( !file_exists( $tpl_file ) ) {
                die('The tpl file does not exist : '.$tpl_file.'<br>');
            }
         }
         if(isset($this->_data) && !empty($this->_data)){
            foreach($this->_data as $_k => $_v){
                $$_k = $_v;
            }
          }
         include $tpl_file;
         unset($this->_data);
     }
}
