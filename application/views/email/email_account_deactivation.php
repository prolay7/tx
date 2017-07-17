<?php
$this->load->view('email/includes/vwHead');
?>

                                    <tr style="width:100%;margin:0;padding:0">
                                        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center" align="center">
                                            <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
                                              Dear <strong> <?php echo $name; ?> </strong>
                                            </p>
                                            <br>
 <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left"><?php echo $msg; ?>
                                                </p>



                                        </td>
                                    </tr>

                                	</tbody>
                                </table>

                                <br style="line-height:20px">

<?php
$this->load->view('email/includes/vwFoot');
?>
