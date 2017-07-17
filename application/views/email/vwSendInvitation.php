
<?php
$this->load->view('email/includes/vwHead');
?>

                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                              Dear <strong> <?php echo $name; ?> </strong>

                                            </p>
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">

                                             You are invited by Montesino Translation to register to Translator Exchange.
                                            </p>
                                              <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">

                                            On this platform you will be able to apply for Translation projects.
                                            </p>

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
                                                  <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">Due Date<th>

                                                 </tr>
                                                </thead>
                                               <tbody>
                                                  <tr>
                                                      <?php
                                                      if ($results[0]['dueDate']) {
                                                          $due = $results[0]['dueDate'];
                                                          $due_arr = explode(' ', $due);
                                                          $date = str_replace('-', '/', $due_arr[0]).' '.$due_arr[1];
                                                          $due_date = date('jS F Y h:i A', strtotime($date));
                                                      } else {
                                                          $due_date = 'No due date set';
                                                      }
                                                      ?>
                                                      <td style="background:#efefef;padding:10px;color:#003366"><?php echo $due_date ?></td>

                                                     </tr>
                                                  </tbody>
                                             </table>

                                            <p style="text-align:left">
                                                </p><table>
                                                    <tbody><tr>
                                                        <td width="492" style="width:494px;text-align:left">
                                                            <span style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:14px;line-height:25px;margin:30px 0;padding:0">
                                                            Please click on the here to Register   <a style="padding: 10px 15px;background: #4479BA;color: #FFF;" href="<?php echo base_url(); ?>admin_translator/invitation_check/<?php echo $id; ?>" target="_blank">Register Now

                                                            </a>
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
