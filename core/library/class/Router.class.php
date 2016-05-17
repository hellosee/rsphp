<?php
/**
 * 路由调度
 *
 * @author jacikelee
 */
class Router {
    protected $_c;
    protected $_a;
    protected $_v;
    protected $_r;
    protected  $_u;
    public function __construct($_route = "") {
        $this->_r = $_route;
        $this->_c = $GLOBALS['config']['default_controller'];
        $this->_a = $GLOBALS['config']['default_action'];
        $this->_v = false;//初始化视图，默认不显示
    }
    
    public function parseUrls(){
      if($GLOBALS['config']['url_model']){
          if(isset($this->_r)){
            $preg_url = '~^(([\w]+)(\/)*)+~';//controller/action/key/value/key/value...
            $matches = array();
            if(empty($this->_r)){
                $this->_c = $GLOBALS['c'] = $GLOBALS['config']['default_controller'];
                $this->_a = $GLOBALS['a'] = $GLOBALS['config']['default_action'];
            } else if(preg_match($preg_url, $this->_r,$matches)){
                $this->_u = $matches[0];
                $ca = explode('/', $this->_u);
                $this->_c = $GLOBALS['c'] = $ca[0];
                $this->_a = $GLOBALS['a'] = isset($ca[1]) ? $ca[1] : $GLOBALS['config']['default_action'];
                $query = array();
                preg_replace_callback('~(\w+)\/([^\/]+)~', 
                      function($match) use(&$query){
                        $query[$match[1]]=strip_tags($match[2]);
                      }, 
                      implode('/',explode('/',trim($_SERVER['PATH_INFO'],'/')
                    )
                  )
                );
                $_GET   =  array_merge($query,$_GET);
            }
          }
      } else {
          $this->_c = $GLOBALS['c'] = v('c') ? v('c') : c('default_controller');
          $this->_a = $GLOBALS['a'] = v('a') ? v('a') : c('default_action');
      }
      $_REQUEST = array_merge($_POST,$_GET,$_COOKIE);
      
      
      $this->_c = basename(ucfirst( z($this->_c) ));
      $this->_a =  basename( z($this->_a) );
      $cName = $this->_c .'Controller' ; 
      $cP = A_C_PATH . $cName . EXT;
      if( !file_exists( $cP ) ) {
          $cP = C_PATH . $cName . EXT;
          if( !file_exists( $cP ) ) die('Can\'t find controller file - ' . $cName . EXT );
      } 
      require_once( $cP );
      if( !class_exists( $cName ) ) die('Can\'t find class - '   .  $cName );
      $o = new $cName;
      if( !method_exists( $o , $this->_a ) ) die('Can\'t find method - '   . $this->_a . ' ');
      call_user_func( array( $o , $this->_a ) ); 
    }

}
