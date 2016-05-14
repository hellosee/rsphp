<?php
class Db extends Ezpdo {
    public function __construct($dsn = '', $user = '', $password = '', $ssl = array()) {
      parent::__construct($dsn, $user, $password, $ssl);
    }
	public function test(){
		echo 'test';
	}
}