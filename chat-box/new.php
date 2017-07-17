
<?php 
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
$message="http://translatorexchange.com/chat-box/uploads/1453198124/church_pending - Copy.txt";
$message=htmlentities(strip_tags($message));
//echo $message;
if(preg_match($reg_exUrl, $message)) {
	//echo '<pre>';print_r($message);
	//echo $message;die;
	//$url[0] = 'http://'.$_SERVER['HTTP_HOST'].'/translation/chat-box'.$message;
	$link=explode("/",$message);
	$link1=end($link);
	
	echo  '<a href="'.$message.'" target="_blank">'.$link1.'</a>';
	//echo $link1;die;
	$message = '<a href="'.$message.'" target="_blank">  '.$link1.' </a> ';
	echo $message; 
}


?>
