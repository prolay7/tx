<?php
    /*ob_start();
    require('../index.php');
    ob_end_clean();
    $CI =& get_instance();
    $CI->load->library('session'); //if it's not autoloaded in your CI setup
    print_r( $CI->session->userdata);*/
	
	$cisess_cookie = $_COOKIE['ci_session'];
	$cisess_cookie = stripslashes($cisess_cookie);
	$cisess_cookie = unserialize($cisess_cookie);
	//echo '<pre>'; print_r($cisess_cookie);
	echo $cisess_session_id = $cisess_cookie['session_id'];
?>