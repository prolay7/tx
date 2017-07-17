<?php
error_reporting(0);
class App_auth extends CI_Controller {

	private $custServiceControllerAccess = array('cs_admin');

    function index() {
    	if($this->session->userdata("admin_type") == 3) {
    		if($this->router->fetch_class()) {
    			
    		}
    	}
  //   	echo "<textarea>".$this->router->fetch_class()."</textarea>";
  //   	echo "<br /><br />";
		// echo $this->router->fetch_method();
    	// echo 'hey!<br/><br/><br/><br/><br/>hey!';
    }
	
}

	