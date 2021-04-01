<?php

class View {

    public $page = null;
    public $model = null;

    function __construct($model) {
        $this->model = $model;
    }

    function display() {
        
		require_once("adoptionWeb.html");
		
        if (isset($_GET["page"]))
		{
            $this->page = "" . $_GET["page"] . ".php";
			require($this->page);
 
		}
	}
  
}

?>
