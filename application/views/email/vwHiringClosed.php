
<?php
$this->load->view('email/includes/vwHead');
?>

    <tr style="width:100%;margin:0;padding:0">
        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:left" align="center">

            <div style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;">
                <p>Hello <?php echo $translator_name ?>,</p>
                <p>
                Hiring for the job <span id="job-title-wrapper" style="font-weight: bold;"><?php echo $job_name ?></span>, translation from <span class="lang_from"><?php echo $lang_from ?></span> to <span class="lang_to"><?php echo $lang_to ?></span>, which you bidded for is now complete. Thank you for bidding.
                <br/><br/>
                Kind regards,<br/>
                Translator Exchange
                </p>
            </div>

        </td>
    </tr>

	</tbody>
</table>

<br style="line-height:20px">

<?php
$this->load->view('email/includes/vwFoot');
?>
