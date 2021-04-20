<!DOCTYPE html>
<html lang="EN">
<?php
include_once("models/userModel.php");
include_once("signup.html");
session_start();
?>
<?php
		if (isset($_POST["addUser"])) {
		//echo"started";/[a-z]/
		if(preg_match("/(?=.*[A-Z])(?=.*[a-z]).{4,20}/", $_REQUEST['pass'])){
		$userModel= new UserModel(null,null,"root","");	
		$email=filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING);
		$emailFinal=$userModel->processEmail($email);
		$name=filter_var($_REQUEST['Name'], FILTER_SANITIZE_STRING);
		if($userModel->addUser($emailFinal,password_hash($_REQUEST['pass'], PASSWORD_DEFAULT),$name,0))
		$ProcessEmail=$userModel->processEmail($email);	 
		 $_SESSION['login'] = $ProcessEmail; //write login to server storage
				 
					$url='allAnimals.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		}else{
			echo "password is not strong enough must contain: UpperCase Letter, Lowercase Letter, and be 4-20 characters long"; 
			
		}}else{
			
			echo "error";
		}
	
	?>