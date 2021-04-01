<!DOCTYPE html>
<html lang="EN">
<?php
include_once("models/userModel.php");
include_once("signup.html");
session_start();
?>
<?php
		if (isset($_POST["addUser"])) {
		echo"started";
		$userModel= new UserModel(null,null,"root","");	
		$email=filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING);
		$emailProcessed=explode (  "@" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .=$emailProcessed[1];
		$name=filter_var($_REQUEST['Name'], FILTER_SANITIZE_STRING);
		if($userModel->addUser($emailFinal,password_hash($_REQUEST['pass'], PASSWORD_DEFAULT),$name,0))
			 $_SESSION['login'] = $email; //write login to server storage
				 
					$url='AccountPage.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		}else{
			
			echo "error";
		}
	
	?>