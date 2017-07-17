﻿<?php session_start();
?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <title>Translation Exchange</title>

    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>

    <!-- FONT AWESOME  CSS -->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>

    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet"/>

    <!-- uploadify STYLE CSS -->
    <link rel="stylesheet" type="text/css" href="uploadify.css">

    <script>
        var hasFlash = false;
        try {
            hasFlash = Boolean(new ActiveXObject('ShockwaveFlash.ShockwaveFlash'));
        } catch (exception) {
            hasFlash = ('undefined' != typeof navigator.mimeTypes['application/x-shockwave-flash']);
        }
    </script>

    <?php

    $base = '';
    $base = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base .= "://" . $_SERVER['HTTP_HOST'];
    $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $base .= '../';
    
    //$base='http://'.$_SERVER['HTTP_HOST'].'/TranslatorExchange/';
    ?>
    <style media="screen">
        #dynamic-table {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #393939;
            line-height: 1.5;

        }

        .myButton {
            -moz-box-shadow: 0px 1px 0px 0px #fff6af;
            -webkit-box-shadow: 0px 1px 0px 0px #fff6af;
            box-shadow: 0px 1px 0px 0px #fff6af;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffec64), color-stop(1, #ffab23));
            background: -moz-linear-gradient(top, #ffec64 5%, #ffab23 100%);
            background: -webkit-linear-gradient(top, #ffec64 5%, #ffab23 100%);
            background: -o-linear-gradient(top, #ffec64 5%, #ffab23 100%);
            background: -ms-linear-gradient(top, #ffec64 5%, #ffab23 100%);
            background: linear-gradient(to bottom, #ffec64 5%, #ffab23 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffec64', endColorstr='#ffab23', GradientType=0);
            background-color: #ffec64;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            border: 1px solid #ffaa22;
            display: inline-block;
            cursor: pointer;
            color: #333333;
            font-family: Arial;
            font-size: 16px;
            font-weight: bold;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffee66;
        }

        .myButton:hover {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffab23), color-stop(1, #ffec64));
            background: -moz-linear-gradient(top, #ffab23 5%, #ffec64 100%);
            background: -webkit-linear-gradient(top, #ffab23 5%, #ffec64 100%);
            background: -o-linear-gradient(top, #ffab23 5%, #ffec64 100%);
            background: -ms-linear-gradient(top, #ffab23 5%, #ffec64 100%);
            background: linear-gradient(to bottom, #ffab23 5%, #ffec64 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffab23', endColorstr='#ffec64', GradientType=0);
            background-color: #ffab23;
        }

        .myButton:active {
            position: relative;
            top: 1px;
        }

        .ui-dialog {
            z-index: 1000000000;
            top: 0;
            left: 0;
            margin: auto;
            position: fixed;
            max-width: 100%;
            max-height: 100%;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

    </style>

    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/jquery-ui-1.12.1.min.css"/>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/ace.simplified.css"/>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/bootstrap-grid.css"/>

	<input type="hidden" name="modal_trigger" value="<?php echo (isset($_GET['modal_trigger']) && $_GET['modal_trigger']!= '')?'yes':'no'; ?>">
	
    <?php
    $job_id = $_REQUEST['job_id'];
    $bid_id = $_REQUEST['bid_id'];
    $trans_id = $_REQUEST['trans_id'];
    $type = $_REQUEST['type'];
    if (isset($_SESSION['admin_id']) == false || $_SESSION['admin_id'] == null) {
        $ciadminId = isset($_REQUEST['ciadminId']) ? $_REQUEST['ciadminId'] : '';
        $_SESSION['admin_id'] = $ciadminId;
    } else {
        $ciadminId = $_SESSION['admin_id'];
    }
    $auto = isset($_REQUEST['auto']) ? $_REQUEST['auto'] : '';

    include('database.php');


    $sql1 = "SELECT * FROM `translator` WHERE  id = '$trans_id' ";
    $results1 = mysql_query($sql1);


    if (mysql_num_rows($results1) > 0) {
        $result_arr1 = mysql_fetch_object($results1);
        $translator = $result_arr1->first_name;
    } else {
        $translator = 'You';
    }

    if ($type == "user") {
        $cisess_cookie = $_COOKIE['ci_session'];
        $cisess_cookie = stripslashes($cisess_cookie);
        $cisess_cookie = unserialize($cisess_cookie);
        $cisess_session_id = $cisess_cookie['session_id'];

        if ($cisess_session_id != '') {
            $sqlci = "SELECT * FROM `ci_sessions` WHERE `session_id`='" . $cisess_session_id . "' ";
            $queryci = mysql_query($sqlci);
            $fetchci = mysql_fetch_array($queryci);
            $user_data = $fetchci['user_data'];
            $user_datas = unserialize($user_data);
            if ($user_datas['translator_id'] != $trans_id) {
                echo '<script>window.location="' . $base . 'translator/login";</script>';
                die;
            }


            $sql_com = "SELECT * FROM bidjob WHERE trans_id = '" . $trans_id . "' AND id = '" . $bid_id . "' AND job_id ='" . $job_id . "' AND stage=1";
            $val_com = mysql_query($sql_com);
            $count1 = mysql_num_rows($val_com);
        } else {
            echo '<script>window.location="' . $base . 'translator/logout";</script>';
            die;
        }

    }
    $sql = "UPDATE bidjob SET show_notification = 0 WHERE id = {$bid_id}";
    mysql_query($sql);

    $sql = "SELECT * FROM jobpost WHERE id = {$job_id}";
    $jobpost_qry = mysql_query($sql);
    $jobpost = mysql_fetch_assoc($jobpost_qry);

    if ($jobpost['proofread_required'] == 1) {
        $sql = "SELECT *, p2.id AS proofread_job_doc_id ";
        $sql .= "FROM bidjob b1 ";
        $sql .= "  JOIN jobpost j ON j.id = b1.job_id ";
        $sql .= "  JOIN bidjob_details b2 ON b2.bidjob_id = b1.id ";
        $sql .= "  JOIN proofread_jobs p1 ON p1.id = b2.proofread_doc_id ";
        $sql .= "  JOIN proofread_jobs_docs p2 ON p2.proofread_job_id = p1.id ";
        $sql .= "  JOIN proofread_jobs_awarded p3 ON p3.proofread_doc_id = p2.id ";
        $sql .= "WHERE ";
        $sql .= " b1.awarded = 1 AND ";
        $sql .= " p3.proofreader_id = {$trans_id} AND ";
        $sql .= " b1.id = {$bid_id} AND ";
        $sql .= " p2.is_awarded = 1 ";
        $sql .= "GROUP BY p2.id ";
        $sql .= "ORDER BY p2.doc_order ASC";
    } else {
        $sql = "SELECT *, b1.stage as bid_stage ";
        $sql .= "FROM bidjob b1 ";
        $sql .= "  JOIN jobpost j ON j.id = b1.job_id ";
        $sql .= "WHERE ";
        $sql .= " b1.awarded = 1 AND ";
        $sql .= " b1.trans_id = {$trans_id} AND ";
        $sql .= " b1.id = {$bid_id} ";
    }
    $awarded = mysql_query($sql);


    $sql2 = "SELECT * FROM cms WHERE id = '2'";
    $val2 = mysql_query($sql2);
    $fetch2 = mysql_fetch_assoc($val2);

    $sql3 = "SELECT * FROM cms WHERE id = '3'";
    $val3 = mysql_query($sql3);
    $fetch3 = mysql_fetch_assoc($val3);

    $sql4 = "SELECT * FROM cms WHERE id = '6'";
    $val4 = mysql_query($sql4);
    $fetch4 = mysql_fetch_assoc($val4);

    $sql5 = "SELECT * FROM settings WHERE id = '1'";
    $val5 = mysql_query($sql5);
    $fetch5 = mysql_fetch_assoc($val5);

    $sql6 = "SELECT * FROM translator WHERE id = '" . $trans_id . "'";
    $val6 = mysql_query($sql6);
    $fetch6 = mysql_fetch_assoc($val6);
    $fetch6['images'];

    $total_rows = 0;
    ?>

    <script type="text/javascript">
        var job_id = '<?php echo $job_id;?>';
        var bid_id = '<?php echo $bid_id; ?>';
        var trns_id = '<?php echo $trans_id; ?>';
        var type = '<?php echo $type; ?>';
    </script>


    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="<?php echo $base; ?>assets/js/jquery-ui.custom.js"></script>
    <script src="<?php echo $base; ?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript">
        //    jQuery(document).ready(function(){
        //         get_not();
        //    });
        //
        //    function get_not() {
        //        $.ajax({
        //            type: "POST",
        //            url: "<?php //echo $base; ?>//" + "translator/notification",
        //            success: function (data, textStatus){
        //                setTimeout(function(){get_not();}, 5000);
        //                $('#noti').html(data);
        //            }
        //        });
        //    }
    </script>
</head>


<body onLoad="setInterval('chat.update(job_id, bid_id, trns_id, type)', 1000)">
<div class="altter-header">
    <div class="container">
        <div class="logo-alter">
            <?php if ($type == "admin") { ?>
                <a href="<?php echo $base; ?>dashboard/index"><img src="<?php echo $base; ?>includes/images/Logo.png"
                                                                   width="205" height="50" alt="logo"></a>
            <?php } else { ?>
                <a href="<?php echo $base; ?>translator/dashboard"><img
                            src="<?php echo $base; ?>includes/images/Logo.png" width="205" height="50" alt="logo"></a>
            <?php } ?>
        </div>

        <div class="alter-menu">
            <nav role="navigation" class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collection of nav links and other content for toggling -->
                <!--<div id="navbarCollapse" class="collapse navbar-collapse">-->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="javascript:void(0)">Welcome, <?php echo $translator; ?></a></li>

                        <?php if ($ciadminId != '') { ?>

                            <li>
                                <a href="<?php echo $base; ?>dashboard/">My Account</a></li>
                            <?php
                            $adminmsg = mysql_query("SELECT * FROM `ajax_chat_messages` WHERE `status` = 'unread' AND `type`= 'user'");
                            $total_rows = mysql_num_rows($adminmsg);
                            ?>

                            <li class="dropdown"><span class="dropbtn">
                    <a href="<?php echo $base . 'admin/messages'; ?>">Message(<div id="noti"
                                                                                   style="display: inline-block; padding-bottom:5px;"><?php echo $total_rows ?></div>)</a></span>
                            </li>

                            <li>
                                <a href="javascript: void(0)" id="ace-support-btn" class="myButton"
                                   style="top: 19px; display: inline"><i class="ace-icon fa fa-life-ring bigger-130"
                                                                         style="margin-right: 5px;"></i>Report Technical
                                    Issue</a>
                            </li>
                            <li><a href="<?php echo $base; ?>admin/logout">Logout</a></li>

                        <?php } else {
                            $adminmsg = mysql_query("SELECT * FROM ajax_chat_messages  WHERE ajax_chat_messages.status = 'unread' AND ajax_chat_messages.type = 'admin' AND ajax_chat_messages.type= 'admin' AND ajax_chat_messages.trans_id= " . $trans_id . " AND ajax_chat_messages.bid_id IN (SELECT bidjob.id FROM bidjob WHERE bidjob.trans_id = " . $trans_id . ")");
                            $total_rows = mysql_num_rows($adminmsg);

                            ?>
                            <li class="drpdn"><a href="<?php echo $base; ?>translator/dashboard">My Account</a>
                                <ul class="acddr">
                                    <li><a href="<?php echo $base; ?>translator/dashboard" target="_blank">Dashboard</a>
                                    </li>
                                    <li><a href="<?php echo $base; ?>translator/changeprofile" target="_blank">Edit
                                            Profile</a></li>
                                    <li><a href="<?php echo $base; ?>translator/changeprofilepicture" target="_blank">
                                            Profile Picture</a></li>
                                    <li><a href="<?php echo $base; ?>translator/changepassword" target="_blank">Change
                                            Password </a></li>
                                    <li><a href="<?php echo $base; ?>translator/proposal" target="_blank">Proposals </a>
                                    </li>
                                    <li><a href="<?php echo $base; ?>translator/award" target="_blank">My Works</a></li>
                                    <li><a href="<?php echo $base; ?>translator/invoice" target="_blank"> Invoice</a>
                                    </li>
                                    <li><a href="<?php echo $base; ?>translator/paypal" target="_blank">Paypal Info</a>
                                    </li>

                                </ul>
                            </li>

                            <li><a href="<?php echo $base; ?>translator/chat">Message (
                                    <div id="noti"
                                         style="display: inline-block; padding-bottom:5px;"><?php echo $total_rows ?></div>
                                    )</a></li>
                            <li>
                                <a href="javascript: void(0)" class="myButton"><i
                                            class="ace-icon fa fa-life-ring bigger-130" style="margin-right: 5px;"></i>Report
                                    Technical Issue</a>
                            </li>
                            <li><a href="<?php echo $base; ?>translator/logout">Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>


        </div>

    </div>

</div>

<?php
// $awarded_obj = mysql_fetch_array($awarded);
$counter = 0;
$awarded_obj = [];
while ($row = mysql_fetch_assoc($awarded)) {
    $awarded_obj[$counter] = $row;
    $counter++;
}
// echo '<pre>'; print_r($awarded_obj); exit;

if ($type == 'admin') {
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS translator_name FROM translator WHERE id = {$trans_id}";
    $query = mysql_query($sql);

    $translator_obj = mysql_fetch_assoc($query);
}

$awarded_obj_count = count($awarded_obj);
$width = (empty($awarded_obj) == false and $awarded_obj[0]['proofread_required'] and $awarded_obj[0]['translator_id'] != '') ? 'style="width: 1570px"' : '';
$main_container_class = (empty($awarded_obj) == false and $awarded_obj[0]['proofread_required'] and $awarded_obj[0]['translator_id'] != '') ? 'col-lg-7' : 'col-lg-12';
$chat_box_width = (empty($awarded_obj) == false and $awarded_obj[0]['proofread_required'] and $awarded_obj[0]['translator_id'] != '') ? 'style="width: 100%"' : '';

$translator_name = isset($translator_obj) ? $translator_obj['translator_name'] : 'you';
$translators = '';
$job_name = (!empty($awarded_obj)) ? $awarded_obj[0]['name'] : '';
?>

<style media="screen">
    .jobs-awarded-title {
        font-weight: bold;
        display: block;
        margin-bottom: 7px;
    }
</style>

<div class="container">
    <?php
if ($type !== 'admin') {
   // if (empty($awarded_obj) != true && $awarded_obj[0]['proofread_required'] == '0') {
    if (empty($awarded_obj) != true ) {
        ?>
        <div class="col-lg-12">
            <div style="width: 80%; margin: 0 auto; padding-bottom: 10px" id="chat-wrap"><a
                        href="<?php echo $base; ?>job_details/index/<?php echo $_GET["job_id"]; ?>/<?php echo $_GET["trans_id"]; ?>"
                        class="btn btn-default" target="_blank"> Click here to access files, please confirm with admin
                    so you only translate the files that were assigned to you</a></div>
        </div>
    <?php }} ?>


    <div class="row pad-bottom">
        <?php if (empty($awarded_obj) == false and $awarded_obj[0]['proofread_required'] and $awarded_obj[0]['translator_id'] != '') { ?>

            <div class="col-lg-5">
                <span class="jobs-awarded-title">Files that have been awarded to <?php echo $translator_name ?> </span>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th class="center">Original File</th>
                        <th class="center">Translated File</th>
                        <th class="center">Date Awarded</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($awarded_obj_count) { ?>
                        <?php foreach ($awarded_obj as $id => $awarded) {
                            $original = explode('/', $awarded['original_file']);
                            $translated = explode('/', $awarded['translated_file']);
                            $translators .= "{$awarded['translator_id']},";
                            ?>
                            <tr>
                                <td><?php echo $awarded['doc_order'] ?></td>
                                <td>
                                    <a href="<?php echo $base . 'chat-box/viewer.php?id=' . $awarded['proofread_job_doc_id'] . '&type=review&field=original_file' ?>"
                                       target="_blank"><?php echo $original[1] ?></a></td>
                                <td>
                                    <a href="<?php echo $base . 'chat-box/viewer.php?id=' . $awarded['proofread_job_doc_id'] . '&type=review&field=translated_file' ?>"
                                       target="_blank"><?php echo $translated[1] ?></a></td>

                                <!-- <td><a href="<?php echo $base . 'uploads/review/' . $awarded['original_file'] ?>" target="_blank"><?php echo $original[1] ?></a></td> -->
                                <!-- <td><a href="<?php echo $base . 'uploads/review/' . $awarded['translated_file'] ?>" target="_blank"><?php echo $translated[1] ?></a></td> -->
                                <td><?php echo date('jS M Y H:i', strtotime($awarded['award_date'])) ?> <a
                                            href="javascript:void(0);" onclick="imagemodal(<?php echo $awarded['proofread_job_doc_id']; ?>)" class="pull-right"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
                        <?php } ?>
                        <?php
                    }
                    $translators = trim($translators, ',');
                    ?>
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="translators" value="<?php echo $translators ?>"/>
        <?php } ?>

        <div class="<?php echo $main_container_class ?>">

            <div class="chat-box-div" id="chat-wrap" <?php echo $chat_box_width ?>>
                <div class="chat-box-head" id="projectName">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%; text-align: left; color: #ffffff;">
                                <?php echo $translator_name ?>
                            </td>
                            <td style="width: 50%; text-align: center; color: #ffffff;">
                                <?php
                                $sql = "SELECT * FROM `jobpost` WHERE `id`='" . $job_id . "'";
                                $result = mysql_query($sql);
                                $row = mysql_fetch_assoc($result);
                                // echo $row['name'] . ' / ' . $row['lineNumberCode'];
                                if ($row['name'] == "") {
                                    echo 'Job Manually Entered / ';
                                } else {
                                    echo $row['name'] . ' / ';
                                }

                                echo $row['lineNumberCode'];
                                ?>
                            </td>
                        </tr>
                    </table>


                </div>

                <div class="panel-body chat-box-main" id="chat-area" style="min-height:500px;"></div>


                <form id="send-message-area" enctype="multipart/form-data"
                      action="<?php echo $base ?>chat-box/uploader.php" method="post">


                    <div class="chat-box-footer">


                        <div class="input-group">


                            <div class="col-md-9 col-sm-7 col-xs-12 nopad">


                                <textarea id="sendie" maxlength="1000" class="form-control"
                                          placeholder="Enter Text Here..."></textarea>


                                <button type="button" id="send" class="send" value="send">SEND</button>

                                <?php
                                // echo '<pre>'; print_r($awarded_obj); echo '</pre>';
                                // echo "done: {$awarded_obj[0]['is_done']}, rated: {$awarded_obj[0]['is_rated']}, type: {$type}, proofread: {$jobpost['proofread_required']}, awarded: {$awarded_obj[0]['awarded']}, stage: {$awarded_obj[0]['bid_stage']}<br/>";
                                ?>

                                <?php if (empty($awarded_obj) == false && $awarded_obj[0]['awarded'] == 1) { ?>

                                    <!-- default state -->
                                    <?php if ($awarded_obj[0]['is_done'] == 0 and $awarded_obj[0]['is_rated'] == 0) { ?>

                                        <?php if ($type == 'admin') { ?>
                                            <a href="javascript:void(0)" class="toggle-admin-rating modal_trigger"
                                               style="color: red; font-weight: bold;">CLICK HERE to mark job
                                                COMPLETED</a>
                                        <?php } ?>

                                        <?php if ($type == 'user') { ?>
                                            <a href="javascript:void(0)" class="doneWithJob modal_trigger"
                                               style="color: red; font-weight: bold;">CLICK HERE to mark job
                                                COMPLETED</a>
                                        <?php } ?>

                                    <?php } else if ($awarded_obj[0]['is_done'] == 1 and $awarded_obj[0]['is_rated'] == 1) { ?>

                                        <a href="javascript:void(0)" style="color: #333; font-weight: bold;">Job is
                                            completed</a>

                                    <?php } else if ($awarded_obj[0]['is_done'] == 1 and $awarded_obj[0]['is_rated'] == 0) { ?>

                                        <!-- admin -->
                                        <?php if ($type == 'admin' and $jobpost['proofread_required'] == -1 and $awarded_obj[0]['bid_stage'] == 1) { ?>
                                            <a href="javascript:void(0)" class="toggle-admin-rating modal_trigger"
                                               style="color: red; font-weight: bold;">Click here to verify completion,
                                                freelancer has already marked this completed</a>
                                        <?php } ?>

                                        <?php if ($type == 'admin' and $jobpost['proofread_required'] == -1 and $awarded_obj[0]['bid_stage'] == 2) { ?>
                                            <a href="javascript:void(0)" class="toggle-admin-rating modal_trigger"
                                               style="color: red; font-weight: bold;">Click here to verify completion,
                                                freelancer has already marked this completed</a>
                                        <?php } ?>

                                        <?php if ($type == 'admin' and $jobpost['proofread_required'] == -1 and $awarded_obj[0]['bid_stage'] == 3) { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">Job
                                                is completed</a>
                                        <?php } ?>

                                        <?php if ($type == 'admin' and $jobpost['proofread_required'] == 0) { ?>
                                            <a href="javascript:void(0)" class="toggle-admin-rating modal_trigger"
                                               style="color: red; font-weight: bold;">Click here to verify completion,
                                                freelancer has already marked this completed</a>
                                        <?php } ?>

                                        <?php if ($type == 'admin' and $jobpost['proofread_required'] == 1) { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">The
                                                admin has marked completed, need freelancer rating to proceed</a>
                                        <?php } ?>

                                        <!-- user -->
                                        <?php if ($type == 'user' and $jobpost['proofread_required'] == -1 and $awarded_obj[0]['bid_stage'] == 1) { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">The
                                                admin needs to verify completion</a>
                                        <?php } ?>

                                        <?php if ($type == 'user' and $jobpost['proofread_required'] == -1 and $awarded_obj[0]['bid_stage'] == 2) { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">The
                                                admin needs to verify completion</a>
                                        <?php } ?>

                                        <?php if ($type == 'user' and $jobpost['proofread_required'] == -1 and $awarded_obj[0]['bid_stage'] == 3) { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">Job
                                                is completed</a>
                                        <?php } ?>

                                        <?php if ($type == 'user' and $jobpost['proofread_required'] == 0) { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">The
                                                admin needs to verify completion</a>
                                        <?php } ?>

                                        <?php if ($type == 'user' and $jobpost['proofread_required'] == 1) { ?>
                                            <a href="javascript:void(0)" class="doneWithJob modal_trigger"
                                               style="color: red; font-weight: bold;">CLICK HERE to mark job
                                                COMPLETED</a>
                                        <?php } ?>

                                    <?php } else if ($awarded_obj[0]['is_done'] == 0 and $awarded_obj[0]['is_rated'] == 1) { ?>

                                        <?php if ($type == 'admin') { ?>
                                            <a href="javascript:void(0)" class="toggle-admin-rating modal_trigger"
                                               style="color: red; font-weight: bold;">Click here to verify completion,
                                                freelancer has already marked this completed</a>
                                        <?php } ?>

                                        <?php if ($type == 'user') { ?>
                                            <a href="javascript:void(0)" style="color: #333333; font-weight: bold;">The
                                                admin needs to verify completion</a>
                                        <?php } ?>

                                    <?php } else { ?>

                                        <!-- nothing to show here -->

                                    <?php } ?>

                                <?php } else { ?>

                                    <!-- unwarded nothing to show here -->

                                <?php } ?>

                            </div>


                            <div id="flash-uploader" class="col-md-3 col-sm-5 col-xs-12 ttalc nopad1">
                                <span class="input-group-btn">
                                    <div id="queue"></div>
                                    <input id="file_upload" name="file_upload" type="file" multiple/>
                                </span>

                            </div>

                            <div id="basic-uploader" class="col-md-3" style="display: none;">
                                <input type="file" id="file_upload" name="file_upload"/>
                                <input type="submit" id="btn-upload" value="Upload"/>

                                <input type="hidden" name="bid_id" value="<?php echo $bid_id ?>"/>
                                <input type="hidden" name="job_id" value="<?php echo $job_id ?>"/>
                                <input type="hidden" name="trans_id" value="<?php echo $trans_id ?>"/>
                                <input type="hidden" name="type" value="<?php echo $type ?>"/>
                                <input type="hidden" name="ciadminId" value="<?php echo $ciadminId ?>"/>
                            </div>


                        </div>


                    </div>


                </form>


            </div>


        </div>


    </div>


</div>


<div class="footer-alter">


    <div class="container">


        <div class="copytext-alt">Copyright 2015 <a href="<?php echo $base; ?>">Translation</a> | All Rights Reserved |
            Design by <a href="<?php echo $base; ?>">Translation</a></div>


        <div class="alter-socials">


            <ul>


                <li><a href="<?php echo $fetch5['facebook']; ?>" target="blank"> <i class="fa fa-facebook"></i> </a>
                </li>


                <li>
                    <a href="https://accounts.google.com/ServiceLogin?service=oz&amp;passive=1209600&amp;continue=https://plus.google.com/?gpsrc%3Dgplp0"
                       target="blank"> <i class="fa fa-google-plus"></i> </a></li>


                <li><a href="<?php echo $fetch5['twitter']; ?>" target="blank"> <i class="fa fa-twitter"></i> </a></li>


                <li><a href="https://instagram.com/" target="blank"> <i class="fa fa-instagram"></i> </a></li>


                <li><a href="https://pinterest.com/" target="blank"> <i class="fa fa-pinterest"></i> </a></li>


                <li><a href="<?php echo $fetch5['youtube']; ?>" target="blank"> <i class="fa fa-youtube"></i> </a></li>


            </ul>


        </div>


    </div>


</div>

<!--
<div class="ace-settings-container" id="ace-settings-container">
    <div class="btn btn-app btn-xs btn-default ace-settings-btn" id="ace-support-btn" style="width: 45px; height: 198px; font-size: 13px;">
        <i class="ace-icon fa fa-life-ring bigger-130" style="transform: rotate(-90deg); margin-top: 161px; width: 200px; margin-left: -86px; margin-top: 82px; color: #000000;">&nbsp;&nbsp;Report Technical Issue</i>
    </div>
</div>
-->


<!-- USING SCRIPTS BELOW TO REDUCE THE LOAD TIME -->


<!-- CORE JQUERY SCRIPTS FILE -->


<!-- CORE BOOTSTRAP SCRIPTS  FILE -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/chat.js"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">

    <?php
    $timestamp = time();
    $token = md5('unique_salt' . $timestamp);
    ?>

    var name = "Guest";
    var projectname = "Project Name";

    // strip tags
    name = name.replace(/(<([^>]+)>)/ig, "");


    // display name on page
    //$("#projectName").html(projectname);
    // kick off chat
    var chat = new Chat();
    $(function () {
        chat.getState(job_id, bid_id, trns_id, type);

        $('#send').on('click', function (e) {
            var job_id = '<?php echo $job_id;?>';
            var bid_id = '<?php echo $bid_id; ?>';
            var trns_id = '<?php echo $trans_id; ?>';
            var type = '<?php echo $type; ?>';
            var text = $('#sendie').val();

            if (text != "") {
                var maxLength = $('#sendie').attr("maxlength");
                var length = text.length;

                if (length <= maxLength + 1) {
                    chat.send(text, name, job_id, bid_id, trns_id, type);
                    $('#sendie').val("");
                } else {
                    $('#sendie').val(text.substring(0, maxLength));
                }

            } else {
                alert("message box is empty");
            }
        });

        // watch textarea for key presses

        /*     $("#sendie").keydown(function(event) {
         var key = event.which;
         //alert(event.keyCode);
         //all keys including return.

         if (key >= 33) {
         var maxLength = $(this).attr("maxlength");
         var length = this.value.length;

         // don't allow new content if length is maxed out
         if (length >= maxLength) {
         event.preventDefault();
         }
         }
         });



         // watch textarea for release of key press
         $('#sendie').keyup(function(event) {
         if (event.keyCode == 13) {
         var text = $(this).val();
         var maxLength = $(this).attr("maxlength");
         var length = text.length;

         //alert(text);
         // send
         if (length <= maxLength + 1) {
         chat.send(text, name, job_id, bid_id, trns_id, type);
         $(this).val("");
         } else {
         $(this).val(text.substring(0, maxLength));
         }
         }
         }); */

        $('#file_upload').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                'token': '<?php echo $token;?>'
            },
            'swf': 'uploadify.swf',
            'uploader': 'uploadify.php',
            'onUploadSuccess': function (file,data) {
                var file_name1 = data;
                var file_name = file_name1.slice(1, -1);
                var exts = ['jpg', 'jpeg', 'gif', 'png', 'doc', 'txt', 'docx', 'xls', 'xlsx', 'jar', 'zip', 'rar', 'pdf', 'ppt', 'pptx', 'ai'];
                var get_ext = file_name.split('.');

                get_ext = get_ext.reverse();

                if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
                    var uploadfile = '<?php echo $base; ?>chat-box/viewer.php?url=<?php echo $base;?>chat-box/uploads/<?php echo $timestamp;?>/' + file_name;
                    chat.send(uploadfile, 'Ujjwal', job_id, bid_id, trns_id, type);
                } else {
                    alert('This type of file is not allowed !!');
                }

//					/*var uploadfile = '<?php //echo $base_url;?>///uploads/<?php //echo $timestamp;?>///' + file.name;
                /*	chat.send(uploadfile, 'Ujjwal', job_id, bid_id, trns_id, type);*/
            }
        });
    });

    function GenerateFilename() {

    }
</script>

<script type="text/javascript">
    $(function () {
        startRefresh();
    });

    function startRefresh() {
        var id = <?php if (isset($ciadminId) && $ciadminId != '') {
                echo $ciadminId;
            } elseif (isset($trans_id) && $trans_id != '') {
                echo $trans_id;
            }
            ?>;
        var type = '<?php if (isset($ciadminId) && $ciadminId != '') {
            echo "user";
        } elseif (isset($trans_id) && $trans_id != '') {
            echo "admin";
        }
            ?>';
        $.get('message.php?ciadminId=' + id + '&type=' + type, function (data) {
            $('#noti').html(data);
        });
        setTimeout(startRefresh, 1000);
    }

    if (!hasFlash) {
        $('#basic-uploader').show();
        $('#flash-uploader').hide();
    } else {
        $('#basic-uploader').hide();
        $('#flash-uploader').show();
    }

</script>

<style type="text/css">
    .drpdn .acddr {
        display: none;
    }

    .drpdn:hover .acddr {
        display: block;
    }

    .acddr {
        position: absolute;
        z-index: 9999;
        background-color: #fff;
        padding: 10px 20px;
        min-width: 200px;
        border: 1px solid #CCC;
        border-radius: 2px;
    }

    .acddr li {
        list-style: none;
        padding-bottom: 8px;
    }

    .acddr li a {
        color: #000;
        font-size: 13px;
        text-decoration: none;
    }

    .acddr li a:hover {
        color: #5bbc2e;
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<link rel="stylesheet" href="/resources/demos/style.css">-->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php if ($jobpost['proofread_required'] and $awarded_obj[0]['review_stage'] > 0) { ?>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', ".doneWithJob", function () {
                $("#dialog-confirm").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        "Yes": function () {
                            $('#dialog-rating').dialog({
                                resizable: false,
                                height: "auto",
                                width: 600,
                                modal: false,
                                closeOnEscape: false,
                                open: function (event, ui) {
                                    $(".ui-dialog-titlebar-close").hide();
                                },
                                buttons: {
                                    "Submit": function () {
                                        $('#dialog-rating').dialog("close");

                                        var job_id = '<?php echo $job_id;?>';
                                        var bid_id = '<?php echo $bid_id; ?>';
                                        var trans_id = '<?php echo $trans_id ?>';
                                        var type = '<?php echo $type; ?>';

                                        $('input[type="radio"]:checked').each(function () {
                                            var rate = $(this).val();
                                            var doc = $(this).data('doc');
                                            var message = "Rating for  " + doc + ", " + rate + "/10";

                                            if (rate != undefined && doc != undefined) {
                                                chat.send(message, name, job_id, bid_id, trans_id, type);
                                            }
                                        });

                                        var q1 = $('input[name="q1"]:checked').val();
                                        var q2 = $('input[name="q2"]:checked').val();
                                        var q3 = $('input[name="q3"]:checked').val();
                                        var q4 = $('input[name="q4"]:checked').val();
                                        if (!q1 || !q2 || !q3 || !q4) return false;
                                        if (!q1) q1 = 'None';
                                        if (!q2) q2 = 'None';
                                        if (!q3) q3 = 'None';
                                        if (!q4) q4 = 'None';

                                        chat.send("Is all spelling and grammar now accurate? " + q1, name, job_id, bid_id, trans_id, type);
                                        chat.send("Has literal translation been avoided? " + q2, name, job_id, bid_id, trans_id, type);
                                        chat.send("Have numbers and money quantities been changed to match the target text style. " + q3, name, job_id, bid_id, trans_id, type);
                                        chat.send("Has the terminology been consistent throughout the text? " + q4, name, job_id, bid_id, trans_id, type);

                                        $.ajax({
                                            url: "<?php echo $base; ?>translator/jobIsDone",
                                            data: {
                                                data: <?php echo $job_id ?>,
                                                bidjob_id: <?php echo $bid_id ?>,
                                                translators: "<?php echo $translators ?>",
                                                count: <?php echo $awarded_obj_count ?> },
                                            type: 'post',
                                            dataType: 'json',
                                            success: function (response) {
                                                if (response == true) {
                                                    var $interval = setInterval(function () {
                                                        location.reload();
                                                    }, 1000);
                                                }
                                            }
                                        });
                                    },
                                    "Cancel": function () {
                                        $(this).dialog("close");
                                    }
                                }
                            });

                            $(this).dialog("close");
                        },
                        "No": function () {
                            $(this).dialog("close");
                        }
                    }
                });
            });

            $(".toggle-admin-rating").click(function () {
                <?php if ((!$awarded_obj[0]['is_done'] and !$awarded_obj[0]['is_rated']) or ($awarded_obj[0]['is_done'] and !$awarded_obj[0]['is_rated'])) { ?>
                $('#dialog-admin-notif').dialog({
                    resizable: false,
                    height: "auto",
                    width: 600,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        'Yes': function () {
                            $(this).dialog('close');

                            $.ajax({
                                url: "<?php echo $base ?>admin_review/admin_notif",
                                type: 'post',
                                data: {
                                    job_id: <?php echo $job_id ?>,
                                    bidjob_id: <?php echo $bid_id ?>,
                                    trans_id: "<?php echo $trans_id ?>"
                                },
                                success: function (response) {
                                    var $interval = setInterval(function () {
                                        var _url = window.location.href;
                                        var _new_url = _url.split('&adminnotif=1');

                                        window.location.href = _new_url[0];
                                    }, 1000);
                                }
                            });
                        },
                        'No': function () {
                            $(this).dialog('close');
                        }
                    }
                });
                <?php } else { ?>
                $('#dialog-confirm-completed').dialog({
                    resizable: false,
                    height: "auto",
                    width: 600,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        'Yes': function () {
                            $.ajax({
                                url: "<?php echo $base ?>" + "translator/admin_mark_proofread_job_complete",
                                type: 'post',
                                data: {
                                    job_id: <?php echo $job_id ?>,
                                    bidjob_id: <?php echo $bid_id ?>,
                                    trans_id: "<?php echo $trans_id ?>"
                                },
                                dataType: 'json',
                                success: function (response) {
                                    var job_id = '<?php echo $job_id;?>';
                                    var bid_id = '<?php echo $bid_id; ?>';
                                    var trans_id = '<?php echo $trans_id ?>';
                                    var type = '<?php echo $type; ?>';

                                    chat.send('Admin has marked job completed.', name, job_id, bid_id, trans_id, type);

                                    var $interval = setInterval(function () {
                                        location.reload();
                                    }, 1000);
                                }
                            });
                        },
                        'No': function () {
                            $(this).dialog('close');
                        }
                    }
                });
                <?php } ?>

            });

            var _type = "<?php echo $_GET['type'] ?>";
            var _admin_notif = "<?php echo (isset($_GET['adminnotif'])) ? $_GET['adminnotif'] : '' ?>";
            var _auto = "<?php echo (isset($_GET['auto'])) ? $_GET['auto'] : ''; ?>";

            if (_type == 'admin' && _admin_notif) {
                $('#dialog-admin-notif').dialog({
                    resizable: false,
                    height: "auto",
                    width: 600,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        'Yes': function () {
                            $(this).dialog('close');

                            $.ajax({
                                url: "<?php echo $base ?>admin_review/admin_notif",
                                type: 'post',
                                data: {
                                    job_id: <?php echo $job_id ?>,
                                    bidjob_id: <?php echo $bid_id ?>,
                                    trans_id: "<?php echo $trans_id ?>",
                                    mark_completed: 1
                                },
                                success: function (response) {
                                    var $interval = setInterval(function () {
                                        var _url = window.location.href;
                                        var _new_url = _url.split('&adminnotif=1');

                                        window.location.href = _new_url[0];
                                    }, 1000);
                                }
                            });
                        },
                        'No': function () {
                            $(this).dialog('close');
                        }
                    }
                });

                $('#proofreader-wrapper').text("<?php echo $translator_name?>");
                $('#job-title-wrapper').text("<?php echo $job_name ?>");
                $('#job-link').attr("href", "<?php echo $base ?>chat-box/?bid_id=<?php echo $bid_id ?>&job_id=<?php echo $job_id ?>&trans_id=<?php echo $trans_id ?>&type=user&auto=<?php echo $trans_id ?>");
            }

            if (_type == 'user' && _auto) {
                $('.doneWithJob').trigger('click');
            }
        });
    </script>
