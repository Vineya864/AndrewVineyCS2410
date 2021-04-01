<?php

include_once("animal.php");

class AModel {

    private $server;
    private $dbname;
    private $username;
    private $password;
    private $pdo;
	# define the constructor which has four arguments for $server, $dbname, $username, $password. 
	# The $pdo field should be assigned as null  

	public function __construct($a,$b,$c,$d){
		$this->server = $a;
		$this->dbname = $b;
		$this->username = $c;
		$this->password = $d;
		$this->pdo =null;
	}
	
	
	
    #Define a Connect() function to create the $pdo as a PDO object based on the four fields $server, $dbname, $username, $password. 
	#Using the try/catch structure to handle the database connection error
  
	public function Connect(){
		//PDO("mysql:host=$this->server;dbname=$this->dbname",
	try{
	$this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	} catch (PDOException $ex) {
    ?>
    <p>Sorry, a database error occurred.</p>
	<p> Error details: <em> <?= $ex->getMessage() ?> </em></p>
	<?php	
	}
	}
	
	
	 public function displayAnimal($id){
		 $animal=$this->getAnimalById($id);
					$name = $animal->name;
					$breed =$animal->breed;
					$description=$animal->description;
					echo "<b><h3>  $name</h3></b>";
					echo "<h3>$breed</h3>";
					
					$image="pictures/"."$name$id.jpg"
					?>
					
				<a href="selectedAnimal.php?id=<?php echo $id ?>">
					
					
		<img src="<?php echo $image; ?> " width="300" height="300"><a/>	
					
	
		<?php 
	 }
	 
	 public function addAnimal($name,$breed,$Description,$Birth,$Availability){
		// $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->Connect();
		//  $query = ("INSERT INTO`dogs` (`Name`, `Breed`, `Description`, `Birth`, `Availability`) VALUES('$name','$breed','$Description','$Birth','$Availability') ");
		 //$rows = $this->pdo-> query($query);
		 $query = $this->pdo->prepare("INSERT INTO`dogs` (`Name`, `Breed`, `Description`, `Birth`, `Availability`) VALUES(?,?,?,?,?)");
			$query->execute([$name,$breed,$Description,$Birth,1]);
		 
		 
		 
		 	$sth=$this->pdo->prepare("SELECT * FROM `dogs` ");
		$sth->execute();
		while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				//echo "<br> id: ". $row["ID"]  ;
				$animal=$this->getAnimalById($row["ID"]);			
	 }
			return $animal->id;
	 }
	 
	  public function getAnimalById($id) {
		//$this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->Connect();
		// $query = ("SELECT * FROM `dogs` WHERE ID=($id)");
		$query=$this->pdo->prepare("SELECT * FROM `dogs` WHERE ID =?;");
		 $query->execute([$id]);
		  $row=$query->fetch();
	//	$rows = $this->pdo-> query($query);
		//$row=$rows->fetch();
		if ($row != null){
		return new animal($row["ID"], $row["Name"], $row["Breed"], $row["Description"],$row["Birth"],$row["Availability"]);
		}
	  }
	  
	  public function searchName($name) {
		//	$this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->Connect();
	$search=$name."%";
		$query=$this->pdo->prepare("SELECT * FROM `dogs` WHERE Name LIKE  (?);");
		 $query->execute([$search]);
		  
		 //$sth=$this->pdo->prepare("SELECT * FROM `dogs` WHERE Name LIKE '$search'");
		//$sth->execute();
		$result=false;
    
			while($row =  $query->fetch(PDO::FETCH_ASSOC)) {
				//echo "<br> id: ". $row["ID"]  ;
				$animal=$this->getAnimalById($row["ID"]);
					$result=true;
				?>
				<div class="grid-item">
					<Section class="animal">			
					<?php
					$this->displayAnimal($row["ID"]);		
					?>
	</section></div>
				<?php			
				return $result;
							}
	  }
		
		public function getAllAnimals(){
		//	$this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->Connect();
		 //$sth=$this->pdo->prepare("SELECT * FROM `dogs` ");
		$sth=$this->pdo->prepare("SELECT * FROM `dogs` ");
		$sth->execute();
		
    
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				//echo "<br> id: ". $row["ID"]  ;
				$animal=$this->getAnimalById($row["ID"]);
				?>
				<div class="grid-item">
					<Section class="animal">
					
					<?php
					$this->displayAnimal($row["ID"]);
					?>
					
			
    
	</section></div>
				<?php
				
			}
		
		}

		}
		
	
	
	
  

?>