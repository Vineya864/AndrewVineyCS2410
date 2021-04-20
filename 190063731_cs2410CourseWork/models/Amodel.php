<?php

include_once("animal.php");
include_once("views/animalView.php");
include_once("requestModel.php");
include_once("request.php");
include_once("user.php");
include_once("userModel.php");
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
	
	
	
	public function Connect(){
		
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
	
	 /**add a new animal to the database
	 Param name,breed,Description,Birth,Availability
	 */
	 public function addAnimal($name,$breed,$Description,$Birth,$Availability,$Species){
		$this->Connect();
		 $query = $this->pdo->prepare("INSERT INTO`animal` (`Name`,  `Breed`,`Species`, `Description`, `Birth`, `Availability`) VALUES(?,?,?,?,?,?)");
			$query->execute([$name,$breed,$Species,$Description,$Birth,1]);//run the add
				 	$sth=$this->pdo->prepare("SELECT * FROM `dogs` ");
		$sth->execute();//run the search
		while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				
				$animal=$this->getAnimalById($row["ID"]);	//find the new animal as the last added		
	 }
			return $animal->id;//return the new animals id
	 }
	 
	 
	 /**
	 return an animla by the id number assigned
	 */
	  public function getAnimalById($id) {
		$this->Connect();
		$query=$this->pdo->prepare("SELECT * FROM `animal` WHERE ID =?;");
		 $query->execute([$id]);
		  $row=$query->fetch();
	
		if ($row != null){
		return new animal($row["ID"], $row["Name"], $row["Breed"], $row["Description"],$row["Birth"],$row["Availability"]);
		}
	  }
	  /**
	  search for a string like the one given as a name and show the animal
	  PARAM $NAME- the searching string
	  
	  */
	  public function searchName($name) {
		$this->Connect();
	$search=$name."%";
		$query=$this->pdo->prepare("SELECT * FROM `animal` WHERE Name LIKE  (?);");
		 $query->execute([$search]);
		$result=false;   
			while($row =  $query->fetch(PDO::FETCH_ASSOC)) {			
				$animal=$this->getAnimalById($row["ID"]);
					$result=true;
					$view = new animalView();
					$view->displayAnimal($animal);					
				
							}
							return $result;
	  }
		
		
		/**change a animals avalibiltiy 
		*/
		public function adoptAnimal($id){
			 $this->Connect();
		$query=$this->pdo->prepare("UPDATE `animal` SET `Availability`='0' Where ID=?");
		 $query->execute([$id]);
		  $row=$query->fetch();
			
			
		}
		
		
		/** 
		display all the animals in the database in a grid
		
		**/
		public function getAllAnimals(){
		$this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `animal` ");
		$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$animal=$this->getAnimalById($row["ID"]);
				$view = new animalView();
					$view->displayAnimal($animal);
			}
		}




		//Order the animals by the data od birth
		public function orderDate(){
			$this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `animal` ORDER BY `Birth` ASC ");
			$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$animal=$this->getAnimalById($row["ID"]);
					$view = new animalView();
					$view->displayAnimal($animal);			
			}
		}
		
		
		//Order the animals by the name
		public function orderAlphabet(){
			$this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `animal` ORDER BY `Name` ASC ");
			$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$animal=$this->getAnimalById($row["ID"]);
					$view = new animalView();
					$view->displayAnimal($animal);			
			}
		}
		
			//Order the animals by the name
		public function SearchSpecies($name){
				$this->Connect();
				$search=$name."%";
			$query=$this->pdo->prepare("SELECT * FROM `animal` WHERE Species LIKE (?)");
			$query->execute([$search]);
			$result=false;   
			while($row =  $query->fetch(PDO::FETCH_ASSOC)) {			
				$animal=$this->getAnimalById($row["ID"]);
					$result=true;
					$view = new animalView();
					$view->displayAnimal($animal);					
				
							}
							return $result;
	  }
		
	

		public function getAnimalsAndLocation(){
			
			$this->Connect();
			$sth=$this->pdo->prepare("SELECT * FROM `animal` ");
			$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$animal=$this->getAnimalById($row["ID"]);
				$view = new animalView();
				
				if($animal->availability=="0"){
					$view->displayAnimal($animal);
					
				
				$model= new requestModel(null,null,"root","");
				$request=$model->getApprovedRequest($animal->id);
				$model= new userModel(null,null,"root","");
				$user=$model->getUserByID($request->userId);
				$userView=new UserView();
				
				$userView->displayAdoptionInfo($user);				
				}else{
					$view->displayAnimal($animal);
				}
			}
		}
			
		
		
		
		
		}
		
	
	
	
  

?>