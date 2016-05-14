<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Html
 *
 * @author Administrator
 */
class Html {
    private $_data = array();
    public function assign($_k = "",$data = array()){
      $this->_data[$_k] = $data;
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
