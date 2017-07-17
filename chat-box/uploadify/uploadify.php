<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
    if(!preg_match('/[^\x20-\x7f]/',$_FILES['Filedata']['name'])) {
        $ImageName = str_replace(' ', '-', strtolower($_FILES['Filedata']['name']));
        $ImageName = str_replace('/', '-', strtolower($ImageName));
        $ImageName = str_replace('(', '-', strtolower($ImageName));
        $ImageName = str_replace(')', '-', strtolower($ImageName));
        $ImageName = rand(10,999).$ImageName;
    }else {
        if (strpos($_FILES['Filedata']['name'], '.') != false) {
            $ext = '.' . end(explode('.', $_FILES['Filedata']['name']));
        } else {
            $ext = '';
        }
        $ImageName = time().$ext;
    }
    $_FILES['Filedata']['name'] = $ImageName;
	$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
	$targetFile = rtrim($targetPath,'/') . '/' . $verifyToken . '.' . $ext;
	
	// Validate the file type
	//$fileTypes = array('jpg','jpeg','gif','png', 'doc', 'docx', 'txt', 'xlsx', 'jar'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	//if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	/*} else {
		echo 'Invalid file type.';
	}*/
}
?>