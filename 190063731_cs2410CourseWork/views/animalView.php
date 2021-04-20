<?php

class animalView {

/* show the animal with the id number
	*/
	 public function displayAnimal($animal){
		 
		 if ($animal != null){
		?>
		<div class='grid-item'>
			<Section class='animal'>
			<?php
					$name = $animal->name;
					$breed =$animal->breed;
					$description=$animal->description;
					$id=$animal->id;
					echo "<b><h3>  $name</h3></b>";
					echo "<h3>$breed</h3>";
					
					$image="pictures/"."$name$id.jpg"
					?>
					
				<a href="selectedAnimal.php?id=<?php echo $id ?>">
					
					
		<img src="<?php echo $image; ?> "alt="Sorry! Image not available at this time" width="300" height="300"><a/>	
			
	</section></div>
		<?php 
				
		 }else{
			 echo "<h3>no animal found </h3>";
		 }
		 
	 }
}