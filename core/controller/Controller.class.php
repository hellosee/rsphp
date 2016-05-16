<?php

class Controller extends Html {
    public function index(){
      //控制器初始化
      if(method_exists($this,'_initialize'))
          $this->_initialize();
    }
 
}
