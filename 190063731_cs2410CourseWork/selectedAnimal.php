<!DOCTYPE html>
<html lang="EN">
<?php
session_start();
include_once("models/Amodel.php");
include_once("views/animalView.php");
?>
<head>
	<meta charset ="UTF-8"/>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	
	<link href="css/dashboard.css" rel="stylesheet" />
<link href="css/animal.css" rel="stylesheet" />
	<script src="components/header.js" type="text/javascript" defer></script>
	<script src="components/footer.js" type="text/javascript" defer></script>
		</script>
	<title>Aston animal sanctuary
	</title>
</head>

<body>
	<header-component></header-component>
	<main>
	<section id="animal">
	<?php
	
	$id = $_GET['id'];
	$model= new AModel(null,null,"root","");
	$view= new animalView();
	$animal=$model->getAnimalById($id);
	$view->displayAnimal($animal);
	$birth=$animal->birth;
	echo "<h4>Born : $birth</h4>";
	$description=$animal->description;
	$availability=$animal->availability;
	
	echo "<h4>$description</h4>";
	if ($availability==1){
		echo "<h4>available</h4>";
		if (session_id() == '' || !isset($_SESSION['login'])){
			?>
			<a href="login.php"><button>Login To adopt</button></a>
			<?php
	}else{
		
	
	?>
	<a href="confirmAddRequest.php?id=<?php echo $id ?>"><button>Adopt</button><?php
	
	}
	}
	else{
		echo "<h4>Adopted</h4>";
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