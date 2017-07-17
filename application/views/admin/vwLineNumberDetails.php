<link rel="stylesheet" href="<?php echo base_url(). 'assets/css/jquery.dataTables.min.css'?>">
<?php
if ($line_numbers->num_rows()) {
    $this->load->model('common_model');
?>
<!--<td colspan="5">-->
    <table id="dynamic_table_<?php echo $line_number_code; ?>" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center">Job Title</th>
                <th class="center">Translator</th>
                <th style="text-align: right;">Job Price</th>
                <th style="text-align: right;">Awarded Price</th>
                <th style="text-align: right">Awarder Admin</th>
                <th style="text-align: right">Admin Marked Completed</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($line_numbers->result_array() as $row) { ?>
            <tr>
                <td><?php echo ($row['job_name']!= '')?$row['job_name']:'Job Manually Entered'; ?></td>
                <td>
                    <?php
                    $sql = "SELECT t.id, CONCAT(t.first_name, ' ', t.last_name) translator_name FROM translator t WHERE t.id = {$row['trans_id']}";
                    $query =$this->db->query($sql);

                    if ($query->num_rows()) {
                        foreach ($query->result_array() as $translator) {
                            echo "{$translator['translator_name']}";
                        }
                    }
                     ?>
                </td>
                <td style="text-align: right">$<?php echo $row['job_price'] ?></td>
                <td style="text-align: right">$<?php echo $row['awarded_price'] ?></td>
                <td style="text-align: right"><?php
                    if($row['awarded_admin_id'] != '') {
                        $admin = $this->db->select('first_name,last_name')->get_where('admin',['id'=>$row['awarded_admin_id']]);
                        if($admin->num_rows > 0){
                            $admin = $admin->first_row();
                            echo $admin->first_name.' '.$admin->last_name;
                        }
                        }else{
                        echo 'Unknown';
                    }
                    ?></td>
                <td style="text-align: right"><?php
                    if($row['completed_admin_id'] != '') {
                        $admin = $this->db->select('first_name,last_name')->get_where('admin',['id'=>$row['completed_admin_id']]);
                        if($admin->num_rows > 0){
                            $admin = $admin->first_row();
                            echo $admin->first_name.' '.$admin->last_name;
                        }
                    }else{
                        echo 'Unknown';
                    }
                    ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<!--</td>-->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.min.js' ?>"></script>
    <script type="text/javascript">
        $("#dynamic_table_<?php echo $line_number_code; ?>").dataTable({
            pageLength: 7,
            ordering: false,
            searching: false,
            lengthChange:false,
        });
    </script>

    <?php
} else {
?>
<td colspan="5">No details found</td>
<?php
}
?>