<?php } elseif ($jobpost['proofread_required'] and $awarded_obj[0]['review_stage'] == 0) { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.toggle-admin-done', function () {
                $.ajax({
                    url: "<?php echo $base ?>translator/admin_marked_completed",
                    data: {
                        job_id: <?php echo $job_id ?>,
                        bidjob_id: <?php echo $bid_id ?>,
                        trans_id: "<?php echo $trans_id ?>"
                    },
                    type: 'post',
                    success: function (response) {
                        var job_id = '<?php echo $job_id;?>';
                        var bid_id = '<?php echo $bid_id; ?>';
                        var trans_id = '<?php echo $trans_id ?>';
                        var type = '<?php echo $type; ?>';

                        chat.send('Admin has marked job completed.', name, job_id, bid_id, trans_id, type);

                        var $interval = setInterval(function () {
                            var _url = window.location.href;
                            var _new_url = _url.split('&show=modal');

                            window.location.href = _new_url[0];
                        }, 1000);
                    }
                });
            });

            $(".toggle-admin-rating").click(function () {
                $("#dialog-admin-confirm").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        "Yes": function () {
                            $(this).dialog('close');

                            $.ajax({
                                url: "<?php echo $base ?>translator/admin_marked_completed",
                                data: {
                                    job_id: <?php echo $job_id ?>,
                                    bidjob_id: <?php echo $bid_id ?>,
                                    trans_id: "<?php echo $trans_id ?>"
                                },
                                type: 'post',
                                success: function (response) {
                                    var job_id = '<?php echo $job_id;?>';
                                    var bid_id = '<?php echo $bid_id; ?>';
                                    var trans_id = '<?php echo $trans_id ?>';
                                    var type = '<?php echo $type; ?>';

                                    chat.send('Admin has verified completion', name, job_id, bid_id, trans_id, type);

                                    var $interval = setInterval(function () {
                                        var _url = window.location.href;
                                        var _new_url = _url.split('&show=modal');

                                        window.location.href = _new_url[0];
                                    }, 1000);
                                }
                            });

                        },
                        "No": function () {
                            $(this).dialog('close');
                        },
                    }
                });
            });

            $(document).on('click', ".doneWithJob", function () {
                $("#dialog-confirm").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        "Yes": function () {
                            $(this).dialog('close');

                            $.ajax({
                                url: "<?php echo $base; ?>" + "translator/jobIsDone",
                                data: {data: <?php echo $job_id ?>, bidjob_id: <?php echo $bid_id; ?> },
                                type: 'post',
                                dataType: 'json',
                                success: function (response) {
                                    var job_id = '<?php echo $job_id;?>';
                                    var bid_id = '<?php echo $bid_id; ?>';
                                    var trans_id = '<?php echo $trans_id ?>';
                                    var type = '<?php echo $type; ?>';

                                    chat.send("Freelancer has marked job completed", name, job_id, bid_id, trans_id, type);

                                    var $interval = setInterval(function () {
                                        location.reload();
                                    }, 1000);
                                }
                            });


                        },
                        "No": function () {
                            $(this).dialog('close');
                        },
                    }
                });
            });

            var _show = "<?php echo isset($_GET['show']) ? $_GET['show'] : '' ?>";
            var _type = "<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>";

            if (_show == 'modal' && _type == 'admin') {
                $('.toggle-admin-rating').trigger('click');
            }
        });
    </script>
