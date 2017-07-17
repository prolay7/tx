<?php $this->load->view('admin/includes/vwHeader'); ?>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <?php $this->load->view('admin/includes/vwSidebar-left'); ?>

    <div class="main-content">
        <div class="main-content-inner">

            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Review</a>
                    </li>
                    <li class="active">Review Job List</li>
                </ul>
            </div>

            <div class="page-content">
                <?php $this->load->view('admin/includes/vwSidebar-settings'); ?>

                <div class="page-header">
                    <h1>
                        Review Job
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Review Job List
                        </small>
                    </h1>
                </div>

                <!-- start: content here -->
                <div class="row">
                    <div class="col-xs-12">

                        <?php if ($this->session->flashdata('success_message')) { ?>
                        <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>

                            <p><?php echo $this->session->flashdata('success_message'); ?></p>
                        </div>
                        <?php } ?>

                        <?php if ($this->session->flashdata('error_message')) { ?>
                        <div class="alert alert-block alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>

                            <p><?php echo $this->session->flashdata('error_message'); ?></p>
                        </div>
                        <?php } ?>

                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>

                        <div class="table-header">
                            Results for "Job List"
                        </div>

                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>

                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center">Job Title</th>
                                    <th class="center">Job Price</th>
                                    <th class="center">Job Status</th>
                                    <th class="center">Job Type</th>
                                    <th class="center">Description</th>
                                    <th class="center">Translate From</th>
                                    <th class="center">Translate To</th>
                                    <th class="center">Bids</th>
                                    <th>
                                        Operations
                                        <input type="checkbox" id="selecctall"/> Selecct All</span>
                                        <input type="submit" class="btn btn-danger" value="Multiple Delete" id="alldelete" />
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                    <?php
                                    $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

                                    echo form_open('admin_review/review/joblist', $attributes);
                                    echo form_label('Search:', 'search_string');

                                    $datai = array(
                                        'name'        => 'search_string',
                                        'placeholder' => 'Enter Job Title, Line Number',
                                        'value'       => '',
                                        'style'       => 'width: 450px;height: 30px;'
                                    );

                                    echo form_input($datai);

                                    $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Go');

                                    echo '&nbsp;&nbsp;'.form_submit($data_submit).'&nbsp;&nbsp;';

                                    echo form_close();
                                ?>

                                <button class="btn btn-info btn-reser btn-sm" onClick="reload()" >Reset</button>
                                <div class="clearfix">
                                    <div class="pull-right tableTools-container"></div>
                                </div>

                                <?php

                                // echo '<pre>'; print_r($joblists); exit;

                                if (count($joblists)) {
                                    $num = 1;
                                    foreach ($joblists as $joblist) {
                                ?>
                                <tr>
                                    <td>
                                        <input class="checkbox1" type="checkbox" name="check[]" value=" <?php echo $joblist['id']; ?>" id="chk<?php echo $num;?>" style="margin-right: 7px;">
                                        <a href="<?php echo base_url('admin_review/viewsummary/' . $joblist['id']) ?>" target="_blank"><?php echo $joblist['name'] ?> / <?php echo $joblist['lineNumberCode'] ?></a>
                                    </td>
                                    <td><?php echo "$ ".$joblist['price']; ?></td>
                                    <td>
                                        <?php
                                        $stage = $joblist['stage'];
                                        if ($stage != 2) {
                                            echo 'OPEN';
                                        }

                                        if ($stage == 2) {
                                            echo 'CLOSE';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $job_type=$joblist['job_type'];
                                        if ($job_type==0) {
                                            echo 'Public';
                                        }
                                        if ($job_type==1) {
                                            echo 'Private';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if(strlen($joblist['description'])>70) {
                                            echo substr($joblist['description'],0,70).'...';
                                        } else {
                                            echo $joblist['description'];
                                        }
                                        ?>
                                    </td>

                                    <?php
                                    $language_id=$joblist['language'];
                                    $pieces = explode("/", $language_id);
                                    $languagef_id=$pieces[0];
                                    $sql1="select `name` from `languages` where `id`='$languagef_id'";
                                    $query1=$this->db->query($sql1);
                                    $fetch1=$query1->row();
                                    $languagef_name=$fetch1->name;
                                    ?>

                                    <td><?php echo $languagef_name; ?></td>

                                    <?php
                                    $language_id=$pieces[1];
                                    $sql="select `name` from `languages` where `id`='$language_id'  ";
                                    $query=$this->db->query($sql);
                                    $fetch=$query->row();
                                    $language_name=$fetch->name;
                                    ?>

                                    <td><?php echo $language_name; ?></td>

                                    <?php
                                    $job_id=$joblist['id'];
                                    $bidsql="select `job_id` from `bidjob` where `job_id`='$job_id'";
                                    $bidquery=$this->db->query($bidsql);
                                    $bid_num=$bidquery->num_rows();
                                    ?>

                                    <td>
                                        <?php if ($bid_num >= 1) { ?>
                                        <a href="<?php echo base_url(); ?>admin_review/viewsummary/<?php echo $joblist['id']; ?>" target="_blank" class="btn btn-success" > <?php echo $bid_num; ?>&nbsp;Bids</a>
                                        <?php } else { ?>
                                        <a href="javascript:void(0)" style="cursor:default"class="btn btn-success" ><?php echo $bid_num; ?> &nbsp;Bids</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
										
											<?php 
											$job_id=$joblist['id'];
											$sql="select is_done from bidjob where `job_id`='$job_id' and `is_done` = 1";
											$query=$this->db->query($sql);
											$fetch=$query->num_rows();

											if($fetch > 0){
												
												}else{?>
											 
                                            <a class="green" href="<?php echo base_url(); ?>admin_review/edit/<?php echo $joblist['id']; ?>" target="_blank">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>
												<?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                        $num++;
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="9" align="center">No Review Job Found</td>
                                </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                        <?php if ($this->pagination->create_links()) { ?>
                        <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
                        <?php } ?>

                    </div>

                    <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>

                </div>
                <!-- end: content here -->

            </div>

        </div>
    </div>
</div>

<?php $this->load->view('admin/includes/vwFooter'); ?>

<script type="text/javascript">
function reload() {
    window.location.href="<?php echo base_url().'admin_review/review/joblist/'?>";
}

function goBack() {
    window.history.back();
}

$(document).ready(function() {
    $(document).on('click', '#selecctall', function(event) {
        if (this.checked) {
            $('.checkbox1').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkbox1').each(function() {
                this.checked = false;
            });
        }
    });

    $(document).on('click', '#alldelete', function(event) {
        del = confirm("Are you sure to delete permanently?");

        if (del != true) {
            return false;
        } else {
            del1 = confirm("THERE IS NO WAY TO REVERSE the delete, do want to proceed anyway?. ");

            if (del1 != true) {
                return false;
            } else {
                var arr=[];
                $.each($("input[name='check[]']:checked"),function(){
                    arr.push($(this).val());
                });

                var id = arr.toString();

                if (id != "") {
                    $.ajax({
                        type: "POST",
                        data: { id: id },
                        url: "<?php echo base_url('admin_jobpost/deleteall'); ?>",
                        success: function(data){
                            window.location.reload();
                        }
                    });
                } else {
                    alert("Please select atleast one job");
                }
            }
        }
    });
});
</script>
