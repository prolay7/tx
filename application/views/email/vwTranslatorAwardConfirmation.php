
<?php
$this->load->view('email/includes/vwHead');
?>

<!--
<html>
<head>                    
<title>Translation</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr>
                <td style="text-align:center" align="center" valign="top">
                    <table style="width:760px;padding:0;margin:0 auto;background:#eeeeee;text-align:left" align="center" border="0" cellpadding="0" cellspacing="0" width="760">
                        <tbody><tr>
                            <td style="text-align:center">
	


                                <table style="width:680px;margin:0 auto;padding:0" align="center" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    	<tr style="width:100%;margin:0;padding:0">
                                        <td style="height:34px;margin:0;width:151px;padding-left:60px">
                                            <a href="#" target="_blank">
                                                <img class="CToWUd" src="http://www.demo.thupa.pro/translation/includes/images/Logo.png" style="width:151px;min-height:34px;border:0" alt="Infolinks">
                                            </a>
                                        </td>
                                        <td style="width:90px;margin:0;height:132px">&nbsp;</td>
                                    </tr>-->
                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                              Dear <strong> <?php echo $name; ?> </strong>
                                         
                                            </p>
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                             
                                            You are Awarded for this Job.Details Are Follows :
                                            </p>
                                            
                                            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Job Name</th>
                                                 
                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                    
 <!--<td style="background:#efefef;padding:10px;color:#003366"> <a href="<?php echo base_url(); ?>job/<?php echo $job_id.'/'.$job_alias; ?>"><?php echo $job_name; ?></a></td>-->
<td style="background:#efefef;padding:10px;color:#003366"> <a href="<?php echo base_url(); ?>chat-box/?bid_id=<?php echo $bid_id; ?>&job_id=<?php echo $job_id; ?>&trans_id=<?php echo  $trans_id; ?>&type=user"><?php echo $job_name; ?></a></td>
                                                     
                                                    </tr>
                                                 </tbody>
                                            </table>
                                            
                                              <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Job Description</th>
                                                 
                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                    
                                                     <td style="background:#efefef;padding:10px;color:#003366"> <?php echo $job_description; ?> </td>
                                                     
                                                    </tr>
                                                 </tbody>
                                            </table>
                                              <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Job Created</th>
                                                 
                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                    
                                   <td style="background:#efefef;padding:10px;color:#003366"><?php echo date("jS F ,Y", strtotime($job_created));?></td>                             
                                                    </tr>
                                                 </tbody>
                                            </table>
                                            <p style="text-align:left">
                                                </p><table>
                                                    <tbody><tr>
                                                        <td width="450" style="width:450px;text-align:left">
                                                            <span style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:14px;line-height:25px;margin:30px 0;padding:0">
                                                                Job is ready for work
                                                            </span>
                                                        </td>
                                                        <td>

                                                            <a style="padding:10px 15px;background: #4479BA;color: #FFF;" href="<?php echo base_url(); ?>chat-box/?bid_id=<?php echo $bid_id; ?>&job_id=<?php echo $job_id; ?>&trans_id=<?php echo  $trans_id; ?>&type=user" target="_blank">View Job Details
                                                                
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            <p></p>
                                        </td>
                                    </tr>
                                    <tr colspan="4" style="width:100%;margin:0;padding:0" align="center">
                                        <td style="width:100%;text-align:center;padding:0;margin:0" align="center">
                                            <img class="CToWUd" src="<?php echo base_url(); ?>img/bottom-arrow.png" style="width:23px;min-height:15px">
                                        </td>
                                    </tr>
                                </tbody></table>

                                <br style="line-height:20px">

                     <?php
$this->load->view('email/includes/vwFoot');
?>