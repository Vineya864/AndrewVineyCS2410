<!DOCTYPE html>
<html lang="EN">
<?php
include_once("models/requestModel.php");
session_start();
?>
<head>
	<meta charset ="UTF-8"/>
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/myRequests.css" rel="stylesheet" />


	<script src="components/NavbarNew.js" type="text/javascript" defer></script>
	<script src="components/footer.js" type="text/javascript" defer></script>
		</script>
	<title> Dashboard	
	</title>
</head>

<body>
	<header-component></header-component>

	<main class="container">
		<section id="title">
		
	<h2>All My Adoption Requests  </h2>
	
	</section>
	
	<?php
	if (session_id() == '' || !isset($_SESSION['login'])){
			$url='login.php';
					
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	}else{
	if (hash_equals($_SESSION['token'], $_POST['token'])) {
		
		
		$model= new requestModel(null,null,"root","");
	$model->displayAllRequestsOfID($_POST['ID']);
	
		
		
		
	}Else{
		echo "time Out login again";
		
	}
	}
?>	
	
	
	 <br/><br/><br/><br/><br/><br/><br/><br/><br/>
	 <section class="page-footer">
		<footer-component></footer-component>
		</section>
	

</body>
</html>