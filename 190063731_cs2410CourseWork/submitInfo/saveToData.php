<!DOCTYPE html>
<html lang="EN">
<?php
include_once("addAnimal.php");

?>
<?php
		if (isset($_POST["add"])) {
		$animalModel= new AModel(null,null,"root","");	
	
		$animalModel->addAnimal($_POST['name'],$_POST['breed'],$_POST['description'],$_POST['birth'],1);
		}
	
	?>