<?php } else { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', ".toggle-admin-rating", function () {
                $("#dialog-admin-confirm").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        "Yes": function () {
                            $(this).dialog('close');
                            $('#dialog-admin-rating').dialog({
                                resizable: false,
                                height: "auto",
                                width: 600,
                                modal: false,
                                buttons: {
                                    "Submit": function () {
                                        $.ajax({
                                            url: "<?php echo $base; ?>" + "translator/admin_rating",
                                            data: {
                                                job_id: <?php echo $job_id ?>,
                                                bidjob_id: <?php echo $bid_id ?>,
                                                trans_id: "<?php echo $trans_id ?>",
                                                rating: $('input[name="rate"]:checked').val()
                                            },
                                            type: 'post',
                                            dataType: 'json',
                                            success: function (response) {
                                                if (response == true) {
                                                    var job_id = '<?php echo $job_id;?>';
                                                    var bid_id = '<?php echo $bid_id; ?>';
                                                    var trans_id = '<?php echo $trans_id ?>';
                                                    var type = '<?php echo $type; ?>';

                                                    var rating = $('input[name="rate"]:checked').val();
                                                    var q1 = $('input[name="q1"]:checked').val();
                                                    var q2 = $('input[name="q2"]:checked').val();
                                                    var q3 = $('input[name="q3"]:checked').val();
                                                    var q4 = $('input[name="q4"]:checked').val();

                                                    if (!q1) q1 = 'None';
                                                    if (!q2) q2 = 'None';
                                                    if (!q3) q3 = 'None';
                                                    if (!q4) q4 = 'None';

                                                    chat.send("Rating " + rating + "/10", name, job_id, bid_id, trans_id, type);
                                                    chat.send("Is all spelling and grammar now accurate? " + q1, name, job_id, bid_id, trans_id, type);
                                                    chat.send("Has literal translation been avoided? " + q2, name, job_id, bid_id, trans_id, type);
                                                    chat.send("Have numbers and money quantities been changed to match the target text style. " + q3, name, job_id, bid_id, trans_id, type);
                                                    chat.send("Has the terminology been consistent throughout the text? " + q4, name, job_id, bid_id, trans_id, type);
                                                    chat.send('Admin has verified completion', name, job_id, bid_id, trans_id, type);
                                                    // } else {
                                                    // $('#dialog-rating-warning').dialog();
                                                }

                                                $('#dialog-admin-rating').dialog('close');

                                                var $interval = setInterval(function () {
                                                    var _url = window.location.href;
                                                    var _new_url = _url.split('&show=modal');
                                                    // _new_url = _new_url[0].substring(0, _new_url[0].length - 1);

                                                    window.location.href = _new_url[0];
                                                }, 1000);
                                                window.opener.location.href = "<?php echo $base; ?>dashboard/index";
//self.close();
                                            }
                                        });
                                    },
                                    "Cancel": function () {
                                        $(this).dialog('close');
                                    }
                                }
                            });
                        },
                        "No": function () {
                            $(this).dialog('close');
                        },
                    }
                });
            });

            $(document).on('click', ".doneWithJob", function () {
                $("#dialog-confirm").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        "Yes": function () {
                            $(this).dialog('close');

                            $.ajax({
                                url: "<?php echo $base; ?>" + "translator/jobIsDone",
                                data: {data: <?php echo $job_id ?>, bidjob_id: <?php echo $bid_id; ?> },
                                type: 'post',
                                dataType: 'json',
                                success: function (response) {
                                    var job_id = '<?php echo $job_id;?>';
                                    var bid_id = '<?php echo $bid_id; ?>';
                                    var trans_id = '<?php echo $trans_id ?>';
                                    var type = '<?php echo $type; ?>';

                                    chat.send("Freelancer has marked job completed", name, job_id, bid_id, trans_id, type);

                                    var $interval = setInterval(function () {
                                        location.reload();
                                    }, 1000);
                                }
                            });


                        },
                        "No": function () {
                            $(this).dialog('close');
                        },
                    }
                });
            });

            var _show = "<?php echo isset($_GET['show']) ? $_GET['show'] : '' ?>";
            var _type = "<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>";

            if (_show == 'modal' && _type == 'admin') {
                $('.toggle-admin-rating').trigger('click');
            }
        });
    </script>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
		
		var complete_trigger = $("input[name='modal_trigger']").val();
		if(complete_trigger == 'yes'){
			$(".modal_trigger").trigger('click');
		}
        $(document).on('click', '#ace-support-btn', function (e) {
            $('#dialog-support').dialog({
                resizable: false,
                height: "auto",
                width: 600,
                modal: false,
                closeOnEscape: false,
                open: function (event, ui) {
                    $(".ui-dialog-titlebar-close").hide();
                },
                buttons: {
                    'Report': function () {

                        if ($('#subject').val() == '' && $('#error-details').val() == '') {
                            $('#dialog-support-message').dialog({
                                resizable: false,
                                height: "auto",
                                width: 600,
                                modal: false,
                                closeOnEscape: false,
                                open: function (event, ui) {
                                    $(".ui-dialog-titlebar-close").hide();
                                },
                                buttons: {
                                    'Okay': function () {
                                        $(this).dialog('close');
                                    }
                                }
                            });

                            $('.message-wrapper').html('Subject and error details should have a value');
                        } else {
                            $(this).dialog('close');

                            $.ajax({
                                url: "<?php echo $base   ?>support/save",
                                type: 'post',
                                data: $('#support-form').serialize(),
                                dataType: 'json',
                                success: function (response) {
                                    if (response.success) {
                                        $('#dialog-support-message').dialog({
                                            resizable: false,
                                            height: "auto",
                                            width: 600,
                                            modal: false,
                                            closeOnEscape: false,
                                            open: function (event, ui) {
                                                $(".ui-dialog-titlebar-close").hide();
                                            },
                                            buttons: {
                                                'Okay': function () {
                                                    $(this).dialog('close');
                                                }
                                            }
                                        });

                                        $('.message-wrapper').html(response.message);
                                    }
                                }

                            });
                        }

                    },
                    'Close': function () {
                        $(this).dialog('close');
                    }
                }
            });
        });
    });
