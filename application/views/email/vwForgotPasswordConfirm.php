<table style="width:760px;padding:0;margin:0 auto;background:#eeeeee;text-align:left" align="center" border="0" cellpadding="0" cellspacing="0" width="760">
                        <tbody>
                            <tr>
                              <td style="text-align:center">

                                <?php
                                $this->load->view('email/includes/vwHeader');
                                ?>
                                <br style="line-height:20px">

                                <table style="width:680px;margin:0 auto;padding:0" align="center" cellpadding="0" cellspacing="0">
                                    <tbody><tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#208ce5;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0px 0 20px;padding:0;text-align:left">                                           
                                  Hi <strong> <?php echo $first_name.'&nbsp;'.$last_name;?></strong>,	
                                            </p>
                                           <p style="color:#208ce5;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin:0px 0 20px;padding:0;text-align:left">
                                            translatorexchange.com has received a request to reset the password for your account. If you did not request to reset your password, please ignore this email.
                                            </p>
                                            <p style="color:#208ce5;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0px 0 20px;padding:0;text-align:left">
                                            <a style="background:#208CE5;padding:5px 10px; color:#fff; font-size:14px;" href="<?php echo base_url().'translator/forgotpass/'.$hash;?>">Reset password now</a>
                                            
                                            </p>
                                        </td>
                                    </tr>
                                    <tr colspan="4" style="width:100%;margin:0;padding:0" align="center">
                                        <td style="width:100%;text-align:center;padding:0;margin:0" align="center">
                                        
                                        
                                            <img class="CToWUd" src="http://resources.infolinks.com/static/newsletter/images/chupchik-white.png" style="width:23px;min-height:15px">
                                        </td>
                                    </tr>
                                </tbody></table>

                                <br style="line-height:20px">
                                
								<?php
                                $this->load->view('email/includes/vwFooter');
                                ?>
                                
                              </td>
                            </tr>
                        </tbody>
                        
</table>
