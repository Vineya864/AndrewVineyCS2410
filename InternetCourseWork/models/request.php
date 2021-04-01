<?php

class Request {
	private $id;
	private $userId;
	
	private $animalId;
	private $approved;
	
	public function __construct($a,$b,$c,$d){
		$this->id = $a;
		$this->userId=$b;
	
		$this->animalId=$c;
		$this->approved=$d;
		
	
	}
  
	public function __get($var){	
	return $this->$var;
	}

  public function __set($var, $value){
		$this->$var = $value;
	}
}

	
	
	