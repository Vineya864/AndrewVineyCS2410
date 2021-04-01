<?php
include_once("request.php");
include_once("Amodel.php");
class RequestModel {

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
	
	
	
	
	public function createRequest($userID, $animalID){
		//Connect();
		// $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $this->Connect();
		  //$query = ("INSERT INTO`requests` ( `UserID`, `AnimalID`) VALUES($userID, $animalID) ");
		//$rows = $this->pdo-> query($query);
		$query = $this->pdo->prepare("INSERT INTO`requests` ( `UserID`, `AnimalID`) VALUES(?,?)");
			$query->execute([$userID,$animalID]);
		
		$sth=$this->pdo->prepare("SELECT * FROM `requests` ");
		$sth->execute();
		while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				//echo "<br> id: ". $row["ID"]  ;
				$request=$this->getRequestById($row["ID"]);			
	 }
			return $request->id;
	 }
	 
	 public function getRequestById($id) {
		//$this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// $query = ("SELECT * FROM `requests` WHERE ID=($id)");
		//$rows = $this->pdo-> query($query);
		//$row=$rows->fetch();
		$this->Connect();
		$query=$this->pdo->prepare("SELECT * FROM `requests` WHERE ID=?;");
		 $query->execute([$id]);
		  $row=$query->fetch();
		if ($row != null){
		return new Request($row["ID"], $row["UserID"], $row["AnimalID"], $row["Approved"]);
		}
	  }
	  
	  public function getRequestByUserID($id){
		  $this->Connect();
		$query=$this->pdo->prepare("SELECT * FROM `requests` WHERE UserID=?;");
		 $query->execute([$id]);
		  $row=$query->fetch();
		if ($row != null){
		return new Request($row["ID"], $row["UserID"], $row["AnimalID"], $row["Approved"]);
		}
		  
	  }
	 
	 
	 
	 
	 public function displayAllRequestsOfID($id){
		 $this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `requests`");
		$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$request=$this->getRequestByID($row["ID"] );
				if($request->userId == $id){
				?>
				<div class="grid-item">
					<Section class="Requests">
					<?php
					$this->displayRequest($row["ID"]);
					
					?>
	</section></div>
				<?php		
			}
		}
	 }
		
		
		public function displayRequest($id){
			 $request=$this->getRequestByID($id);
					$id = $request->id;
					$UserId =$request->userId;
					$AnimalId=$request->animalId;
					$animal=new Amodel(null,null,"root","");
					$animal->displayAnimal($AnimalId);
					echo "</br>" ;
					echo $request->approved;
					
		}
		
	 }
	 
	

	
	?>