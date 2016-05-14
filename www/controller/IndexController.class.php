<?php
class IndexController extends Controller {

    public function index(){
        $db = new Db();
        Log::logs('index', 'hello');
        $a = 'hahahaha lishoujie';
        $this->assign('b', $a);
        $this->display('index');
        echo $a;
    }
    
    public function aa(){
      echo 'yes bb,aa';
      $this->coreindex();
    }
}
