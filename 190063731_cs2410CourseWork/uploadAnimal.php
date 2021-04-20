<?php
include_once("addAnimal.php");

include_once("models/AModel.php");
include_once("models/userModel.php");

	//ADD an animal to the database
		if (isset($_POST["add"])) {
			 if (hash_equals($_SESSION['token'], $_POST['token'])) {
		$animalModel= new AModel(null,null,"root","");	
	
		$idNumber=$animalModel->addAnimal(filter_var($_POST['name'], FILTER_SANITIZE_STRING),
		filter_var($_POST['breed'], FILTER_SANITIZE_STRING),
		filter_var($_POST['description'], FILTER_SANITIZE_STRING),
		$_POST['birth']
		,1,filter_var($_POST['species'], FILTER_SANITIZE_STRING));
		echo "<p>Animal Added:  ID: $idNumber<p>";
		}
		}
		?>