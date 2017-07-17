<?php $partialTotal = "0.00"; ?>
<?php foreach ($invoices as $rowInvoice){ ?>
    <tr>
        <td><?php echo $rowInvoice->invoice_id; ?></td>
        <?php if ($rowInvoice->lineNumberCode) { ?>
        <td><a href = "<?=(base_url());?>admin_jobpost/edit/<?php echo $rowInvoice->job_id; ?>"><?php echo $rowInvoice->name; ?>&nbsp;/&nbsp;<?php echo $rowInvoice->lineNumberCode ?></a></td>
        <?php } else { ?>
        <td><a href = "<?=(base_url());?>admin_jobpost/edit/<?php echo $rowInvoice->job_id; ?>"><?php echo $rowInvoice->name; ?></a></td>
        <?php } ?>
        <td><a href = "<?=(base_url());?>admin_translators/edittranslator/<?php echo $rowInvoice->trans_id; ?>"><?php echo $rowInvoice->first_name." ".$rowInvoice->last_name; ?></a></td>
        <td><?php echo ($rowInvoice->time_need/1440); ?> Day(s)</td>

        <td>$<?php echo number_format($rowInvoice->bidjobprice, 2, '.', ','); ?></td>
            <?php $partialTotal = $partialTotal + $rowInvoice->bidjobprice; ?>

        <td style = "text-align: center;"><?php echo date('m-d-Y', strtotime($rowInvoice->award_date)); ?></td>
        <td style = "text-align: center;">
            <?php if ($rowInvoice->bidjobstage == 2){ ?>
                <?php echo date('m-d-Y', strtotime($rowInvoice->complete_date)); ?>
            <?php }else{ ?>
                <button onclick="confir(<?php echo $rowInvoice->bidjobid; ?>,<?php echo $rowInvoice->jobpostid;?>)" type="button" class="btn btn-danger btn-xs" aria-haspopup="true" aria-expanded="false">Mark as Completed</button>
            <?php } ?>

        </td>
        <td style = "text-align: center;"><?php echo date('m-d-Y', strtotime('+31 days', strtotime($rowInvoice->complete_date))); ?></td>
        <td style = "text-align: center;">
            <?php if ($rowInvoice->payment == "0"){ ?>
                <form method = "post" action = "<?php echo base_url();?>admin_invoice/manual_payment/">
                    <input type = "hidden" name = "invoiceID" value = "<?php echo $rowInvoice->invoice_id; ?>">
                    <button onclick = "return confirm('Are you sure you want to do a manual payment for this Invoice?');" type="submit" class="btn btn-primary btn-xs">Mark as Paid</button>
                </form>
            <?php }else if ($rowInvoice->payment == "1") { ?>
                <?php echo date('m-d-Y', strtotime($rowInvoice->payment_date)); ?>
            <?php } ?>
        </td>
        <td style = "text-align: center;">
            <?php if ($rowInvoice->payment == "0"){ ?>
                <?php
                    $dueDate = date('m-d-Y', strtotime('+31 days', strtotime($rowInvoice->complete_date)));
                    $currentDate = date('m-d-Y');

                    if ($dueDate < $currentDate){
                        echo '<span class = "btn btn-danger btn-xs">Overdue</span>';
                    }else{
                        echo '<span class = "btn btn-success btn-xs">Open</span>';
                    }
                ?>
                <a href="<?php echo base_url().'paypal/?id='.$bid_id;?>" class="btn btn-warning btn-xs" target="_blank">Pay Now</a>
            <?php }else if ($rowInvoice->payment == "1") { ?>
                <form method = "post" action = "<?php echo base_url();?>admin_invoice/mark_unpaid/">
                    <input type = "hidden" name = "invoiceID" value = "<?php echo $rowInvoice->invoice_id; ?>">
                    <button onclick = "return confirm('Are you sure you want to mark this Invoice as Unpaid?');" type="submit" class="btn btn-danger btn-xs btn-block">Mark as Unpaid</button>
                </form>
            <?php } ?>
        </td>
        <td>
            <div class="hidden-sm hidden-xs action-buttons">
                <a class="red" href="<?php echo base_url(); ?>admin/deleteinvoice/<?php echo $rowInvoice->invoice_id;  ?>" onClick="return doconfirm();">
                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                </a>
            </div>
        </td>
    </tr>
<?php } ?>