</script>

<div id="dialog-admin1-confirm" title="Verify" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Are you sure the proof
        reader have successfully reviewed the translation?</p>
</div>

<div id="dialog-admin-confirm" title="Verify rwar" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Are you sure the
        translator has successfully completed the translation?</p>
</div>

<div id="dialog-rating-warning" title="Verify" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This job has been already
        rated</p>
</div>

<!--<div id="dialog-confirm" title="Verify" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Are you sure you have
        successfully completed the translation?</p>
</div>-->
<div id="dialog-confirm" title="Verify" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Are you sure you
	have successfully completed the review for these translations?</p>
</div>

<div id="dialog" title="Notify admin" style="display:none;">
    <p>Administrator has been notified.</p>
</div>

<div id="dialog-confirm-completed" title="Document" style="display:none;">
    <p style="padding: 10px;">Are you sure you want to mark this completed?</p>
</div>

<div id="dialog-admin-notif" title="Administrator Notification" style="display:none;">
    <p>The proofreader has not marked this job completed yet. Would you like to:</p><br/>
    <p>#1 Mark the job completed anyway on your end? <br/><br/><span
                style="color:red; font-weight:bold;">** NOTICE **</span><br/> The job status will not change until the
        proofreader rates the translation. The proofreader’s payment will not show up in the invoice page until they
        rate the translation. Yet you don’t need to come back and mark this completed.</p><br/>
    <p>#2 Send an automated email to the freelancer informing them that they need to mark the job completed:</p>
    <br/>
    <p style="padding: 7px; background-color:#cccccc;">
        Hello <span id="proofreader-wrapper"></span>,<br/>
        I want to mark this job <span id="job-title-wrapper" style="font-style: italic;"></span> completed. However you
        need to rate the translation quality before we proceed. Please click on this link so you can log in and rate
        this job. Without your rating the job is incomplete and we can’t proceed to issue your payment.
        <br/><br/>
        Kind regards,<br/>
        Translator Exchange
    </p>
    <br/>
    <p style="font-weight:bold;">This will send every other day until the freelancer marks the job completed.</p>
