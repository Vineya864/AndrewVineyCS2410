<?php


include_once("models/UserModel.php");



class User {
	private $id;
	private $email;
	
	private $name;
	private $type;
	
	public function __construct($a,$b,$c,$d){
		$this->id = $a;
		$this->email = $b;
	
		$this->name=$c;
		$this->type=$d;
		
	
	}
  
	public function __get($var){	
	return $this->$var;
	}

  public function __set($var, $value){
		$this->$var = $value;
	}

	
	
	
}


?>