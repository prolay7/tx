<?php
$this->load->view('email/includes/vwHead');
?>

                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                              Dear <strong> <?php echo $name; ?> </strong>
                                            </p>
                                            <br>

                                            <?php
                                            $findme   = 'P';
                                            $language1 = $language;
                                            $pos = strpos($language1, $findme);
                                            if ($pos === false) {
?>

                                                <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">Montesino Translation has created an account for you, on this platform you will be able to apply and manage your translation projects.
                                                </p>

                                           <?php } else {?>
                                                <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">Montesino Translation has created an account for you, on this platform you will be able to Bid on and manage your Proofreading projects.
                                                </p>

                                            <?php } ?>



                                           <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                              <thead>
                                                <tr>
                                                 <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Invitation Date</th>

                                                </tr>
                                               </thead>
                                              <tbody>
                                                 <tr>
                                                     <td style="background:#efefef;padding:10px;color:#003366"><?php echo date("jS F ,Y", strtotime($created));?></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                                <thead>
                                                <tr>
                                                    <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Username</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td style="background:#efefef;padding:10px;color:#003366"><?php echo $user_name ?></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                                                <thead>
                                                <tr>
                                                    <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Temporary Password</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td style="background:#efefef;padding:10px;color:#003366"><?php echo $temp_password ?></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <p style="text-align:left">
                                                </p><table>
                                                    <tbody><tr>
                                                        <td width="492" style="width:494px;text-align:left">
                                                            <span style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:14px;line-height:25px;margin:30px 0;padding:0">
                                                            Please click this link to verify your invitation &nbsp;&nbsp;<a style="padding: 10px 15px;background: #4479BA;color: #FFF;" href="<?php echo base_url(); ?>admin_translator/invitation_check/<?php echo $id; ?>" target="_blank">Verify </a>
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
