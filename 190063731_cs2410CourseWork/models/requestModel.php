<?php
include_once("request.php");
include_once("Amodel.php");
include_once("UserModel.php");
include_once("views/requestView.php");
include_once("views/userView.php");
class RequestModel {

      private $server;
    private $dbname;
    private $username;
    private $password;
    private $pdo;
 

	public function __construct($a,$b,$c,$d){
		$this->server = $a;
		$this->dbname = $b;
		$this->username = $c;
		$this->password = $d;
		$this->pdo =null;
	}
	
	
	
 
  
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
	
	
	/*
	create a new Request
	@PARAM userId- the users id who is making the request
	@PARAM animalID- the animal that is being requested
	*/
	
	public function createRequest($userID, $animalID){

		  $this->Connect();
		
		$query = $this->pdo->prepare("INSERT INTO`requests` ( `UserID`, `AnimalID`) VALUES(?,?)");
			$query->execute([$userID,$animalID]);
		
		$sth=$this->pdo->prepare("SELECT * FROM `requests` ");
		$sth->execute();
		while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
			
				$request=$this->getRequestById($row["ID"]);			
	 }
			return $request->id;
	 }
	 /*get a specific request sfrom the id number
	 @PARAM the Request id number
	 
	 */
	 public function getRequestById($id) {
	
		$this->Connect();
		$query=$this->pdo->prepare("SELECT * FROM `requests` WHERE ID=?;");
		 $query->execute([$id]);
		  $row=$query->fetch();
		if ($row != null){
		return new Request($row["ID"], $row["UserID"], $row["AnimalID"], $row["Approved"]);
		}
	  }
	  
	  /**
	  get the requests form the users ID number
	  @PARAM id- the users id number
	  
	  */
	  public function getRequestByUserID($id){
		  $this->Connect();
		$query=$this->pdo->prepare("SELECT * FROM `requests` WHERE UserID=?;");
		 $query->execute([$id]);
		  $row=$query->fetch();
		if ($row != null){
		return new Request($row["ID"], $row["UserID"], $row["AnimalID"], $row["Approved"]);
		}
		  
	  }
	  
	  
	   
	 
	 public function approveRequest($id){
		  $this->Connect();
		 if( $this->checkRequest($id)){
		$query=$this->pdo->prepare("UPDATE `requests` SET `Approved`='Approved' Where ID=?");
		 $query->execute([$id]);
		  $row=$query->fetch();
		return $this->getRequestById($id);	
		 }
	 }
	 
	 public function checkRequest($id){
		 $request=$this->getRequestById($id);
		 if(($this->getApprovedRequest($request->animalId))!=null){
			 $this->rejectRequest($id);
			 return false;
		 }
			 
		 
		 
	 }
	 
	  public function rejectRequest($id){
		  $this->Connect();
		$query=$this->pdo->prepare("UPDATE `requests` SET `Approved`='Rejected' Where ID=?");
		 $query->execute([$id]);
		  $row=$query->fetch();
		if ($row != null){
		return new Request($row["ID"], $row["UserID"], $row["AnimalID"], $row["Approved"]);
		}
	 }
	 
	 /*show all the requests with the id number
	 @patam id- the searching id number*/
	 public function displayAllRequestsOfID($id){
		 $this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `requests`");
		$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$request=$this->getRequestByID($row["ID"] );
				if($request->userId == $id){
				
						$view=new RequestView();
					
					$requestUser= $view-> displayRequest($request);
					
					
					
			}
		}
	 }
	 
	 /***
	 display every request 
	@param token- passes this to the next page to verify users
	 */
	  public function displayAllRequests($token){
		 $this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `requests`");
		$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$request=$this->getRequestByID($row["ID"] );
				
				?>
				<div class="grid-item">
					<Section class="Requests">
					<?php
					$view=new RequestView();
					
					$requestUser= $view-> displayRequest($request);
					$model=new UserModel(null,null,"root","");
				$user=$model->getUserByID($requestUser);
				$userView=new UserView();
				
				$userView->displayUserProccesed($user);
				$email=$user->email;
				 $emailProcessed=explode (  "(at)" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .="@";
		$emailFinal .=$emailProcessed[1];
		echo $emailFinal;
					?>
				
		
	</section></div>
				<?php	
			
		}
	 }
	 
	 
	 /***
	 display  pending request and will display options to approve.
	@param token- passes this to the next page to verify users
	 */
	  public function displayAllPendingRequests($token){
		 $this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `requests`");
		$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				
				$request=$this->getRequestByID($row["ID"] );
				if ($row["Approved"]=="Pending"){ 
				?>
				<div class="grid-item">
					<Section class="Requests">
					<?php
					$view=new RequestView();
					
					$requestUser= $view-> displayRequest($request);
					$model=new UserModel(null,null,"root","");
				$user=$model->getUserByID($requestUser);
				$userView=new UserView();
				
				$userView->displayUserProccesed($user);
				$email=$user->email;
				 $emailProcessed=explode (  "(at)" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .="@";
		$emailFinal .=$emailProcessed[1];
		echo $emailFinal;
				//only display the options if it has not allready been approved or denied
				$view->displayRequestOptions($user->id,$token,$row["ID"]);	?>
				
			<?php	}	?>
	</section></div>
				<?php	
			
		}
	 }
		
		
		/*
		get aprroved request by animal id
		
		*/
		 public function getApprovedRequest($id){
		 $this->Connect();
		$sth=$this->pdo->prepare("SELECT * FROM `requests`");
		$sth->execute();
			while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$request=$this->getRequestByID($row["ID"] );
				if($request->animalId == $id){
				if($request->approved=="Approved"){
					return $request;
					
				}
						
					
					
					
			}
		}
	 }
		
		
	 }
	 
	

	
	?>