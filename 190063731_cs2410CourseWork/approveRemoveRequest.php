<?php

include_once("ManageRequests.php");
include_once("models/userModel.php");
include_once("models/requestModel.php");
if(isset($_POST["ApprovedRequest"])) {
	//if(isset($_POST['token'])){
	if (hash_equals($_SESSION['token'], $_POST['token'])) {
	$model= new UserModel(null,null,"root","");
	$user=$model->getUserByProccesedEmail($email);
	 if($user->type){
	 
	 $requestModel= new RequestModel(null,null,"root","");
	 $request=$requestModel->approveRequest($_POST['RequestId']);
	$animal=new AModel(null,null,"root","");
	if($request){
	$animal->adoptAnimal($request->animalId);
	 echo "successfull";
	}else{
		echo "animal Is Already Adopted";
	}
	
	 }else{
		 
		 echo "You Dont Have Access To This Feature";
	 }

	}
	}
	
	if(isset($_POST["RefuseRequest"])) {
	//if(isset($_POST['token'])){
	if (hash_equals($_SESSION['token'], $_POST['token'])) {
	$model= new UserModel(null,null,"root","");
	$user=$model->getUserByProccesedEmail($email);
	 if($user->type){
	 
	 $requestModel= new RequestModel(null,null,"root","");
	 $requestModel->rejectRequest($_POST['RequestId']);
	
	 echo "successfull";
	 
	 }else{
		 
		 echo "You Dont Have Access To This Feature";
	 }
	}
	}
	
	
	
	
	
	
?>