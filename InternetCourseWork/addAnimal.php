<!DOCTYPE html>
<html lang="EN">
<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
include_once("models/AModel.php");
include_once("models/userModel.php");
 
?>
<head>
	<meta charset ="UTF-8"/>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	
	<link href="css/dashboard.css" rel="stylesheet" />
<link href="css/animal.css" rel="stylesheet" />
	<script src="components/Navbar.js" type="text/javascript" defer></script>
	<script src="components/footer.js" type="text/javascript" defer></script>
		</script>
	<title> Animal
	</title>
</head>
<body>
	<header-component></header-component>
	<main>
	<?php
	if (session_id() == '' || !isset($_SESSION['login'])){
			$url='login.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	}else{
		
	$email = $_SESSION['login'] ;
	$model= new UserModel(null,null,"root","");
	$user=$model->getUserByEmail($email);
	if($user->type){
		?>
		<section id="animal-creation">
	<h1>Add Animal</h1>
		<form method="post" action="">
		
		<label for= "name"> Name </label>
		<input type="text" name="name"
			placeholder="animal name"
			required 
			/>
			<br/><br/>
	<label for= "breed"> breed </label>
		<input type="text" name="breed"
			placeholder="animal breed"
			required 
			/><br/><br/>
			<label for= "description"> Description </label>
		<input type="text" name="description"
			placeholder="animal description"
			/><br/><br/>
			<label for= "birth">Date of Birth </label>
		<input type="date" name="birth"
			required 
			/><br/><br/>
			
		   <input type="hidden" name="token" value="<?php echo $token; ?>" />
		<input type="submit" name="add" value="Add"/>
		</form>
		<?php
		if (isset($_POST["add"])) {
			 if (hash_equals($_SESSION['token'], $_POST['token'])) {
		$animalModel= new AModel(null,null,"root","");	
	
		$animalModel->addAnimal(filter_var($_POST['name'], FILTER_SANITIZE_STRING),
		filter_var($_POST['breed'], FILTER_SANITIZE_STRING),
		filter_var($_POST['description'], FILTER_SANITIZE_STRING),
		filter_var($_POST['birth'], FILTER_SANITIZE_STRING)
		,1);
		}
		}
		?>
	</section>
	<br/></br>
	<section id="upload">
	<form action="upload.php" method="post" enctype="multipart/form-data">
  <h2>Upload an image</h2> </br>

  <input type="text" name="name"
			placeholder="animal name"
			required 
			/></br></br>
	<input type="Number" name="ID"
	placeholder="animal ID"
	required 
			/></br></br>
			  <input type="file" name="fileToUpload" id="fileToUpload" required></br></br>
			    <input type="hidden" name="token" value="<?php echo $token; ?>" />
  <input type="submit" value="Upload Image" name="submit">
</form>
	
		<?php
	}
	}
	?>



</main>
	 <section class="page-footer">
		<footer-component></footer-component>
		</section>
	

</body>
</html>