</div>

<div id="dialog-support" title="Report Technical Issue" style="display:none">
    <form id="support-form">
        <div class="row" style="padding: 5px">
            <div class="col-md-3">Subject</div>
            <div class="col-md-9"><input type="text" id="subject" name="subject" style="width: 100%" required></div>
        </div>

        <div class="row" style="padding: 5px">
            <div class="col-md-3">Page</div>
            <div class="col-md-9"><input type="text" name="page" style="width: 100%"></div>
        </div>

        <div class="row" style="padding: 5px">
            <div class="col-md-3">URL</div>
            <div class="col-md-9"><input type="text" name="url" style="width: 100%"></div>
        </div>

        <div class="row" style="padding: 5px">
            <div class="col-md-12">Error Details</div>
            <div class="col-md-12"><textarea id="error-details" name="details" style="width: 100%; height: 130px;"
                                             required></textarea></div>
        </div>
    </form>
</div>

<div id="dialog-support-message" title="Report Technical Issue" style="display:none">
    <div class="message-wrapper" style="padding: 10px; font-size: 15px;"></div>
</div>

<style type="text/css" media="screen">
    #dialog-rating .rate :not(p) {
        text-align: center;
    }

    #dialog-rating .rate .poor label {
        font-weight: bold;
        font-size: 30px;
        color: #ff0000;
    }

    #dialog-rating .rate .moderate label {
        font-weight: bold;
        font-size: 30px;
        color: #ffcc00;
    }

    #dialog-rating .rate .excellent label {
        font-weight: bold;
        font-size: 30px;
        color: #009933;
    }

    #dialog-rating .rate input {
        margin-top: -5px;
    }

    #dialog-rating .questionaire label {
        margin-left: 5px !important;
        margin-right: 10px !important
    }

    #dialog-admin-rating .rate :not(p) {
        text-align: center;
    }

    #dialog-admin-rating .rate .poor label {
        font-weight: bold;
        font-size: 30px;
        color: #ff0000;
    }

    #dialog-admin-rating .rate .moderate label {
        font-weight: bold;
        font-size: 30px;
        color: #ffcc00;
    }

    #dialog-admin-rating .rate .excellent label {
        font-weight: bold;
        font-size: 30px;
        color: #009933;
    }

    #dialog-admin-rating .rate input {
        margin-top: -5px;
    }

    #dialog-admin-rating .questionaire label {
        margin-left: 5px !important;
        margin-right: 10px !important
    }

    .text-sender-type {
        position: absolute;
        left: 0;
        top: 13px;
        font-size: 10px;
        font-weight: bold;
        color: rgb(142, 142, 142);
    }
