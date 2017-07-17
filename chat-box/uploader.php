<?php
include('database.php');

$valid_file = true;

$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/development/';

if ($_FILES['file_upload']['name']) {
    //if no errors...
    if (!$_FILES['file_upload']['error']) {
        //now is the time to modify the future file name and validate the file
        $new_file_name = strtolower($_FILES['file_upload']['tmp_name']); //rename file

        //if the file has passed the test
        if ($valid_file) {
            //move it to where we want it to be

            $sub_folder = time();
            mkdir('../uploads/chat-box/'.$sub_folder);

            move_uploaded_file($_FILES['file_upload']['tmp_name'], '../uploads/chat-box/'.$sub_folder.'/'.$_FILES['file_upload']['name']);
            $message = true;

            // get job name
            $query = mysql_query("SELECT name FROM jobpost WHERE id = ".$_REQUEST['job_id']);
            $row = mysql_fetch_row($query);

            $message = "<a href=\'".$base_url."chat-box/viewer.php?url=".$base_url."chat-box/uploads/".$sub_folder."/".$_FILES['file_upload']['name']."\' target=\'_blank\'>".$_FILES['file_upload']['name']."</a>";

            $sql = "INSERT INTO ajax_chat_messages(bid_id, job_id, trans_id, `type`, `status`, jobname, userID, userName, channel, `dateTime`, text, ip) ";
            $sql .= "VALUES (".$_REQUEST['bid_id'].", ".$_REQUEST['job_id'].", ".$_REQUEST['trans_id'].", '".$_REQUEST['type']."', 'unread', '".$row[0]."', 1, 'Guest', 1, '".date('Y-m-d H:i:s')."', '".$message."', '".$_SERVER['REMOTE_ADDR']."')";

            mysql_query($sql);
        }
    } else {
        //set that to be the returned message
        $message = false;
    }
}

$ciadminId = $_REQUEST['ciadminId'] ? "&ciadminId=1" : "";
$url = $base_url . "chat-box/?bid_id=".$_REQUEST['bid_id']."&job_id=".$_REQUEST['job_id']."&trans_id=".$_REQUEST['trans_id']."&type=".$_REQUEST['type'].$ciadminId;
header('Location: '.$url);