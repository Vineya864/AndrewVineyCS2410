<?php
include_once("addAnimal.php");
$location ="pictures/";

$target_file=$location.basename($_FILES["fileToUpload"]["name"]);
$success=1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
	 if (hash_equals($_SESSION['token'], $_POST['token'])) {
	if($fileType !="jpg"){
		$success=0;
	}




if ($success == 0) {
  echo "Sorry, your file was not uploaded. Make sure it is in type .jpg";

} else {
	$temp = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = filter_var($_POST['name'], FILTER_SANITIZE_STRING).filter_var($_POST['ID'], FILTER_SANITIZE_STRING).'.'.end($temp);

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "pictures/".$newfilename)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

}
}
?>

