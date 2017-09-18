<?php

class db{
	function __construct(){
		$this ->mysqli = new mysqli('localhost','root','','test');

				if ($this->mysqli->connect_errno) {
				die('Connect_errno('.$this ->mysqli->connect_errno. ')'.$this->mysqli->connect_errno);
		}
		$this->query("SET MAMES UTF8");
	}
    function query($sql){
    	return $this->mysqli->query($sql);
    }
}
?>