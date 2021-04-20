<?php
include_once("user.php");
include_once("userModel.php");
//not to be included in live version
class userTests extends PHPUnit\Framework\TestCase {
	//test gettingf a processed email
	public function testgetUserProccessed(){
		$model= new userModel(null,null,"root","");
		$email="ausergmail.com";
		$User=$model->getUserByProccesedEmail($email);
		$this->assertEquals($email,$User->email);
	}
	//test that eamils will be processed
	public function testProcessEmail(){
		$model= new userModel(null,null,"root","");
		$email="auser@gmail.com";
		$newEmail=$model->processEmail($email);
		$this->assertEquals("ausergmail.com",$newEmail);
	}
	
	//test the password checker
	public function testCheckPassword(){
		$model= new userModel(null,null,"root","");
		$name="auser@gmail.com";
		$pass="auser1";
		$newEmail=$model->checkPassword($pass, $name);
		$this->assertEquals(false,$newEmail);
		$name="testemail@aston.ac.uk";
		$pass="TestPassword1!";
		$newEmail=$model->checkPassword($pass, $name);
		$this->assertEquals(true,$newEmail);
	}
	

}