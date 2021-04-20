<?php


class Animal {
	private $id;
	private $name;
	private $breed;
	private $description;
	private $birth;
	private $availability;
	
	public function __construct($a,$b,$c,$d,$e,$f){
		$this->id = $a;
		$this->name = $b;
		$this->breed =$c;
		$this->description=$d;
		$this->birth=$e;
		$this->availability=$f;
		
	
	}
  
	public function __get($var){	
	return $this->$var;
	}

  public function __set($var, $value){
		$this->$var = $value;
	}

	
	
	
}


?>