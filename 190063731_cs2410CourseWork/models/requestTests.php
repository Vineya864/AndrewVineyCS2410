<?php

include_once("requestModel.php");
//not to be included in live version
class requestTests extends PHPUnit\Framework\TestCase {
	
	public function testgetRequestById(){
		$model= new requestModel(null,null,"root","");
		$request=$model->getRequestById(9);
		$this->assertEquals(54,$request->userId);
	}
	
	
	
	public function testgetRequestByUserID(){
		$model= new requestModel(null,null,"root","");
		$request=$model->getRequestByUserID(54);
		$this->assertEquals(9,$request->id);
	}

}