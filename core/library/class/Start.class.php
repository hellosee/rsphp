<?php
/**
 * Description of start
 *
 * @author Administrator
 */
class Start {
    // 类映射
    private static $_map      = array();
    /**
     * 应用程序初始化
     * @access public
     * @return void
     */
    static public function init() {
        // 注册AUTOLOAD方法
        spl_autoload_register(array('Start','autoload'));
    }
    /**
     * 类库自动加载
     * @param string $class 对象类名
     * @return void
     */
    public static function autoload($class) {
        echo $class;
        /*
         *   查找包含内置库文件
         */
        $
        /*
        // 检查是否存在映射
        if(isset(self::$_map[$class])) {
            include self::$_map[$class];
        }elseif(false !== strpos($class,'\\')){
          $name           =   strstr($class, '\\', true);
          if(in_array($name,array('Think','Org','Behavior','Com','Vendor')) || is_dir(LIB_PATH.$name)){ 
              // Library目录下面的命名空间自动定位
              $path       =   LIB_PATH;
          }else{
              // 检测自定义命名空间 否则就以模块为命名空间
              $namespace  =   C('AUTOLOAD_NAMESPACE');
              $path       =   isset($namespace[$name])? dirname($namespace[$name]).'/' : APP_PATH;
          }
          $filename       =   $path . str_replace('\\', '/', $class) . EXT;
          if(is_file($filename)) {
              // Win环境下面严格区分大小写
              if (IS_WIN && false === strpos(str_replace('/', '\\', realpath($filename)), $class . EXT)){
                  return ;
              }
              include $filename;
          }
        }elseif (!C('APP_USE_NAMESPACE')) {
            // 自动加载的类库层
            foreach(explode(',',C('APP_AUTOLOAD_LAYER')) as $layer){
                if(substr($class,-strlen($layer))==$layer){
                    if(require_cache(MODULE_PATH.$layer.'/'.$class.EXT)) {
                        return ;
                    }
                }            
            }
            // 根据自动加载路径设置进行尝试搜索
            foreach (explode(',',C('APP_AUTOLOAD_PATH')) as $path){
                if(import($path.'.'.$class))
                    // 如果加载类成功则返回
                    return ;
            }
        }
         * 
         */
    }
}
