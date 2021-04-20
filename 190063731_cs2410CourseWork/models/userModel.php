<?php

include_once("user.php");
class UserModel {

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
	
	
	 
	 /***
	 DEPRECATED- old method now use getUserByProccesedEmail(processEmail($email))
	  find the user by the unique email address
	  @PARAM email- email
	  
	 */
	  public function getUserByEmail($email) {
		$this->Connect();
		$emailProcessed=explode (  "@" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .=$emailProcessed[1];
		$query=$this->pdo->prepare("SELECT * FROM `users` WHERE Email =?;");
		 $query->execute([$emailFinal]);
		
		 $row=$query->fetch();
		if ($row != null){
		return new user($row["ID"], $row["Email"], $row["Name"], $row["Type"]);
		}
	  }
	  
	  /**
	  find the user by the unique email address
	  @PARAM email-proccessed email
	  */
	  public function getUserByProccesedEmail($email) {
		$this->Connect();
		$emailProcessed=explode (  "@" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		
		$query=$this->pdo->prepare("SELECT * FROM `users` WHERE Email =?;");
		 $query->execute([$emailFinal]);
	
		 $row=$query->fetch();
		if ($row != null){
		return new user($row["ID"], $row["Email"], $row["Name"], $row["Type"]);
		}
	  }
	  
	  /** get the user by the id number
	  @PARAM-id the id number
	  */
	    public function getUserByID($id) {
			$this->Connect();
		$query=$this->pdo->prepare("SELECT * FROM `users` WHERE ID =?;");
		 $query->execute([$id]);
		
		 $row=$query->fetch();
		if ($row != null){
		return new user($row["ID"], $row["Email"], $row["Name"], $row["Type"]);
		}
	  }
	  
	  /*
	  checks that password matches the one on file
		@PARAM pass-the password to check
		@PARAM name-the users email
	  */
	  public function checkPassword($pass, $name){
	
		$this->Connect();
		$emailFinal=$this->processEmail($name);
		 $query=$this->pdo->prepare("SELECT * FROM `users` WHERE Email =?;");
		 $query->execute([$emailFinal]);
		 $row=$query->fetch();
		if ($row != null){//if an account is found
			if(password_verify($pass,$row["Password"])){
				
					return True;
		
				}
			}
		return False;		  
	  }
	  
	  /**
	  add a new account to the database
		@PARAM email- the email to save (needs to be processed)
		@PARAM pass- The hashed password
		@PARAM name- the user name
		@PARAM $the Type of account 
	  
	  */
	  public function addUser($email,$pass, $name,$type){
			$this->Connect();
			$query = $this->pdo->prepare("INSERT INTO`users` (`Email`, `Password`, `Name`, `Type`) VALUES(?,?,?,?)");
			$query->execute([$email,$pass,$name,$type]);


	
		 	$sth=$this->pdo->prepare("SELECT * FROM `users` ");
		$sth->execute();
		while($row =  $sth->fetch(PDO::FETCH_ASSOC)) {
				$account=$this->getUserByProccesedEmail($row["Email"]);			
	 }
			if($account->email==$email){
		
			return true;
		
			}else{
				
				return false;
			}
		  
	  }
	  
	
	 /**
	 convert the email so that it can be used 
	 */
	 public function processEmail($email){
		 $emailProcessed=explode (  "@" , $email , $limit = PHP_INT_MAX ) ;
		$emailFinal=$emailProcessed[0];
		$emailFinal .="(at)";
		$emailFinal .=$emailProcessed[1];
		return $emailFinal;
	 }
		
		
				
}
		
	
	
	
  

?>