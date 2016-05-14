<?php
error_reporting(E_ALL^E_NOTICE);
ini_set( 'display_errors' , true );
// 版本信息
const VERSION     =   '1.0.0';
// 类文件后缀
const EXT = '.class.php'; 
/*
 * 常量定义
 */
defined('LIB_PATH') or define('LIB_PATH',  CORE_PATH.'library/class/');//框架核心类库目录 
defined('C_PATH') or define('C_PATH',  CORE_PATH.'controller/');//框架核心类库目录 
defined('M_PATH') or define('M_PATH',  CORE_PATH.'model/');//框架核心类库目录 
defined('A_C_PATH') or define('A_C_PATH',  APP_PATH.'controller/');//框架核心类库目录 
defined('A_M_PATH') or define('A_M_PATH',  APP_PATH.'model/');//框架核心类库目录 
defined('A_L_PATH') or define('A_L_PATH',  APP_PATH.'library/');//框架核心类库目录
defined('CONFIG_PATH') or define('CONFIG_PATH',  CORE_PATH.'config/');//框架核心类库目录
defined('A_CONFIG_PATH') or define('A_CONFIG_PATH',  APP_PATH.'config/');//框架核心配置目录
defined('F_PATH') or define('F_PATH',  CORE_PATH.'function/');//APP配置目录
defined('A_F_PATH') or define('A_F_PATH',  APP_PATH.'function/');//APP配置目录
//引入配置文件
include_once( CONFIG_PATH . 'config.php' );
if( file_exists( A_CONFIG_PATH . 'config.php' ) ){
	include_once( A_CONFIG_PATH . 'config.php' );
} 
//引入方法名
include_once( F_PATH . 'functions.php' );
if( file_exists( A_F_PATH . 'functions.php' ) ){
	include_once( A_F_PATH . 'functions.php' );
} 
//自动加载库文件目录
set_include_path(get_include_path().PATH_SEPARATOR.LIB_PATH.'db/');
set_include_path(get_include_path().PATH_SEPARATOR.C_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.M_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.A_C_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.A_M_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.A_L_PATH);

spl_autoload_extensions(EXT);

require_once LIB_PATH.'Start'.EXT;

Start::init();
