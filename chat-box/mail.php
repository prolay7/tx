
<?php
include('database.php');


		$bid_id = $_POST['bid_id'];
		
		$job_id = $_POST['job_id'];
		
		$trans_id = $_POST['trns_id'];
		
		$type = $_REQUEST['type'];
		//echo $bid_id;
$sqlci="select * from `ci_sessions` ";
		//echo $sqlci;

		    $queryci=mysql_query($sqlci);     
			
		   
			$rows = array();
			while($fetchci=mysql_fetch_array($queryci)){
			$user_data=$fetchci['user_data'];
		    $user_datas=unserialize($user_data);
			
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
			$arr_str="'".implode("','",$array)."'";
			//echo $arr_str; 
				if (in_array($trans_id, $array)) {
				//echo "Got Irix";
				}else{
					$sql2 = "SELECT * FROM `ajax_chat_messages`  WHERE `status`='unread' AND `job_id`='".$job_id."' AND `bid_id`='".$bid_id."'  AND `trans_id`='".$trans_id."' AND `type`='admin'";
					//echo $sql2;
					$result2 = mysql_query($sql2);
					$num_rows = mysql_num_rows($result2);
					if($num_rows>0){
					$sql_trans="select * from `translator` where `id`='".$trans_id."'";
		    		$querytrans=mysql_query($sql_trans);     
					$fetchtrans=mysql_fetch_object($querytrans);
					$tomail=$fetchtrans->email_address;
					$name=$fetchtrans->first_name." ".$fetchtrans->last_name;
					
					$sql_job="select * from `jobpost` where `id`='".$job_id."'";
		    		$queryjob=mysql_query($sql_job);     
					$fetchjob=mysql_fetch_object($queryjob);
					$jobname=$fetchjob->name;
					
					$to=$tomail;
					//$to="anishabarman@theismtech.com";
					$subject = "Message Notification";
					$base='http://'.$_SERVER['HTTP_HOST'].'/';

					$url=$base."chat-box/?bid_id=".$bid_id."&job_id=".$job_id."&trans_id=".$trans_id."&type=user";
					$message = '
					
					<tr style="width:100%;margin:0;padding:0">
					<td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
					<p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
					  Dear <strong> '.$name.'  </strong>
					
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
					<td style="background:#efefef;padding:10px;color:#003366"> You have a new message for job : '.$jobname.'
					</td>                                                   
					
					</tr>
					<tr>
					                                               
					<td style="background:#efefef;padding:10px;color:#003366">View :  <a href="'.$url.'">MESSAGE</a> 
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
					
					mail($to,$subject,$message,$headers);
					
					
					}
						
				}


?>