</style>

<div id="dialog-rating" title="Rating" style="display:none">
    <?php
    $sql = "SELECT *, p2.id AS proofread_job_doc_id ";
    $sql .= "FROM bidjob b1";
    $sql .= "  JOIN bidjob_details b2 ON b2.bidjob_id = b1.id";
    $sql .= "  JOIN proofread_jobs p1 ON p1.id = b2.proofread_doc_id";
    $sql .= "  JOIN proofread_jobs_docs p2 ON p2.proofread_job_id = p1.id ";
    $sql .= "  JOIN proofread_jobs_awarded p3 ON p3.proofread_doc_id = p2.id";
    $sql .= "  JOIN jobpost j ON j.id = b1.job_id ";
    $sql .= "WHERE ";
    $sql .= " b1.awarded = 1 AND ";
    $sql .= " p3.proofreader_id = {$trans_id} AND ";
    $sql .= " b1.id = {$bid_id} AND ";
    $sql .= " p2.is_awarded = 1 ";
    $sql .= "GROUP BY p2.id ";
    $sql .= "ORDER BY p2.doc_order ASC";

    $query = mysql_query($sql);
    $docs = null;

    while ($row = mysql_fetch_assoc($query)) {
        $docs[] = $row;
    }

    // echo '<pre>'; print_r($docs); exit;
    ?>

    <div class="rate">
        <p>How good did the original translator do?</p>
        <p><i>10 being the highest</i></p>
        <?php if (count($docs)) { ?>
            <?php foreach ($docs as $i => $doc) { ?>
                <?php $original = explode('/', $doc['original_file']); ?>
                <?php $translated = explode('/', $doc['translated_file']); ?>
                <div style="margin-top: 10px;">
                    <div class="document-wrapper" style="text-align: left !important">
                        Document: <?php echo $original[1] ?> - <?php echo $translated[1] ?></div>
                    <div class="poor">
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r1">1</label><input
                                    type="radio" id="r1" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="1"/></div>
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r2">2</label><input
                                    type="radio" id="r2" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="2"/></div>
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r3">3</label><input
                                    type="radio" id="r3" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="3"/></div>
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r4">4</label><input
                                    type="radio" id="r4" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="4"/></div>
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r5">5</label><input
                                    type="radio" id="r5" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="5"/></div>
                    </div>

                    <div class="moderate">
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r6">6</label><input
                                    type="radio" id="r6" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="6"/></div>
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r7">7</label><input
                                    type="radio" id="r7" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="7"/></div>
                    </div>

                    <div class="excellent">
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r8">8</label><input
                                    type="radio" id="r8" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="8"/></div>
                        <div style="margin-right: 5px; width:25px; float:left;"><label for="r9">9</label><input
                                    type="radio" id="r9" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="9"/></div>
                        <div style="margin-right: 5px; width:35px; float:left;"><label for="r10">10</label><input
                                    type="radio" id="r10" class="rating"
                                    data-doc="<?php echo $original[1] ?> - <?php echo $translated[1] ?>"
                                    name="rate-<?php echo $i ?>[]" value="10"/></div>
                    </div>

                </div>
                <div style="clear:both; margin-bottom: 10px;"></div>
            <?php } ?>
        <?php } else { ?>
            <div style="margin-top: 10px;">
                <div class="poor">
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r1">1</label><input type="radio"
                                                                                                            id="r1"
                                                                                                            class="rating"
                                                                                                            value="1"/>
                    </div>
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r2">2</label><input type="radio"
                                                                                                            id="r2"
                                                                                                            class="rating"
                                                                                                            value="2"/>
                    </div>
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r3">3</label><input type="radio"
                                                                                                            id="r3"
                                                                                                            class="rating"
                                                                                                            value="3"/>
                    </div>
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r4">4</label><input type="radio"
                                                                                                            id="r4"
                                                                                                            class="rating"
                                                                                                            value="4"/>
                    </div>
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r5">5</label><input type="radio"
                                                                                                            id="r5"
                                                                                                            class="rating"
                                                                                                            value="5"/>
                    </div>
                </div>

                <div class="moderate">
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r6">6</label><input type="radio"
                                                                                                            id="r6"
                                                                                                            class="rating"
                                                                                                            value="6"/>
                    </div>
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r7">7</label><input type="radio"
                                                                                                            id="r7"
                                                                                                            class="rating"
                                                                                                            value="7"/>
                    </div>
                </div>

                <div class="excellent">
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r8">8</label><input type="radio"
                                                                                                            id="r8"
                                                                                                            class="rating"
                                                                                                            value="8"/>
                    </div>
                    <div style="margin-right: 5px; width:25px; float:left;"><label for="r9">9</label><input type="radio"
                                                                                                            id="r9"
                                                                                                            class="rating"
                                                                                                            value="9"/>
                    </div>
                    <div style="margin-right: 5px; width:35px; float:left;"><label for="r10">10</label><input
                                type="radio" id="r10" class="rating" value="10"/></div>
                </div>

            </div>
        <?php } ?>
    </div>

    <div style="clear:both;"></div>

    <div class="questionaire">
        <div class="q1" style="margin-top: 10px;">
            <p>1. Is all spelling and grammar now accurate?</p>
            <input type="radio" id="q1-yes-answer" name="q1" value="Yes"/><label for="q1-yes-answer">Yes</label>
            <input type="radio" id="q1-no-answer" name="q1" value="No"/><label for="q1-no-answer">No</label>
        </div>

        <div class="q2">
            <p>2. Has literal translation been avoided?</p>
            <input type="radio" id="q2-answer" name="q2" value="Yes"/><label for="q2-yes-answer">Yes</label>
            <input type="radio" id="q2-answer" name="q2" value="No"/><label for="q2-no-answer">No</label>
        </div>
        <div class="q3">
            <p>3. Have numbers and money quantities been changed to match the target text style.</p>
            <p>For Example: 10.000 to 10,000 if translating or vise versa?</p>
            <input type="radio" id="q3-answer" name="q3" value="Yes"/><label for="q3-yes-answer">Yes</label>
            <input type="radio" id="q3-answer" name="q3" value="No"/><label for="q3-no-answer">No</label>
            <input type="radio" id="q4-answer" name="q4" value="Don't know"/><label for="q4-no-answer">Dont know</label>
        </div>
        <div class="q4">
            <p>4. Has the terminology been consistent throughout the text?</p>
            <input type="radio" id="q4-answer" name="q4" value="Yes"/><label for="q4-yes-answer">Yes</label>
            <input type="radio" id="q4-answer" name="q4" value="No"/><label for="q4-no-answer">No</label>
        </div>
    </div>
