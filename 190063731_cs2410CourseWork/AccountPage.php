<!DOCTYPE html>
<html lang="EN">
<?php
session_start();
include_once("models/userModel.php");
include_once("views/userView.php");
 if (empty($_SESSION['token'])) {//create token
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
?>
<head>
	<meta charset ="UTF-8"/>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	
	<link href="css/dashboard.css" rel="stylesheet" />

	<script src="components/header.js" type="text/javascript" defer></script>
	<script src="components/footer.js" type="text/javascript" defer></script>
		</script>
	<title> Aston animal sanctuary
	</title>
</head>

<body>
	<header-component></header-component>
	<main>
	<section id="User">
	<?php
	

	if (session_id() == '' || !isset($_SESSION['login'])){//prove origin
			$url='login.php';//re direct to log in
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	}else{
	$email = $_SESSION['login'] ;//get user email
	
	$model= new UserModel(null,null,"root","");
	$user=$model->getUserByProccesedEmail($email);
	if ($user==null){//if ne user convert to an email we can use
		$email=$model->processEmail($email);
		$user=$model->getUserByProccesedEmail($email);
		$view= new UserView();
		$view->displayUserProccesed($user);
	}else{//if old just show information
		
		$view= new UserView();
		$user=$model->getUserByProccesedEmail($email);
		$view->displayUserProccesed($user);
	}
	if($user->type){//if type is true show admin page
		?>
		<form method="post" action="manageRequests.php">
			<input type="hidden" name="ID" value="<?php echo $user->id ?>"/>
	 <input type="hidden" name="token" value="<?php echo $token; ?>" />
	<input type="submit" name="manageRequest" value="Manage Pending Adoption Requests"/></br></br>
	
	</form>
		<a href="addAnimal.php"><button>Add A New Animal </button></a></br></br>
	
	<form method="post" action="AllRecordedRequests.php">
	<input type="hidden" name="ID" value="<?php echo $user->id ?>"/>
	 <input type="hidden" name="token" value="<?php echo $token; ?>" />
	<input type="submit" name="AllRecordedAnimals" value="See all Requests on Record"/></br></br>
	</form>
	
	<form method="post" action="AllRecordedAnimals.php">
	<input type="hidden" name="ID" value="<?php echo $user->id ?>"/>
	 <input type="hidden" name="token" value="<?php echo $token; ?>" />
	<input type="submit" name="AllRecordedAnimals" value="See all Animals on Record"/></br></br>
	</form>
	
	
	<form method="post" action="myRequests.php">
	<input type="hidden" name="ID" value="<?php echo $user->id ?>"/>
	 <input type="hidden" name="token" value="<?php echo $token; ?>" />
	<input type="submit" name="seeRequest" value="See Your Adoption Requests"/></br></br>
	</form>
	
		<?php
	}else{//if user
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
	
	if (isset($_POST["logout"])) {//if logout is called
		session_unset();
// destroy the session
	session_destroy();
		header('Location: ./index.php',true,301); //redirect to first page
		exit();
	}
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