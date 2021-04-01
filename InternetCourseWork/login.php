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
<script src="components/Navbar.js" type="text/javascript" defer></script>
<script src="components/footer.js" type="text/javascript" defer></script>
		<script src= "js/validate_password.js">
		</script>
				<script src= "js/mainScript.js">
		</script>
	<title> adoption website		
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
				<!---	pattern=".+(\.edu|\.ac\.uk)" -->
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
		if (isset($_POST["user"])) {
			if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
         
    
			$email=filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING);
			$pass= filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING);
			
			$model= new UserModel(null,null,"root","");
			if($model->checkPassword($pass,$email)){
				
				 $_SESSION['login'] = $email; //write login to server storage
				 
					$url='AccountPage.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
					//header('Location: ./index.php',true,301); 
					//exit();
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