</div>

<div id="dialog-admin-rating" title="Rating" style="display:none">
    <div class="rate">
        <p>How good did the original translator do?</p>
        <p><i>10 being the highest</i></p>
        <div style="margin-top: 10px;">
            <div class="poor">
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r1">1</label><input type="radio"
                                                                                                        id="r1"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="1"/>
                </div>
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r2">2</label><input type="radio"
                                                                                                        id="r2"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="2"/>
                </div>
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r3">3</label><input type="radio"
                                                                                                        id="r3"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="3"/>
                </div>
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r4">4</label><input type="radio"
                                                                                                        id="r4"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="4"/>
                </div>
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r5">5</label><input type="radio"
                                                                                                        id="r5"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="5"/>
                </div>
            </div>

            <div class="moderate">
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r6">6</label><input type="radio"
                                                                                                        id="r6"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="6"/>
                </div>
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r7">7</label><input type="radio"
                                                                                                        id="r7"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="7"/>
                </div>
            </div>

            <div class="excellent">
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r8">8</label><input type="radio"
                                                                                                        id="r8"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="8"/>
                </div>
                <div style="margin-right: 5px; width:25px; float:left;"><label for="r9">9</label><input type="radio"
                                                                                                        id="r9"
                                                                                                        class="rating"
                                                                                                        name="rate"
                                                                                                        value="9"/>
                </div>
                <div style="margin-right: 5px; width:35px; float:left;"><label for="r10">10</label><input type="radio"
                                                                                                          id="r10"
                                                                                                          class="rating"
                                                                                                          name="rate"
                                                                                                          value="10"/>
                </div>
            </div>
        </div>
    </div>

    <div style="clear:both;"></div>

    <div class="questionaire">
        <div class="q1" style="margin-top: 10px;">
            <p>1. Is all spelling and grammar now accurate?</p>
            <input type="radio" id="q1-yes-answer" name="q1" value="Yes"/><label for="q1-yes-answer">Yes</label>
            <input type="radio" id="q1-no-answer" name="q1" value="No"/><label for="q1-no-answer">No</label>
        </div>

        <div class="q2">
            <p>2. Has literal translation been avoided?</p>
            <input type="radio" id="q2-answer" name="q2" value="Yes"/><label for="q2-yes-answer">Yes</label>
            <input type="radio" id="q2-answer" name="q2" value="No"/><label for="q2-no-answer">No</label>
        </div>
        <div class="q3">
            <p>3. Have numbers and money quantities been changed to match the target text style.</p>
            <p>For Example: 10.000 to 10,000 if translating or vise versa?</p>
            <input type="radio" id="q3-answer" name="q3" value="Yes"/><label for="q3-yes-answer">Yes</label>
            <input type="radio" id="q3-answer" name="q3" value="No"/><label for="q3-no-answer">No</label>
            <input type="radio" id="q4-answer" name="q4" value="Don't know"/><label for="q4-no-answer">Dont know</label>
        </div>
        <div class="q4">
            <p>4. Has the terminology been consistent throughout the text?</p>
            <input type="radio" id="q4-answer" name="q4" value="Yes"/><label for="q4-yes-answer">Yes</label>
            <input type="radio" id="q4-answer" name="q4" value="No"/><label for="q4-no-answer">No</label>
        </div>
    </div>
</div>

<!-- Image modal -->
<div class="modal fade" id="imageModal" role="dialog">
    <div class="modal-dialog" style="width:90%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
<!--                <h4 class="modal-title">Preview</h4>-->
                <div class="clearfix"></div>
            </div>
            <center>
            <div class="modal-body" id="modal_body_img">
            </div>
            </center>
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--            </div>-->
        </div>

    </div>
</div>

<script type="text/javascript">
    function imagemodal(id) {
        if(id != ''){
        $.ajax({
            type:'post',
            url:'<?php echo $base; ?>translator/getimages',
            data:{id:id},
            dataType:'json',
            success:function(data){
if(data.res == 1){
    $("#modal_body_img").html(data.html);
    $("#imageModal").modal('show');
}
            }
        });

        }

    }
</script>
<!--          Image modal           -->

</body>
</html>