
<?php
$this->load->view('email/includes/vwHead');
?>

    <tr style="width:100%;margin:0;padding:0">
        <td colspan="4" style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:left" align="center">

            <div style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;">
                <p>Hello <?php echo $translator_name ?>,</p>
                <p>
                I want to mark this job <span id="job-title-wrapper" style="font-style: italic;"><?echo $job_name ?></span> completed. However you need to rate the translation quality before we proceed. Please click on this link so you can log in and rate this job. Without your rating the job is incomplete and we cant proceed to issue your payment.
                <br/><br/>
                <a href="<?php echo $url ?>" id="job-link" target="_blank">LINK</a>
                <br/><br/>
                Kind regards,<br/>
                Translator Exchange
                </p>
                <br/>
                <p style="font-weight:bold;font-size:12px;">This will send every other day until the freelancer marks the job completed.</p>
            </div>

        </td>
    </tr>

	</tbody>
</table>

<br style="line-height:20px">

<?php
$this->load->view('email/includes/vwFoot');
?>
