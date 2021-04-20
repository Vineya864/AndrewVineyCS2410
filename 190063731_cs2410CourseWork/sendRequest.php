<?php
session_start();

include_once("models/AModel.php");
include_once("models/userModel.php");
include_once("models/requestModel.php");
	if (isset($_POST["adopt"])) {

		
	if (hash_equals($_SESSION['token'], $_POST['token'])) {
		
		
		
		
		
		echo "send";
		$animalId=$_GET['id'];
		echo $animalId;
		$userModel= new UserModel(null,null,"root","");
		$user=$userModel->getUserByProccesedEmail($_SESSION['login']);
		$modelR= new RequestModel(null,null,"root","");
		$modelR->createRequest($user->id,$animalId);
			$url='AccountPage.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		}else{
			echo "timed out";
		}
	}else{
		$url='AccountPage.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		
	}
	
	


?>