 <?php
 include_once("animalView.php");
 include_once("models/Amodel.php");
 class RequestView {
 /***
	 display every request and if it pending will display options to approve.
	@param token- passes this to the next page to verify users
	 */
	 
		
		public function displayRequest($request){
			
					$id = $request->id;
					$UserId =$request->userId;
					$AnimalId=$request->animalId;
					$animal=new Amodel(null,null,"root","");
				
					$animal=$animal->getAnimalById($AnimalId);
					$view = new animalView();
					$view->displayAnimal($animal);
					echo "</br>" ;
					echo $request->approved;
					return $UserId;
					
		}
		//show the options to allow rejection or approval
		public function displayRequestOptions($userId, $token, $requestID){
			?>
			<!----Approve--->
				<form method="post" action="approveRemoveRequest.php">
				<input type="hidden" name="ID" value="<?php echo $userId ?>"/>
				<input type="hidden" name="RequestId" value="<?php echo $requestID?>"/>
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
	 		<input type="submit" name="ApprovedRequest" value="Approved Request"/></br></br>
			<!----Reject--->
		<form method="post" action="approveRemoveRequest.php">
				<input type="hidden" name="ID" value="<?php echo $userId ?>"/>
				<input type="hidden" name="RequestId" value="<?php echo $requestID?>"/>
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
	 		<input type="submit" name="RefuseRequest" value="Refuse Request"/></br></br>
	</form>
	<?php
		}
		
	 }
	 
	

	
	?>