<?php $this->load->view('admin/includes/vwHeader');


?>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>select2.css">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>select2-bootstrap.css">
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
	<script type="text/javascript">
		$(function() {
		    $('input[name="daterange"]').daterangepicker();
		});
		
		$(function() {
    	$( "#invoiceDateFrom" ).datepicker().on('changeDate',function(e) {

		});

	    $( "#invoiceDateTo" ).datepicker().on('changeDate',function(e) {

		});

	});
		
	</script>
    <style media="screen">
        .toggle-details { cursor: pointer; }
    </style>

    <!-- #section:basics/sidebar -->
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
                        <a href="#">Job Profit</a>
                    </li>
                    <li class="active">Profit List</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <!-- #section:settings.box -->
                <?php $this->load->view('admin/includes/vwSidebar-settings'); ?>

                <!-- /section:settings.box -->
                <div class="page-header">
                    <h1>
                        Job Profit
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            View Profit List
                        </small>
                    </h1>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <?php if($this->session->flashdata('success_message')) { ?>
                        <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p><?php echo $this->session->flashdata('success_message'); ?></p>
                        </div>
                        <?php } ?>

                        <?php if($this->session->flashdata('error_message')) { ?>
                        <div class="alert alert-block alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p><?php echo $this->session->flashdata('error_message'); ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header">
                            Results for "Job Profit List"
                        </div>

                        <style type="text/css">
                            .order_by_cls { display:none; }
                            .nonvisible { display:none; }
                        </style>

                        <div class="row">
                            <div class="col-md-12" style="padding: 10px;">
                                <div class="col-sm-4">
                                    <label>&emsp;</label>
                                <?php
                                 $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                                 $attributes1 = array('class' => 'form-inline reset-margin', 'id' => 'myform1');
                                 echo form_open('admin/profit/', $attributes);
                                 $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Search');
                                 $datai = array(
                                        'name'        => 'search_string',
                                        'placeholder' => 'Search Job title and Line numbers',
                                        'class'       => 'col-sm-9',
                                        'style'       => 'margin-right: 10px;'
                                  );
                                 echo form_input($datai,$this->session->userdata('search_string_selected'));

                                 echo form_submit($data_submit);
                                 echo form_close();
                                 ?>
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-sm-10 form-inline">
                                        <label>Enter profit margin below which to search in %</label>
                                        <form action="<?php echo base_url(); ?>admin/profit/" method="post" id="margin_form">
                                       <input type="number" min="0" max="100" name="percentage_from" class="form-control" placeholder="Margin from" value="<?php echo ($this->session->userdata('percentage_from') != false)?$this->session->userdata('percentage_from'):''; ?>" style="width: 40%">
                                            <input type="number" class="form-control" name="percentage_to" value="<?php echo ($this->session->userdata('percentage_to')!= false)?$this->session->userdata('percentage_to'):''; ?>" style="width: 40%" placeholder="Margin to" min="0" max="100">
                                            <input type="submit" value="Search" class="btn btn-primary btn-sm">
                                        </form>
                                    </div>
                                <div class="col-sm-2">
                                    <label>&emsp;</label>
                            <input type="button" onclick="location.href='<?php echo base_url().'admin/profit/reset' ;?>'" class="btn btn-primary pull-right btn-sm" value="Reset Filter">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row" style = "padding: 15px 0;">
					  		<?php echo form_open('admin/profit/', $attributes1); ?>
					  		<div class = "row">
                                <div class="col-sm-5">
					  			<h5>Filter by Date</h5>
						  			<div class = "col-sm-6">
						  				<input class = "form-control" type="text" id = "invoiceDateFrom" name = "invoiceDateFrom" placeholder = "From Date" value="<?php echo $this->session->userdata('start_date');?>">
						  			</div>
						  			<div class = "col-sm-6">
						  				<input class = "form-control" type="text" id = "invoiceDateTo" name = "invoiceDateTo" placeholder = "To Date" value="<?php echo $this->session->userdata('end_date'); ?>">
                                    </div>
                                </div>
                                    <div class="col-sm-5">
                                        <h5>Filter by Job Language</h5>
                                    <div class="col-sm-6"><?php
                                        $sql=" SELECT * FROM `languages` ORDER BY `name` ";
                                        $val=$this->db->query($sql);
                                        $lang=$val->result();
                                        ?>
                                        <select name="language_from" id="lang_from" class="form-control">
                                            <option value=""> Select Language </option>
                                            <?php foreach ($lang as $lang1) { ?>
                                                <option value="<?php echo $lang1->id; ?>" <?php echo ($this->session->userdata('lang_from') == $lang1->id)?'selected':''; ?>><?php echo $lang1->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="language_to" id="lang_to" class="form-control">
                                            <option value=""> Select Language </option>
                                            <?php foreach ($lang as $lang1) { ?>
                                                <option value="<?php echo $lang1->id; ?>" <?php echo ($this->session->userdata('lang_to') == $lang1->id)?'selected':''; ?>><?php echo $lang1->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    </div>
						  			<div class = "col-sm-2">
                                        <h5><p style="font-size: 10px !important;">Check the box to add reverse language search</p></h5>
                                            <input type="checkbox" name="lang_reverse_search" <?php echo ($this->session->userdata('lang_check_reverse') != false)?'checked':''; ?>>
                                        &nbsp;&nbsp;<input type="button" onclick="search_submit('<?php echo base_url().'admin/profit/'; ?>');" name="mysubmit" class="btn btn-primary btn-sm pull-right" Value="Go">&nbsp;&nbsp;
						  			</div>
						  		</div>

					  		</div>
					  		<?php echo form_close(); ?>
					  	</div>
                        <div class="col-sm-12" style="color: #ffffff; font-size: 12px; background-color: #307ecc; padding: 10px 10px">
                                    <?php
                                    echo 'Total Jobs '.$finance_summary->total_jobs.', ';
                                    echo '&nbsp;Total Job Price $'.number_format($finance_summary->total_job_price, 2, '.', ',').', ';
                                    echo '&nbsp;Total Awarded Price $'.number_format($finance_summary->total_awarded_price, 2, '.', ',').', ';
                                    echo '&nbsp;Total Gross Profit $'.number_format($finance_summary->total_profit, 2, '.', ',').', ';
                                    echo '&nbsp;Average Gross Profit $'.number_format($finance_summary->average_profit, 2, '.', ',').', ';
                                    echo '&nbsp;Avarage Profit Margin $'.number_format($finance_summary->avarage_profit_margin,2,'.',',').'%';
                                    ?>
                        </div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center">Job Title</th>
                                    <th class="center">Translator</th>
                                    <th style="text-align: right;">Job Price</th>
                                    <th style="text-align: right;">Awarded Price</th>
                                    <th style="text-align: right;">Gross Profit</th>
                                    <th style="text-align: right;">Gross Profit Margin</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (count($jobprofit)) {

                                    ?>




                                    <?php foreach ($jobprofit as $profit) {
                                        ?>
                                <tr class="toggle-details" data-id="<?php echo $profit['lineNumberCode'] ?>" data-job-id="<?php echo $profit['id']?>">
                                    <td>
                                        <?php
                                        /* if ($profit['lineNumberCode'] == '') {
                                             $job = $profit['name'];
                                         } else {
                                             $job = $profit['name'].' / '.$profit['lineNumberCode'];
                                         }*/
                                         ?>
                                           <?php
                                         if ($profit['name'] == '') {
                                             $job = 'Job Manually Entered / '.$profit['lineNumberCode'];
                                         } else if(strpos($profit['name'],',')){
                                             $job = 'Multiple Jobs / '.$profit['lineNumberCode'];
                                         }else{
                                             $job = $profit['name'].' / '.$profit['lineNumberCode'];
                                         }
                                         ?>
                                        <a href="<?php echo base_url(); ?>admin_jobpost/viewsummary/<?php echo $profit['id']; ?>" target="_blank"><?php echo $job ?></a>
                                    </td>
                                    <td>
                                        <?php
                                        $sql = "SELECT t.id, CONCAT(t.first_name, ' ', t.last_name) translator_name FROM bidjob b JOIN translator t ON t.id = b.trans_id JOIN jobpost j ON b.job_id = j.id  WHERE b.awarded = 1 AND (b.stage = 2 OR b.stage = 3) AND j.lineNumberCode = '".$profit['lineNumberCode']."'";
                                        $query =$this->db->query($sql);

                                        if ($query->num_rows()) {
                                            $translator_name = '';
                                            foreach ($query->result_array() as $key => $translator) {
                                                $translator_name_raw[] = "{$translator['translator_name']},{$translator['id']}";
                                            }

                                            $translator_name_arr = array_unique($translator_name_raw);

                                            foreach ($translator_name_arr as $name) {
                                                $name_arr = explode(',', $name);
                                                $translator_name .= '<a target="_blank" href="'.base_url().'admin_translators/edittranslator/'.$name_arr[1].'">'.$name_arr[0].'</a>'.', ';
                                            }

                                            $translator_name = trim($translator_name, ', ');
                                        }

                                        unset($translator_name_raw);
                                        unset($translator_name_arr);
                                         ?>
                                         <?php echo $translator_name ?>
                                    </td>
                                    <td style="text-align: right;">$<?php echo number_format($profit['job_price'], 2, '.', ',') ?></td>
                                    <td style="text-align: right;">$<?php echo number_format($profit['awarded_price'], 2, '.', ',') ?></td>
                                    <td style="text-align: right;">$<?php echo number_format($profit['profit'], 2, '.', ',') ?></td>
                                     <td style="text-align: right;"><?php $leftover = $profit['profit'] / $profit['job_price']; ?><?php echo $percent_friendly = number_format( $leftover * 100, 2 ) . '%';?></td>
                                </tr>
                                <tr class="job-id-<?php echo $profit['id'] ?>-wrapper" style="display:none">
                                    <td colspan="5">loading... </td>
                                </tr>
                                    <?php }
                                    ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="5">No data found</td>
                                </tr>
                                <?php }?>
                            </tbody>

                        </table>
                    </div>
                    <?php if ($this->pagination->create_links()) { ?>
                    <div class="col-md-12">
                        <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
                    </div>
                    <?php } ?>
                </div>
                <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
            </di>
        </div>
    </div>

</div>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>select2.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.toggle-details', function (e) {
            var line = $(this).data('id');
            var job_id = $(this).data('job-id');
            if ($('.job-id-'+job_id+'-wrapper').is(':visible')) {
                $('.job-id-'+job_id+'-wrapper').hide();
            } else {
                $('.job-id-'+job_id+'-wrapper').show();

                $.ajax({
                    url: "<?php echo base_url() ?>admin_profit/load_line_number_details",
                    data: { line_number_code: line},
                    success: function (response) {
                        $('.job-id-'+job_id+'-wrapper').css('background-color', '#333');
                        $('.job-id-'+job_id+'-wrapper').html('<td colspan="5">' + response + '</td>');
//                        $("#dynamic_table").dataTable().fnDestroy()
                    }
                });
            }
        });

        $("#lang_from").select2({
            allowClear:true,
            placeholder: 'Select Language From'
        });

        $("#lang_to").select2({
            allowClear:true,
            placeholder: 'Select Language To'
        });

    });

    function search_submit(url) {
        var formdata = $("#myform").serialize() + '&' + $("#margin_form").serialize() + '&' + $("#myform1").serialize();
        $.ajax({
            type:"POST",
            url:url,
            data:formdata,
            dataType:'json',
            success:function(data){
                if(data === 'success') {
                    window.location.href = url;
                }
            }
        })
    }
</script>

<?php $this->load->view('admin/includes/vwFooter'); ?>
