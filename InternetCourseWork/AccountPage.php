<!DOCTYPE html>
<html lang="EN">
<?php
session_start();
include_once("models/userModel.php");
 if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
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
	<section id="User">
	<?php
	

	if (session_id() == '' || !isset($_SESSION['login'])){
			$url='login.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	}else{
	$email = $_SESSION['login'] ;
	
	$model= new UserModel(null,null,"root","");
	$user=$model->getUserByProccesedEmail($email);
	if ($user==null){
		$user=$model->getUserByEmail($email);
		$model->displayUser($email);
	}else{
	$model->displayUserProccesed($email);
	}
	if($user->type){
		?>
		<form method="post" action="">
	<input type="submit" name="manageRequest" value="Manage Adoption Requests"/></br></br>
	<input type="submit" name="addAnimal" value="Add Animal or Animal Photo"/></br></br>
	
		<?php
	}else{
		?>
		<form method="post" action="myRequests.php">
	<input type="hidden" name="ID" value="<?php echo $user->id ?>"/>
	 <input type="hidden" name="token" value="<?php echo $token; ?>" />
	<input type="submit" name="seeRequest" value="See Your Adoption Requests"/></br></br>
	</form>
	<?php
	}
	?>
	<form method="post" action="">
	<input type="submit" name="logout" value="Log Out"/>
	</form>
	<?php
	
	if (isset($_POST["logout"])) {
		session_unset();
		

// destroy the session
	session_destroy();
	
		header('Location: ./index.php',true,301); 
					exit();
	}
	}
	
	
	?>
	
	
		<?php
		if (isset($_POST["addAnimal"])) {
					$url='addAnimal.php';				
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
					//header('Location: ./index.php',true,301); 
					//exit();
			
		}
	
	?>
	</br></br></br></br>
	
	</section>
	</main>
	 <section class="page-footer">
		<footer-component></footer-component>
		</section>
	

</body>
</html>