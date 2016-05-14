<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}
define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH',dirname(__FILE__).DS);
define('CORE_PATH', dirname(APP_PATH) . DS . 'core' . DS);
require(CORE_PATH.'init.php');

