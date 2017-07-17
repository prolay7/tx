<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	<script type="text/javascript">
		<?php 
			$timestamp = time();
			$token = md5('unique_salt' . $timestamp);
		?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo $token;?>'
				},
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php',
				'onSelect' : function(file) {
					var uploadfile = '/uploads/<?php echo $token;?>.' + file.type;
					//alert(uploadfile);
				},
				'onUploadComplete' : function() {
                    alert('hello on Upload Complete'); //<- THIS NOT WORK
                },
				'onQueueComplete' : function() {
                    alert('hello on Clear Queue'); //<- THIS NOT WORK
                },
			});
		});
	</script>
</body>
</html>