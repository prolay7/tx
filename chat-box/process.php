<?php
include('database.php');

$base = '';
$base = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base .= "://" . $_SERVER['HTTP_HOST'];
$base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$base .= '../';
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] != '') {
    $current_admin_id = $_SESSION['admin_id'];
} else {
    if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'admin') {
        echo json_encode(false);
        exit();
    }
}

date_default_timezone_set('America/New_York');

$function = $_POST['function'];

$log = array();


switch ($function) {

    case('getState'):

        $log['state'] = 0;

        break;

    case('update'):


        $state = $_REQUEST['state'];

        $bid_id = mysql_real_escape_string($_REQUEST['bid_id']);

        $job_id = mysql_real_escape_string($_REQUEST['job_id']);

        $trns_id = mysql_real_escape_string($_POST['trns_id']);

        $type = mysql_real_escape_string($_REQUEST['type']);


        $sqlci = "SELECT * FROM `ci_sessions` ";
        //echo $sqlci;

        $queryci = mysql_query($sqlci);


        $rows = array();
        while ($fetchci = mysql_fetch_array($queryci)) {
            $user_data = $fetchci['user_data'];
            $user_datas = unserialize($user_data);

            //echo "<pre>";print_r($user_datas);
            array_push($rows, $user_datas['translator_id']);

        }

        array_filter($rows);
        $array2 = array();
        foreach ($rows as $row) {
            if ($row !== null)
                $array2[] = $row;
        }
        $array = $array2;

        //echo "<pre>";print_r($array);
        $arr_str = "'" . implode("','", $array) . "'";
        //echo $arr_str;
        if (in_array($trans_id, $array)) {
            //echo "Got Irix";
        } else {
            $sql2 = "SELECT * FROM `ajax_chat_messages`  WHERE `status`='unread' AND `job_id`='" . $job_id . "' AND `bid_id`='" . $bid_id . "'  AND `trans_id`='" . $trans_id . "' AND `type`='admin'";
            //echo $sql2;
            $result2 = mysql_query($sql2);
            $num_rows = mysql_num_rows($result2);
            if ($num_rows > 0) {
                $sql_trans = "SELECT * FROM `translator` WHERE `id`='" . $trans_id . "'";
                $querytrans = mysql_query($sql_trans);
                $fetchtrans = mysql_fetch_object($querytrans);
                $tomail = $fetchtrans->email_address;
                $name = $fetchtrans->first_name . " " . $fetchtrans->last_name;

                $sql_job = "SELECT * FROM `jobpost` WHERE `id`='" . $job_id . "'";
                $queryjob = mysql_query($sql_job);
                $fetchjob = mysql_fetch_object($queryjob);
                $jobname = $fetchjob->name;

                $to = $tomail;
                //$to="anishabarman@theismtech.com";
                $subject = "Message Notification";


                $url = $base . "chat-box/?bid_id=" . $bid_id . "&job_id=" . $job_id . "&trans_id=" . $trans_id . "&type=user";
                $message = '
					
					<tr style="width:100%;margin:0;padding:0">
					<td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
					<p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
					  Dear <strong> ' . $name . '  </strong>
					
					</p>
					<table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">          
					<thead>
					<tr>
					<th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:100%;font-size:13px"> TRANSLATOR EXCHANGE</th>
					
					</tr>
					</thead>     
					</table>       
					
					<table style="width:636px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left;border: 1px solid rgb(32, 140, 229);  margin-left: 2.5px; margin-top: -2px;">
					
					<tbody>
					<tr>
					<td style="background:#efefef;padding:10px;color:#003366"> You have a new message for job : ' . $jobname . '
					</td>                                                   
					
					</tr>
					<tr>
					                                               
					<td style="background:#efefef;padding:10px;color:#003366">View :  <a href="' . $url . '">MESSAGE</a> for ' . $jobname . '
					</td> 
					</tr>
					
					</tbody>
					</table>
					';

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <contact@theismtech.info>' . "\r\n";

                mail($to, $subject, $message, $headers);
            }

        }


        $sql2 = "UPDATE `ajax_chat_messages` SET `status`='read' WHERE `job_id`='" . $job_id . "' AND `bid_id`='" . $bid_id . "' AND `type`!='" . $type . "'";

        $result2 = mysql_query($sql2);

        $sql = "SELECT * FROM `ajax_chat_messages` WHERE `job_id`='" . $job_id . "' AND `bid_id`='" . $bid_id . "'  AND `trans_id`='" . $trns_id . "' ";

        //$sql = "SELECT * FROM `ajax_chat_messages`";

        $result = mysql_query($sql);

        $count = mysql_num_rows($result);

        $log['testdata'] = $state . '==' . $count;

        if ($state == $count) {

            $log['state'] = $state;

            $log['text'] = false;

        } else {

            $text = array();

            $log['state'] = $state + $count - $state;

            $i = 0;

            $j = 0;

            $oldmsgdate = 0;

            //$sameuser='display: block';

            $line_num = 0;

            if (mysql_num_rows($result) > 0) {

                while ($row = mysql_fetch_assoc($result)) {

                    $line_num++;

                    if ($line_num > $state) {

                        //$text[] =  '<span>Guest</span>'.$row["text"];

                        if ($row["type"] == 'admin') {
                            if ($row['admin_id'] == '') {
                                $sql1 = "SELECT * FROM `admin` WHERE `id` = 1";
                                $user_type = 1;
                            } else {
                                $sql1 = "SELECT * FROM `admin` WHERE `id` = " . $row['admin_id'];
                                $user_type = 0;
                            }

                            $authImg = "http://" . $_SERVER['HTTP_HOST'] . "/chat-box/assets/img/admin-button-icon-md.png";

                        } else {

                            $sql1 = "SELECT * FROM `translator` WHERE `id` ='" . $trns_id . "' ";
                            $user_type = 2;
                            $result1 = mysql_query($sql1);
                            if (mysql_num_rows($result1) == 0 && $row['type'] == 'admin') {
                                $sql1 = "SELECT * FROM `admin` WHERE `id` = 1";
                                $user_type = 1;
                                $result1 = mysql_query($sql1);
                            }
                            $row1 = mysql_fetch_assoc($result1);

                            $row1["images"];

                            if ($row1["images"] != "") {

                                $authImg = "http://" . $_SERVER['HTTP_HOST'] . "/uploads/translator/profile/" . $row1["images"];

                            } else {

                                $authImg = "http://" . $_SERVER['HTTP_HOST'] . "/chat-box/assets/img/user-image-with-black-background_318-34564.png";

                            }

                        }

                        $result1 = mysql_query($sql1);

                        $row1 = mysql_fetch_assoc($result1);

                        if ($row['type'] == $type) {

                            $cls = 'right';

                            $fullcls = 'full_div_chat';

                            $i = $i + 1;

                            $j = 0;

                        } else {

                            $i = 0;

                            $j = $j + 1;

                            $cls = 'left';

                            $fullcls = 'full_div_white';

                        }
                        $msgdate = date_create($row["dateTime"]);

                        $chkdate = date_format($msgdate, 'mdyhi');

                        $mgdat = date_format($msgdate, 'M,d,y');

                        $mgdate1 = date_format($msgdate, 'g:iA');
                        if ($user_type == 0) {
                            $user_type = $row1['admin_type'];
                        }
                        switch ($user_type) {
                            case 1:
                                $user_type = 'Super Admin';
                                break;
                            case 2:
                                $user_type = 'Translator';
                                break;
                            case 3:
                                $user_type = 'Customer Service';
                                break;
                            case  4:
                                $user_type = 'Project Coordinator';
                                break;
                            case 5:
                                $user_type = 'Project Manager';
                                break;
                            default:
                                $user_type = 'Super Admin';
                        }

                        if (($i > 1 and $cls == 'right') or ($j > 1 and $cls == 'left')) {

                            if ($chkdate == $oldmsgdate) {

                                $AuthorDetails = '<div class="' . $fullcls . '"><div class="chat-box-name-' . $cls . '" style="position: relative;    padding-bottom: 9px;"></div>';

                                $AuthorMsg = '<div class="chat-box-' . $cls . '">' . $row["text"] . '</div>';

                                $msgdat = '</div>';

                                //$text[] =  $AuthorDetails . $AuthorMsg . $msgdat;

                            } else {

                                $AuthorDetails = '<div class="' . $fullcls . '"><div class="chat-box-name-' . $cls . '" style="position: relative;"></div>';

                                $AuthorMsg = '<div class="chat-box-' . $cls . '">' . $row["text"] . '</div>';

                                $msgdat = '<div class="fullchat_date">' . $mgdat . '<br>' . $mgdate1 . '</div></div>';

                                //$text[] =  $AuthorDetails . $AuthorMsg . $msgdat;

                            }

                        } else {

                            if ($chkdate == $oldmsgdate) {

                                $AuthorDetails = '<div class="' . $fullcls . '"><div class="chat-box-name-' . $cls . '" style="position: relative;">' . $row1["first_name"] . ' ' . $row1["last_name"] . '<span class="text-sender-type">' . $user_type . '</span></div>';

                                $AuthorMsg = '<div class="chat-box-' . $cls . '">' . $row["text"] . '</div>';

                                $msgdat = '</div>';

                                //$text[] =  $AuthorDetails . $AuthorMsg . $msgdat;

                            } else {

                                $AuthorDetails = '<div class="' . $fullcls . '"><div class="chat-box-name-' . $cls . '" style="position: relative;">' . $row1["first_name"] . ' ' . $row1["last_name"] . '<span class="text-sender-type">' . $user_type . '</span></div>';

                                $AuthorMsg = '<div class="chat-box-' . $cls . '">' . $row["text"] . '</div>';

                                $msgdat = '<div class="fullchat_date">' . $mgdat . '<br>' . $mgdate1 . '</div></div>';

                                //$text[] =  $AuthorDetails . $AuthorMsg . $msgdat;

                            }

                        }

                        $oldmsgdate = $chkdate;

                        $text[] = $AuthorDetails . $AuthorMsg . $msgdat;
                    }

                }

            }

            $log['text'] = $text;
        }

        break;


    case('send'):


        $bid_id = mysql_real_escape_string($_REQUEST['bid_id']);

        $job_id = mysql_real_escape_string($_REQUEST['job_id']);

        $trns_id = mysql_real_escape_string($_POST['trns_id']);

        $type = mysql_real_escape_string($_REQUEST['type']);


        /*$bid_id = $_REQUEST['bid_id'];

        $job_id = $_REQUEST['job_id'];

        $trns_id = $_REQUEST['trns_id'];

        $type = $_REQUEST['type'];*/

        /*$bid_id = '42'; //$_POST['bid_id'];

        $job_id = '59'; //$_POST['job_id'];

        $trns_id = '25'; //$_POST['trns_id'];

        $type = $_REQUEST['type'];*/


        $nickname = htmlentities(strip_tags($_POST['nickname']));

        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        $msg = mysql_real_escape_string($_POST['message']);

        $message = htmlentities(strip_tags($msg));

        $datetime = date('Y-m-d G:i:s');

        if (($message) != "\n") {

            if (preg_match($reg_exUrl, $message)) {

                $link = explode("/", $message);
                $file = end($link);
                $file_dir = prev($link);

                $link1 = substr($file, 3);
                $date = strtotime($datetime);
                $data_id = ($type == 'admin') ? $current_admin_id : $trns_id;
                $message = '<span><a href="' . $message . '" target="_blank">' . $link1 . '</a>&emsp;<a title="Delete" data-dir="' . $file_dir . '" data-file="' . $file . '" data-datetime = "' . $date . '" data-id="' . $data_id . '" data-type="' . $type . '" onclick="chat_img_delete(this)" class="uploads" href="javascript:void(0);"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color: #66e203"></i></a></span>';

            }

            $sqljob = "select * from jobpost where id=$job_id";

            $res = mysql_query($sqljob);

            $fetch = mysql_fetch_assoc($res);

            $job_name = $fetch['name'];
            if ($type == 'admin') {
                $sql = "INSERT INTO `ajax_chat_messages` (`bid_id`,`job_id`,`trans_id`,`type`,`status`,`jobname`,`userID`, `userName`, `channel`, `dateTime`, `ip`, `text`,`admin_id`) VALUES ('" . $bid_id . "','" . $job_id . "','" . $trns_id . "','" . $type . "','unread','" . $job_name . "','1', '" . $nickname . "', '1', '" . $datetime . "', '127.0.01', '" . $message . "'," . $current_admin_id . ")";

            } else {
                $sql = "INSERT INTO `ajax_chat_messages` (`bid_id`,`job_id`,`trans_id`,`type`,`status`,`jobname`,`userID`, `userName`, `channel`, `dateTime`, `ip`, `text`) VALUES ('" . $bid_id . "','" . $job_id . "','" . $trns_id . "','" . $type . "','unread','" . $job_name . "','1', '" . $nickname . "', '1', '" . $datetime . "', '127.0.01', '" . $message . "')";
            }
            $query = mysql_query($sql);
            //mail("shayanisanyal@theismtech.com","My subject","hello");


        }

        break;

}


echo json_encode($log);


?>

