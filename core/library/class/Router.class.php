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
    protected $_p;
    protected $_r;
    protected  $_u;
    public function __construct($_route = "") {
        $this->_r = $_route;
        $this->_c = $GLOBALS['config']['default_controller'];
        $this->_a = $GLOBALS['config']['default_action'];
        $this->_p = array();
        $this->_v = false;//初始化视图，默认不显示
    }
    
    private function parseUrls(){
        if(isset($this->_r)){
            $preg_url = '~^(([\w]+)(\/)*)+~';//controller/action/key/value/key/value...
            $matches = array();
            if(empty($this->_r)){
                $this->_c = $GLOBALS['config']['default_controller'];
                $this->_a = $GLOBALS['config']['default_action'];
            } else if(preg_match($preg_url, $this->_r,$matches)){
                $this->_u = $matches[0];
                $ca = explode('/', $this->_u);
                $this->_c = $ca[0];
                $this->_a = isset($ca[1]) ? $ca[1] : $GLOBALS['config']['default_action'];
                
                var_dump($ca);
                
                
                
            }
            
        }
        $this->setParams($_SERVER['REQUEST_METHOD']);

    }
    
    private function setParams($method){
        switch(strtoupper($method)){
            case 'GET':
                $this->_p = array_merge($this->_p,$_GET);
                break;
            case 'POST':
            case 'PUT':
            case 'DELETE':
                if(array_key_exists('HTTP_X_FILE_NAME', $_SERVER)){
                    if($method == "POST"){
                        $this->_p = array_merge($this->_params, $_POST);
                    } else {
                        $p = array();
                        $content = file_get_contents("php://input");
                        parse_str($content,$p);
                        $p = json_decode($content, true);
                        $this->_p = array_merge($this->_p,$p);
                    }
                }
                break;
                 
        }
    }
    
    public function dispatch(){
        $this->parseUrls();
    }
    
    
    
}
