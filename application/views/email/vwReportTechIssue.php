<?php
$this->load->view('email/includes/vwHead');
?>


<tr style="width:100%;margin:0;padding:0">
    <td colspan="4"
        style="border:1px solid #d4d4d4;width:100%;background:white;border-radius:10px;padding:20px;text-align:center"
        align="center">
        <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
            Reported by: <strong> <?php echo $user_name; ?> </strong>
        </p>
        <br>

        <p style="color:#003366;font-family:Helvetica,Arial,sans-serif;font-size:18px;margin:0 0 5px;padding:0;text-align:left">
            Technical Issue Found
        </p>

        <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
            <thead>
            <tr>
                <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">
                    Subject
                </th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="background:#efefef;padding:10px;color:#003366"><?php echo $subject; ?></td>
            </tr>
            </tbody>
        </table>

        <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
            <thead>
            <tr>
                <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">
                    Details
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="background:#efefef;padding:10px;color:#003366"><?php echo '<p>' . $content . '</p>' ?></td>
            </tr>
            </tbody>
        </table>

        <?php if ($page != '') { ?>
            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                <thead>
                <tr>
                    <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">
                        Page
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="background:#efefef;padding:10px;color:#003366"><?php echo '<p>' . $page . '</p>' ?></td>
                </tr>
                </tbody>
            </table>
        <?php } ?>


        <?php if ($link != '') { ?>
            <table style="width:640px;font-family:Helvetica,Arial,sans-serif;font-size:14px;color:#003366;text-align:left">
                <thead>
                <tr>
                    <th style="background:#208ce5;color:#fff;font-weight:normal;text-align:left;padding:10px;width:260px;font-size:13px">
                        Link
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="background:#efefef;padding:10px;color:#003366"><?php echo '<a href="' . $link . '" target="_blank" class="btn btn-primary">Go to page</a>' ?></td>
                </tr>
                </tbody>
            </table>
        <?php } ?>

    </td>
</tr>
</tbody>
</table>

<?php
$this->load->view('email/includes/vwFoot');
?>
