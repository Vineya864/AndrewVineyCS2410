<!DOCTYPE html>
<html lang="EN">
<?php
session_start();
include_once("models/Amodel.php");
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
	
	<?php
	
	$id = $_GET['id'];
	$model= new AModel(null,null,"root","");
	$animal=$model->getAnimalById($id);
	$model->displayAnimal($id);
	$birth=$animal->birth;
	echo "<h4>Born : $birth</h4>";
	$description=$animal->description;
	$availability=$animal->availability;
	
	echo "<h4>$description</h4>";?>
	
	<form method="post" action="sendRequest.php?id=<?php echo $id ?>"">
		
		
   <input type="hidden" name="token" value="<?php echo $token; ?>" />
	
		<input type="submit" name="adopt" value="adopt"/>
		<input type="submit"name="cancel" value="cancel"/>
	
	
	
	
	
	
	
	
	</main>
	 <section class="page-footer">
		<footer-component></footer-component>
		</section>
	

</body>
</html>