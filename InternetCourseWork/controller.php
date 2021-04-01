<?php
include_once("models/Amodel.php");
include_once("view.php");

class Controller {
	public $model=null;
	public $view = null;
	
	function __construct() {  
		$this->model = new AModel("mysql:host=127.0.0.1", "animals", "root", ""); #put your DB details in this line !
        $this->model->Connect();
        $this->view = new View($this->model);
    } 
	
	function invoke() {
			//display the menu page
			$this->view->display();

   }

}

?>