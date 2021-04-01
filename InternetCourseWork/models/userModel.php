<?php


include_once("user.php");
class UserModel {

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
	
	
	 
	 
	  public function getUserByEmail($email) {
	//	 $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
	//	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$emailProcessed=explode (  "@" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .=$emailProcessed[1];
		// $query = ("SELECT * FROM `users` WHERE Email =('$emailFinal')");
		//$rows = $this->pdo-> query($query);
		$query=$this->pdo->prepare("SELECT * FROM `users` WHERE Email =?;");
		 $query->execute([$emailFinal]);
		//$row=$rows->fetch();
		 $row=$query->fetch();
		if ($row != null){
		return new user($row["ID"], $row["Email"], $row["Name"], $row["Type"]);
		}
	  }
	  
	  public function getUserByProccesedEmail($email) {
		// $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->Connect();
		$emailProcessed=explode (  "@" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		//$emailFinal .=$emailProcessed[1];
		// $query = ("SELECT * FROM `users` WHERE Email =('$emailFinal')");
		//$rows = $this->pdo-> query($query);
		$query=$this->pdo->prepare("SELECT * FROM `users` WHERE Email =?;");
		 $query->execute([$emailFinal]);
		//$row=$rows->fetch();
		 $row=$query->fetch();
		if ($row != null){
		return new user($row["ID"], $row["Email"], $row["Name"], $row["Type"]);
		}
	  }
	  public function checkPassword($pass, $name){
	//	  $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->Connect();
		$emailProcessed=explode (  "@" , $name , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .=$emailProcessed[1];
		
		 //$query = ("SELECT * FROM `users` WHERE Email =('$emailFinal')");
		 $query=$this->pdo->prepare("SELECT * FROM `users` WHERE Email =?;");
		 $query->execute([$emailFinal]);
		 //$rows = $this->pdo-> query($query);
		 $row=$query->fetch();
		//$row=$rows->fetch();
		
		
		
		if ($row != null){
			//echo password_hash($pass,PASSWORD_DEFAULT);
			//if($row["Password"]==password_hash($pass,PASSWORD_DEFAULT)){
			if(password_verify($pass,$row["Password"])){
				
					return True;
		
				}else {
				echo "Password";}
				
		}
		return False;
		
		  
	  }
	  public function addUser($email,$pass, $name,$type){
		  // $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=animals", $this->username, $this->password );
		//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//  $query = ("INSERT INTO`users` (`Email`, `Password`, `Name`, `Type`) VALUES('$email','$pass','$name','$type') ");
		 //$rows = $this->pdo-> query($query);
			$this->Connect();
			$query = $this->pdo->prepare("INSERT INTO`users` (`Email`, `Password`, `Name`, `Type`) VALUES(?,?,?,?)");
			$query->execute([$email,$pass,$name,$type]);


	
		 	$sth=$this->pdo->prepare("SELECT * FROM `users` ");
		$sth->execute();
		while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				//echo "<br> id: ". $row["ID"]  ;
				$account=$this->getUserByProccesedEmail($row["Email"]);			
	 }
			if($account->email==$email){
			//echo "worked";
			return true;
		
			}else{
				//echo "fail";
				return false;
			}
		  
	  }
	  
	   public function displayUserProccesed($email){
		 $user=$this->getUserByProccesedEmail($email);
					$name = $user->name;
					$type =$user->type;
					
					echo "<b><h3>  $name</h3></b>";
					if($type==1){
					echo "<h3>Admin</h3>";
					}
					else{
					echo "<h3>User</h3>";					
					}
				
					?>		
		<?php 
	 }
	 public function displayUser($email){
		 $user=$this->getUserByEmail($email);
					$name = $user->name;
					$type =$user->type;
					
					echo "<b><h3>  $name</h3></b>";
					if($type==1){
					echo "<h3>Admin</h3>";
					}
					else{
					echo "<h3>User</h3>";					
					}
				
					?>		
		<?php 
	 }
		
		
				
}
		
	
	
	
  

?>