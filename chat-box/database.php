<?php
$base_url='http://'.$_SERVER['HTTP_HOST'].'/chat-box'

 ?>
<?php
/*$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
		die('Not connected : ' . mysql_error());
	}
	
	// make foo the current db
	$db_selected = mysql_select_db('translator', $link);
	if (!$db_selected) {
		die ('Can\'t use foo : ' . mysql_error());
	}*/
	
?>
<?php
//$link = mysql_connect('localhost', 'translk9_trans', 'trans321');
$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
		die('Not connected : ' . mysql_error());
	}
	
	// make foo the current db
	$db_selected = mysql_select_db('translator', $link);
	if (!$db_selected) {
		die ('Can\'t use foo : ' . mysql_error());
	}
	
?>