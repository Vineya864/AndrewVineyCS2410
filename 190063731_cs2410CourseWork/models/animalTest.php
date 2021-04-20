<?php

include_once("AModel.php");
include_once("views/animalView.php");
//not to be included in live version
class animalTest extends PHPUnit\Framework\TestCase {
	
	public function testgetAnimalById(){
		$model= new AModel(null,null,"root","");
		$animal=$model->getAnimalById(1);
		$this->assertEquals("DOG",$animal->breed);
	}
	
	  public function testSearchName() {
		$model= new AModel(null,null,"root","");
		$animal=$model->SearchName("gra");
		$this->assertEquals("Grace",$animal->name);
	  }
	

}