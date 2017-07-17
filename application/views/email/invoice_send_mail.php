
<?php
$this->load->view('email/includes/vwHead');
?>

                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                              Hello <strong> <?php echo $first_name; ?> </strong>
                                            </p>
                                            <br>
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">

                                             A new invoice has been assigned to you. Here are the Details
                                            </p>
                                             

                                           <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Invoice Amount</th>

                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                     <td style="background:#efefef;padding:10px;color:#003366">$<?php echo $amount_owed;?></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                                <thead>
                                                <tr>
                                                    <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Due Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td style="background:#efefef;padding:10px;color:#003366"><?php echo $date_completed ?></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            

                                            <p style="text-align:left">
                                                </p><table>
                                                    <tbody><tr>
                                                        <td width="492" style="width:494px;text-align:left">
                                                            <span style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:14px;line-height:25px;margin:30px 0;padding:0">
                                                           <a style="padding: 10px 15px;background: #4479BA;color: #FFF;" href="<?php echo base_url(); ?>translator/invoice" target="_blank">Profile Invoice Page</a>
                                                            </span>
                                                        </td>
                                                        <!--<td>

                                                            <a style="padding: 10px 15px;background: #4479BA;color: #FFF;" href="<?php echo base_url(); ?>admin_translator/invitation_check/<?php echo $id; ?>" target="_blank">Register Here

                                                            </a>
                                                        </td>-->
                                                    </tr>
                                                </tbody></table>
                                            <p></p>
                                        </td>
                                    </tr>

                                	</tbody>
                                </table>

                                <br style="line-height:20px">

<?php
$this->load->view('email/includes/vwFoot');
?>
