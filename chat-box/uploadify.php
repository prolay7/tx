<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination





$targetFolder = dirname(__FILE__).'/uploads/'.$_POST['timestamp']; // Relative to the root
if (!is_dir($targetFolder)) {
	 mkdir($targetFolder);
}

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath =  $targetFolder;
    if(!preg_match('/[^\x20-\x7f]/',$_FILES['Filedata']['name'])) {
        $ImageName = str_replace(' ', '-', strtolower($_FILES['Filedata']['name']));
        $ImageName = str_replace('/', '-', strtolower($ImageName));
        $ImageName = str_replace('(', '-', strtolower($ImageName));
        $ImageName = str_replace(')', '-', strtolower($ImageName));
        $ImageName = rand(100,999).$ImageName;
    }else{
        if(strpos($_FILES['Filedata']['name'],'.')!= false) {
            $ext = '.'.end(explode('.', $_FILES['Filedata']['name']));
        }else{
            $ext = '';
        }
        $ImageName = time().$ext;
    }
    $_FILES['Filedata']['name'] = $ImageName;
	$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
	$targetFile = rtrim($targetPath,'/') . '/' .$_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png', 'doc','txt', 'docx','xls','xlsx', 'jar','zip', 'rar','pdf','ppt','pptx'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($ext,$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo json_encode($_FILES['Filedata']['name']);
		exit();
	} else {
		$message = "wrong answer";
echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
?>