<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BbController
 *
 * @author Administrator
 */
class BbController extends Controller {

    public function index(){
        $db = new Db();
        $a = 'hahahaha lishoujie';
        $this->assign('b', $a);
        $this->assign('a','xxxx');
        $this->display('index');
        echo $a;
    }
    
    public function aa(){
      echo 'yes bb,aa';
      $this->coreindex();
    }
}
