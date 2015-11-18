<?php

	/* Database config data*/
	$GLOBALS = array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'db'        => 'lr'
    );

class DBconfig {
    protected $glob;

    public function __construct() {
        global $GLOBALS;
        $this->glob =& $GLOBALS;
    }

    public function host() {
        return $this->glob['host'];
    }
	public function username() {
        return $this->glob['username'];
    }
	public function pwd() {
        return $this->glob['password'];
    }
	public function db() {
        return $this->glob['db'];
    }
}

?> 