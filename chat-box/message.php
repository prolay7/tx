<?php include('database.php');
$ciadminId = $_REQUEST['ciadminId'];
$type = (isset($_REQUEST['type']) && $_REQUEST['type'] != '')?$_REQUEST['type']:null;
if($type != null){
    if($type == 'user'){
        $adminmsg = mysql_query("SELECT * FROM `ajax_chat_messages` WHERE `status` = 'unread' AND `type`= 'user'");
        $total_rows = mysql_num_rows($adminmsg);
    }else{
        $adminmsg = mysql_query("SELECT * FROM ajax_chat_messages  WHERE ajax_chat_messages.status = 'unread' AND ajax_chat_messages.type = 'admin' AND ajax_chat_messages.type= 'admin' AND ajax_chat_messages.trans_id= ".$ciadminId." AND ajax_chat_messages.bid_id IN (SELECT bidjob.id FROM bidjob WHERE bidjob.trans_id = ".$ciadminId.")");
        $total_rows = mysql_num_rows($adminmsg);

    }
    echo $total_rows;
    exit();
}
   $adminmsg = mysql_query("SELECT * FROM `ajax_chat_messages` WHERE `status` = 'unread' AND `type`= 'user'");
   while($unread_list=mysql_fetch_object($adminmsg))                   				  
					{ 
				     $jobs = mysql_fetch_object(mysql_query("SELECT * FROM `jobpost` WHERE `id` = '".$unread_list->job_id."' AND `status`= '1'"));
				?>
                        <a id="blue" href="<?php echo $base; ?>?bid_id=<?php echo $unread_list->bid_id?>&job_id=<?php echo $unread_list->job_id?>&trans_id=<?php echo $unread_list->trans_id?>&type=admin&ciadminId=<?php echo $ciadminId; ?>"><?php echo $jobs->name?></a>
              <?php } 

?>

