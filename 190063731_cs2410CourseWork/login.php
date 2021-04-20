<!DOCTYPE html>
<html lang="EN">
<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
include_once("models/UserModel.php");

?>
<head>
	<meta charset ="UTF-8"/>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/sizing.css" rel="stylesheet" />
<script src="components/header.js" type="text/javascript" defer></script>
<script src="components/footer.js" type="text/javascript" defer></script>
		<script src= "js/validate_password.js">
		</script>
				<script src= "js/mainScript.js">
		</script>
	<title> Aston animal sanctuary		
	</title>
</head>

<body>
<header-component></header-component>
	
	<main>
	<section id="account-creation">
	<h1>Log In</h1>
		<form method="post" action="">
		
		<label for= "email"> Email Address </label>
		<input type="Email" name="email"
			placeholder="Valid Email Address"
			required
		
			/>
			
			<br/><br/>
		<label for= "password"> Password </label>
		<input type="password" name="password"
			placeholder="Password"
			required 
			/>
   <br/><br/>
   <input type="hidden" name="token" value="<?php echo $token; ?>" />
		<input type="submit" name="user" value="Login"/>
			
	
	</form>
	</section>
	
	<?php
		if (isset($_POST["user"])) {//if logged in
			if (!empty($_POST['token'])) {//if ther is a token
    if (hash_equals($_SESSION['token'], $_POST['token'])) {//if token matches
         
    
			$email=filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING);//sanatize input
			$pass= filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING);//sanatize input
			
			$model= new UserModel(null,null,"root","");
			if($model->checkPassword($pass,$email)){//if password matches
				$email=$model->processEmail($email);
				 $_SESSION['login'] = $email; //write login to server storage
					$user=$model->getUserByProccesedEmail($email);
					if($user->type){
						$url='AccountPage.php';//redirect to account
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
					}else{
					$url='allAnimals.php';//redirect to account
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
					}
			}else{
			echo "Incorect details"; 
			}
		}
			}else {
         echo "CSRF TOKEN DOES NOT MATCH";
    }
}
	
	?>
	</main>
	<footer-component></footer-component>
	
</html>