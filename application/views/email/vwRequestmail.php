<?php
$this->load->view('email/includes/vwHead');
?>

                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                          
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                             
                                             <?php echo $name ?> is send a payment request for <?php echo $jobname ?> Job for Overdue
                                            </p>
                                            
                                            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Job Name</th>
                                                 
                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                    
                                                     <td style="background:#efefef;padding:10px;color:#003366"><a href="<?php echo base_url();?>admin_awardjob/viewawardjob/<?php echo $bid_id ?>"> <?php echo $jobname; ?></a></td>
                                                     
                                                    </tr>
                                                 </tbody>
                                            </table>
                                               <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Email address</th>
                                                 
                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                    
                                                     <td style="background:#efefef;padding:10px;color:#003366"> <?php echo $email_address; ?></td>
                                                     
                                                    </tr>
                                                 </tbody>
                                            </table>
                                            
                                            
                                              <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Request Message</th>
                                                 
                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                    
                                                     <td style="background:#efefef;padding:10px;color:#003366"> <?php echo $request; ?> </td>
                                                     
                                                    </tr>
                                                 </tbody>
                                            </table>
                                           
                                         
                                            <p style="text-align:left">
                                                </p>
                                            <p></p>
                                        </td>
                                    </tr>
                                   
                                </tbody></table>

                                <br style="line-height:20px">

    
<?php
$this->load->view('email/includes/vwFoot');
?>
<?php /*?><?php
$this->load->view('email/includes/vwHeader');
?>
<div class="container">


   
    <div class="row">
      <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
    			
				
                    <table class="table" align="center">
                        <thead>
                        <tr>
                        	<th>Name </th>
                            <th>Email </th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Message </th>
                        </tr>
                        </thead>
                    	<tbody>
                        <tr class="success">
                        	<td><?php echo $first_name; ?> <?php echo $last_name; ?></td>
                            <td height="25"><?php echo $email_address; ?></td>
                            <td><?php echo $address; ?></td>
                            <td> <?php echo $phone; ?></td>
                            <td><?php echo $message; ?></td>
                        </tr>
                        </tbody>
                    </table>

            
        <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
	</div>
</div>
 

<!--
    The idea is to use mostly Bootstrap markup,
    peppered with a few "tr" and "td" classes,
    so you can turn any basic bootstrap panel
    into a columnar panel.
-->
<?php
$this->load->view('email/includes/vwFooter');
?><?php */?>