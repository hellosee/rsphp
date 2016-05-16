<?php
class IndexController extends Controller {

    public function index(){
        $db = new Db();
        $db->abc();
        $this->assign('user', array('a'=>'111','b'=>'2222'));
        Log::logs('index', 'hello');
        $this->display('index');
    }
    
    public function aa(){
      echo 'yes bb,aa';
      $this->coreindex();
    }
}
