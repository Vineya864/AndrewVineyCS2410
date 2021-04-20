<?php


include_once("models/user.php");
class UserView {

 public function displayUser($user){
		 //$user=$this->getUserByEmail($email);
					$name = $user->name;
					$type =$user->type;
					
					echo "<b><h3>  $name</h3></b>";
					if($type==1){
					echo "<p>Admin<p>";
					}
					else{
					echo "<h3>User</h3>";					
					}
				
					?>		
		<?php 
	 }
	 
	 
	 
	  public function displayUserProccesed($user){
		// $user=$this->getUserByProccesedEmail($email);
					$name = $user->name;
					$type =$user->type;
					
					echo "<b><h3>  $name</h3></b>";
					if($type==1){
					echo "<p>Admin</p>";
					}
					//else{
					//echo "<h3>User</h3>";					
					//}
				
					?>		
		<?php 
	 }
	 
	 public function displayAdoptionInfo($user){
		 
		 
				echo "<p>Adopted By</p>";
				$this->displayUserProccesed($user);
				$email=$user->email;
				 $emailProcessed=explode (  "(at)" , $email , $limit = PHP_INT_MAX ) ;
			$emailFinal=$emailProcessed[0];
				$emailFinal .="@";
		$emailFinal .=$emailProcessed[1];
		echo "<p>$emailFinal</p>";
	 }
	 
}