<!DOCTYPE html>
<html lang="EN">
<?php
include_once("models/Amodel.php");
?>
<head>
	<meta charset ="UTF-8"/>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	
	<link href="css/dashboard.css" rel="stylesheet" />

	<script src="components/header.js" type="text/javascript" defer></script>
	<script src="components/footer.js" type="text/javascript" defer></script>
		</script>
	<title> All Animals	
	</title>
</head>

<body>
	<header-component></header-component>
	
	<main class="container">
      
	 <br/>
	 
	 <section id = "introduction">
			<h1>See Some of the Wonderfull Animals Avalible to Adopt Today.</h2>
			
	</section>
	<section id ="searchOptions">
	
	
	

<h3>Search for an Animal</h3>

<form method="post" action="">
<div>
 Find an animal By species<br>
    	<input type="radio" id="Dog" name="speciesName" value="Dog">
<label for="Dog">Dog</label>
<input type="radio" id="Cat" name="speciesName" value="Cat">
<label for="Cat">Cat</label><br>
<input type="submit" name="species" value="Search">
</div>
</form>
<br>
<form method="post" action="">
<div>
        Find an animal By Name:<br><input type="text" name="name"/><br>
        <input type="submit" name="animal" value="Search">
</div>
</form>
</br>
<form method="post" action="">
</br>
 <input type="submit" name="date" value="Age Order">
</form>
<form method="post" action="">
</br>
 <input type="submit" name="alphabet" value="Alphabetical Order">

</form>
</br>
	</section>
	<section id="result">
<?php
		if (isset($_POST["animal"])) {
 

			$name = $_POST['name'];
			$name=filter_var($name, FILTER_SANITIZE_STRING);
			$model= new AModel(null,null,"root","");
			$animal=$model->searchName($name);
		
			if(!$animal){
			echo "<p>Sorry, No Animal Could Be found.</p>";
			}
		}
		
		
		
		if (isset($_POST["species"])) {
 

			$species = $_POST['speciesName'];
			$species=filter_var($species, FILTER_SANITIZE_STRING);
			$model= new AModel(null,null,"root","");
			$animal=$model->SearchSpecies($species);
		
			if(!$animal){
			echo "<p>Sorry, No Animal Could Be found.</p>";
			}
		}
				?>
			</section>
	<section id="all animals">	
<h3> All  Animals<h/3>	
	<?php
	$model= new AModel(null,null,"root","");
	if (isset($_POST["date"])) {
		$model->orderDate();
	}else if (isset($_POST["alphabet"])) {
		$model->orderAlphabet();
	}
	
	else{
	
		$animal= $model->getAllAnimals();
	}
	
	?>
	</section>
				
	 <br/><br/><br/><br/><br/><br/><br/><br/><br/>
	 <section class="page-footer">
		<footer-component></footer-component>
		</section>
	

</body>
</html>