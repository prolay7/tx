<?php
$this->load->view('email/includes/vwHead');
?>

                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                              Dear <strong> <?php echo $trans_name; ?> </strong>
                                         
                                            </p>
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                             
                                             You are reviewed for job <?php echo $job_name; ?>
                                            </p>
                                           
                                            <p style="text-align:left">
                                                </p><table>
                                                    <tbody>
                                                    <tr>
                                                        <td width="492" style="width:494px;text-align:left">
                                                            <span style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:14px;line-height:25px;margin:30px 0;padding:0">
                                                           Rating:<?php echo $rating ;?>
                                                            </span>
                                                        </td>
                                                       
                                                    </tr>
                                                    
                                                    <tr>
                                                     <td width="492" style="width:494px;text-align:left">
                                                       <?php
													   if(isset($message) && $message!='' ){
													   ?>
                                                       <span style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:14px;line-height:25px;margin:30px 0;padding:0">
                                                       Comment:<?php echo $message ;?>
                                                       </span>
                                                       <?php
													   }
                                                       ?>    
                                                           
                                                        </td>
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
