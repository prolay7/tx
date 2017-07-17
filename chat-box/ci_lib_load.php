<?php
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/TranslatorExchange/index.php'; // adjust path accordingly
$obj =& get_instance();
ob_get_clean();
return $obj;

?>