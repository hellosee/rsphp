<?php
class Start {
    public static function init($_route = "") {
        spl_autoload_register(array('Start','autoload'));
        $router = new Router($_route);
        $router->parseUrls();
        /*
        $c = $GLOBALS['c'] = v('c') ? v('c') : c('default_controller');
        $a = $GLOBALS['a'] = v('a') ? v('a') : c('default_action');
        $c = basename(ucfirst( z($c) ));
        $a =  basename( z($a) );
        $cName = $c .'Controller' ; 
        $cP = A_C_PATH . $cName . EXT;
        if( !file_exists( $cP ) ) {
            $cP = C_PATH . $cName . EXT;
            if( !file_exists( $cP ) ) die('Can\'t find controller file - ' . $cName . EXT );
        } 
        require_once( $cP );
        if( !class_exists( $cName ) ) die('Can\'t find class - '   .  $cName );
        $o = new $cName;
        if( !method_exists( $o , $a ) ) die('Can\'t find method - '   . $a . ' ');
        call_user_func( array( $o , $a ) ); 
         * */
     }

     public static function autoload($class) {
        spl_autoload($class);
     }
}
