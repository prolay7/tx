<?php
$this->load->view('admin/includes/vwHeader');
?>
<link rel="stylesheet" href="<?php echo  HTTP_ASSETS_PATH_ADMIN; ?>css/jquery-confirm.min.css">
<style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>


			<?php
				$this->load->view('admin/includes/vwSidebar-left');
			?>


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
								<a href="#">Job</a>
							</li>
							<li class="active">Add Job</li>
						</ul>


					</div>


					<div class="page-content">
						<?php
							$this->load->view('admin/includes/vwSidebar-settings');
						?>

						<div class="page-header">
							<h1>
								Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Job
								</small>
							</h1>
						</div>

						<div class="row">
							<div class="col-xs-12">
                                <div id="form-nothing-changed" class="alert alert-block alert-warning" style="display:none">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    <p> Nothing has been updated! </p>
                                </div>

								<?php if (isset($message_error) && $message_error!="") { ?>
                                     <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo $message_error; ?> </p>
                                    </div>
                                <?php } ?>

                                <?php if (isset($message_success) && $message_success!="") { ?>
                                     <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo $message_success; ?> </p>
                                    </div>
                                <?php } ?>
                                 <?php  if($this->session->flashdata('flash_message')){
								 	if($this->session->flashdata('flash_message') == 'try_another') { ?>
                                    <div class="alert alert-block alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> Alias name is not available. Try another. </p>
                                    </div> <?php
                                }} ?>
                                <?php if (validation_errors()!="") { ?>
                                     <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo validation_errors(); ?> </p>
                                    </div>
                                <?php } ?>

                                <?php
							  //form data
							  $attributes = array('class' => 'form-horizontal', 'id' => 'addjobpost');
							  //form validation
							  echo form_open_multipart('admin/jobpost/add', $attributes);
							  ?>

                                    <div class="form-group lineNumberInput">
                						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Line Number* </label>
                						<div class="col-sm-9">
                                            <?php
                                                $curr_month = date("m"); $curr_year = date("y");
                                                if (isset($curr_values['lineMonth'])) {
                                                    $curr_month = $curr_values['lineMonth'];
                                                }

                                                if (isset($curr_values['lineYear'])) {
                                                    $curr_year = $curr_values['lineYear'];
                                                }
                                            ?>
                							<select name="lineMonth" id="lineMonth" class="col-xs-3 col-sm-2 validate[required]" >
                								<option value="01" <?php if($curr_month == "01") echo "selected"; ?>>January</option>
                								<option value="02" <?php if($curr_month == "02") echo "selected"; ?>>February</option>
                								<option value="03" <?php if($curr_month == "03") echo "selected"; ?>>March</option>
                								<option value="04" <?php if($curr_month == "04") echo "selected"; ?>>April</option>
                								<option value="05" <?php if($curr_month == "05") echo "selected"; ?>>May</option>
                								<option value="06" <?php if($curr_month == "06") echo "selected"; ?>>June</option>
                								<option value="07" <?php if($curr_month == "07") echo "selected"; ?>>July</option>
                								<option value="08" <?php if($curr_month == "08") echo "selected"; ?>>August</option>
                								<option value="09" <?php if($curr_month == "09") echo "selected"; ?>>September</option>
                								<option value="10" <?php if($curr_month == "10") echo "selected"; ?>>October</option>
                								<option value="11" <?php if($curr_month == "11") echo "selected"; ?>>November</option>
                								<option value="12" <?php if($curr_month == "12") echo "selected"; ?>>December</option>
                							</select>
                							<div style="float:left;">&nbsp;</div>
                							<select name="lineYear" id="lineYear" class="col-xs-2 col-sm-1 validate[required]" >
                								<?php foreach(range(date('Y'), 2050) as $year) { ?>
            									<option value="<?php echo substr($year, -2); ?>" <?php if($curr_year == substr($year, -2)) echo 'selected'; ?>><?php echo $year; ?></option>
                								<?php } ?>
                							</select>
                							<span style="float:left;">&nbsp;L&nbsp;</span>
                						  	<input name="lineNumber" type="text" id="lineNumber" class="col-xs-2 col-sm-1" value="<?php echo set_value('lineNumber') ?>" />
                						</div>

                                        <input type="hidden" id="_lineMonth" name="_lineMonth" value="" />
                                        <input type="hidden" id="_lineYear" name="_lineYear" value="" />
                                        <input type="hidden" id="_lineNumber" name="_lineNumber" value="" />
                					</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name* </label>
										<div class="col-sm-9">
											<input name="name" type="text" id="name" class="col-xs-10 col-sm-5 validate[required]" value="<?php echo set_value('name') ?>" />
										</div>
									</div>
                                    <input name="alias" type="hidden" id="alias" class="col-xs-10 col-sm-5" value="<?php echo set_value('alias') ?>" />

                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price($)* </label>
										<div class="col-sm-3">
										  	<input name="price" type="text" id="price" class="validate[required,custom[integer]" value="<?php echo set_value('price') ?>" style="width: 100%" />
										</div>
                                        <div class="col-sm-6">
                                            <div class="remaining-balance-wrapper"> </div>
                                            <input type="hidden" id="remaining_balance" name="remaining_balance" />
                                            <input type="hidden" id="original_balance" name="original_balance" />
                                        </div>
									</div>


                                <div class="form-group">

                                    <div class="col-sm-9 col-sm-offset-3">

                                    <div id="mulitplefileuploader">Upload</div>
									<div id="status"></div>
                                    <input type="hidden" name="totalFile" id="totalFile" value="<?php if($this->session->userdata('totalFile')){echo $this->session->userdata('totalFile');} ?>" class="validate[required]" />
                                    </div>
							    </div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description*</label>
										<div class="col-sm-9">
                                        	<textarea  name="desc" id="editor" class="validate[required]"><?php echo set_value('desc') ?></textarea>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From* </label>
										<?php
										 $sql=" SELECT * FROM `languages` ORDER BY `name` ";
							  			 $val=$this->db->query($sql);
							 			 $lang=$val->result();
										?>
										<div class="col-sm-9">
                                            <select name="language_from" id="language_from" class="validate[required]" style="width: 42%">
                                                <option value=""> Select Language </option>
                                                <?php foreach ($lang as $lang1) { ?>
			                                    <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To* </label>
										<?php
										 $sql=" SELECT * FROM `languages` ORDER BY `name` ";
							  			$val=$this->db->query($sql);
							 			 $lang=$val->result();
										?>
										<div class="col-sm-9">
                                            <select name="language" id="language" class="validate[required]" style="width: 42%">
                                                <option value=""> Select Language </option>
                                                <?php foreach ($lang as $lang1) { ?>
		                                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
									</div>

<input type="hidden" name="language_from_val" value="">
<input type="hidden" name="language__val" value="">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Due Date* </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="dueDate" id="dueDate" class="datepicker col-xs-5 col-sm-2 validate[required]" value="<?php echo set_value('dueDate') ?>" />
                                            <select class="col-xs-5 col-sm-1 validate[required]" name="hour" style="height: 37px; margin-left: 7px;">
                                                <option value="">Hr</option>
                                                <option value="01" <?php echo (date('h') == '01') ? 'selected' : '' ?> >01</option>
                                                <option value="02" <?php echo (date('h') == '02') ? 'selected' : '' ?> >02</option>
                                                <option value="03" <?php echo (date('h') == '03') ? 'selected' : '' ?> >03</option>
                                                <option value="04" <?php echo (date('h') == '04') ? 'selected' : '' ?> >04</option>
                                                <option value="05" <?php echo (date('h') == '05') ? 'selected' : '' ?> >05</option>
                                                <option value="06" <?php echo (date('h') == '06') ? 'selected' : '' ?> >06</option>
                                                <option value="07" <?php echo (date('h') == '07') ? 'selected' : '' ?> >07</option>
                                                <option value="08" <?php echo (date('h') == '08') ? 'selected' : '' ?> >08</option>
                                                <option value="09" <?php echo (date('h') == '09') ? 'selected' : '' ?> >09</option>
                                                <option value="10" <?php echo (date('h') == '10') ? 'selected' : '' ?> >10</option>
                                                <option value="11" <?php echo (date('h') == '11') ? 'selected' : '' ?> >11</option>
                                                <option value="12" <?php echo (date('h') == '12') ? 'selected' : '' ?> >12</option>
                                            </select>
                                            <select class="col-xs-5 col-sm-1 validate[required]" name="minute" style="height: 37px; margin-left: 7px;">
                                                <option value="">Min</option>
                                                <?php for ($i = 0; $i <= 59; $i++) { ?>
                                                <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT)?>" <?php echo (date('i') == $i) ? 'selected' : '' ?> ><?php echo str_pad($i, 2, '0', STR_PAD_LEFT)?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="col-xs-5 col-sm-1 validate[required]" name="ampm" style="height: 37px; width: 79px; margin-left: 7px;">
                                                <option value="AM" <?php echo (date('A') == 'AM') ? 'selected' : '' ?> >AM</option>
                                                <option value="PM" <?php echo (date('A') == 'PM') ? 'selected' : '' ?> >PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1" > Job Type: </label>
                                        <div class="col-sm-9">
                                            <select name="type" class="col-xs-10 col-sm-5 validate[required]">
                                                <option value="">Select Type</option>
                                                <option value="1" <?php echo set_value('type') == 1 ? "selected" : "" ?>>Private</option>
                                                <option value="0" <?php echo set_value('type') == 0 ? "selected" : "" ?>>Public</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="proofreadQuestion">
			                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Proofreading required? </label>
			                            <div class="col-sm-9" style="padding-top:5px">
			                                <input type="radio" class="form-input input-radio proofread_required" value="1" id="proofread_required" name="proofread_required" /> Yes |
			                                <input type="radio" class="form-input radio-input proofread_required" value="0" id="proofread_required" name="proofread_required" checked="" /> No
			                            </div>
			                        </div>
			                		<input type="hidden" name="job_stage" value="0">
                                                <!--
			                        <div class="form-group" style="display:none;" id="proofreadSettings">
			                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Proofreading type</label>
			                            <div class="col-sm-9" style="padding-top:5px">
			                                <input type="radio" class="form-input input-radio proofreadType" value="editing" id="proofreadType" name="proofreadType" /> Editing |
			                                <input type="radio" class="form-input radio-input proofreadType" value="comparison" id="proofreadType" name="proofreadType" /> Comparison
			                            </div>
			                        </div> -->

                                    <input type="hidden" name="stage" value="0">

                                    <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit" id="toggle-job-form-submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>

                                <?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div id="dialog-line-numbers" title="Validating Job Line Number" style="display:none">
            <p style="font-size: 14px;">This line number already has a job associated to it. Do you want to associate this?</p>
            <div class="job-info-wrapper" style="padding: 10px; font-size: 15px;"> </div>
        </div>


<!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>
<!--<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jqueryn.js"></script>-->


<?php
$this->load->view('admin/includes/vwFooter');
?>

<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/uploadfilemulti.css" />
<!--<link rel="stylesheet" href="--><?php //echo HTTP_ASSETS_PATH_ADMIN; ?><!--css/jquery-ui-1.12.1.min.css" />-->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/select2.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/select2.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-confirm.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
    var last_selected_type = $("#type option:selected").val();
    var last_selected_proofread_required = $("input[name='proofread_required']:checked").val();

    var current_selected_line_month = $("#lineMonth option:selected").val();
    var current_selected_line_year = $("#lineYear option:selected").val();
    var current_line_number_value = $('#lineNumber').val();

    var formChanged = false;
    //copying the data of language from and to dropdown to hidden field for validation purpose
$("#language_from").change(function(){
    console.log($("#language_from").val());
    $("input[name='language_from_val']").val($("#language_from").val());
});
$("#language").change(function(){
    console.log($("#language").val());
    $("input[name='language__val']").val($("#language").val());
});

    $(document).on('change', 'select', function(){
        formChanged = true;
    });

    $(document).on('change', 'input[type=radio]', function(){
        formChanged = true;
    });

    $(document).on('change keyup paste mouseup', 'input', function(){
        formChanged = true;
    });


    CKEDITOR.instances.editor.on('change', function() {
        formChanged = true;
    });

    $(document).on('click', '#submit-form-edit', function (e) {
        e.preventDefault();
        if (formChanged) {
            formChanged = false;
            $('#addjobpost').submit();
        } else {
            $('#form-nothing-changed').show();
            setInterval(function () { $('#form-nothing-changed').fadeOut(200) }, 3000);
        }
    });

    $('#language_from').select2({
        placeholder: "Select language",
        allowClear: true
    });

    $('#language').select2({
        placeholder: "Select language",
        allowClear: true
    });

	 $(document).on('change', '#type', function() {
        if($(this).val() == 1) {
            $("proofreadQuestion").show();
        } else {
            $("proofreadQuestion").hide();
        }
    });

    $('body').on('focus', '#dueDate', function() {
        $(this).datetimepicker({
            format: 'MM-DD-YYYY',
            minDate: 'now'
        });
    });

    $(document).on('change', '#lineMonth, #lineYear', function (e) {
        $('#lineNumber').trigger('blur');
    });

    $(document).on('blur', '#lineNumber', function (e) {
        if (current_selected_line_month == $("#lineMonth option:selected").val() && current_selected_line_year == $('#lineYear option:selected').val() && current_line_number_value == $(this).val()) {
        } else {
            $.ajax({
                url: "<?php echo base_url() ?>jobpost/check/line-number",
                data: { line_month: $('#lineMonth option:selected').val(), line_year: $('#lineYear option:selected').val(), line_number: $('#lineNumber').val() },
                success: function (response) {
                    if (response != null && response != '') {
                        response = jQuery.parseJSON(response);
                        $('#dialog-line-numbers').dialog({
                            resizable: false,
                            height: "auto",
                            width: 700,
                            modal: false,
                            closeOnEscape: false,
                            open: function(event, ui) {
                                $(".ui-dialog-titlebar-close").hide();
                            },
                            buttons: {
                                "Yes": function () {
                                    $(this).dialog('close');

                                    $.ajax({
                                        url: "<?php echo base_url() ?>admin_jobpost/get/job-price",
                                        data: { line_month: $('#lineMonth option:selected').val(), line_year: $('#lineYear option:selected').val(), line_number: $('#lineNumber').val() },
                                        success: function (response) {
                                            if (response != null || response != '') {
                                                response = jQuery.parseJSON(response);
                                                $('.remaining-balance-wrapper').html('Remaining Balance: $' + response.price);
                                                $('#remaining_balance').val(response.price);
                                                $('#price').val(response.original_price);
                                                $('#original_price').val(response.original_price);

                                                $('#_lineMonth').val($('#lineMonth option:selected').val());
                                                $('#_lineYear').val($('#lineYear option:selected').val());
                                                $('#_lineNumber').val($('#lineNumber').val());

                                                $('#price').attr('readonly', 'readonly');
                                                $('#lineNumber').attr('readonly', 'readonly');
                                                $('#lineMonth').attr('disabled', 'disabled');
                                                $('#lineYear').attr('disabled', 'disabled');

                                                formChanged = true;
                                            }
                                        }
                                    });
                                },
                                "No": function () {
                                    $(this).dialog("close");
                                    $('#lineNumber').val(current_line_number_value);
                                    $('#lineMonth option[value='+ current_selected_line_month +']').attr('selected', 'selected');
                                    $('#lineYear option[value='+ current_selected_line_year +']').attr('selected', 'selected');
                                    $('#lineNumber').focus();

                                    formChanged = false;
                                }
                            }
                        });

                        var content = "Job: <span style='font-weight: bold'>" + response.job_name + "</span>, <span style='font-weight: bold'>Language: " + response.language_from + "</span> to <span style='font-weight: bold'>" + response.language_to + "</span>, Price: <span style='font-weight: bold'>$"+ response.price +"</span>. Date Posted: <span style='font-weight: bold'>" + response.date_added + "</span>";
                        $('.job-info-wrapper').html(content);
                    }
                }

            });
        }
    });

    $(document).on('click', '#toggle-job-form-submit', function (e) {
        e.preventDefault();

        if ( $('input').is('[readonly]') ) {
            if (formChanged) {
                $("#addjobpost").trigger('submit');
                formChanged = false;
            }
        } else {
            $.ajax({
                url: "<?php echo base_url() ?>jobpost/check/line-number",
                data: { line_month: $('#lineMonth option:selected').val(), line_year: $('#lineYear option:selected').val(), line_number: $('#lineNumber').val() },
                success: function (response) {

                    if (response != null && response != '') {
                        response = jQuery.parseJSON(response);
                        $('#dialog-line-numbers').dialog({
                            resizable: false,
                            height: "auto",
                            width: 700,
                            modal: false,
                            closeOnEscape: false,
                            open: function(event, ui) {
                                $(".ui-dialog-titlebar-close").hide();
                            },
                            buttons: {
                                "Yes": function () {
                                    $(this).dialog('close');

                                    $.ajax({
                                        url: "<?php echo base_url() ?>admin_jobpost/get/job-price",
                                        data: { line_month: $('#lineMonth option:selected').val(), line_year: $('#lineYear option:selected').val(), line_number: $('#lineNumber').val() },
                                        success: function (response) {
                                            if (response != null || response != '') {
                                                response = jQuery.parseJSON(response);
                                                $('.remaining-balance-wrapper').html('Remaining Balance: $' + response.price);
                                                $('#remaining_balance').val(response.price);
                                                $('#price').val(response.original_price);
                                                $('#original_price').val(response.original_price);

                                                $('#_lineMonth').val($('#lineMonth option:selected').val());
                                                $('#_lineYear').val($('#lineYear option:selected').val());
                                                $('#_lineNumber').val($('#lineNumber').val());

                                                $('#price').attr('readonly', 'readonly');
                                                $('#lineNumber').attr('readonly', 'readonly');
                                                $('#lineMonth').attr('disabled', 'disabled');
                                                $('#lineYear').attr('disabled', 'disabled');

                                                formChanged = true;
                                            }
                                        }
                                    });
                                },
                                "No": function () {
                                    formChanged = false;
                                    $(this).dialog("close");
                                }
                            }
                        });

                        var content = "Job: <span style='font-weight: bold'>" + response.job_name + "</span>, <span style='font-weight: bold'>Language: " + response.language_from + "</span> to <span style='font-weight: bold'>" + response.language_to + "</span>, Price: <span style='font-weight: bold'>$"+ response.price +"</span>. Date Posted: <span style='font-weight: bold'>" + response.date_added + "</span>";
                        $('.job-info-wrapper').html(content);
                    } else {
                        if (formChanged) {
                            //check if form has empty val
                            var error = '';
                            if($("input[name='lineMonth']").attr("selectedIndex") == 0){
                                error += '<p>Select Line Month</p>';
                            }
                            if($("input[name='lineYear']").attr("selectedIndex") == 0){
                                error += '<p>Select Line Year</p>';
                            }
                            if($("input[name='lineNumber']").val() == ''){
                                error += '<p>Enter Line Number</p>';
                            }
                            if($("input[name='name']").val() == ''){
                                error += '<p>Enter Job Name</p>';
                            }
                            if($("input[name='price']").val() == ''){
                                error += '<p>Enter Price</p>';
                            }
                            if(CKEDITOR.instances['editor'].getData() == ''){
                                error += '<p>Enter Description</p>';
                            }
                            if($("input[name='language_from_val']").val() == ''){
                                error += '<p>Select Language from</p>';
                            }
                            if($("input[name='language__val']").val() == ''){
                                error += '<p>Select Language To</p>';
                            }
                            if($("input[name='dueDate']").val() == ''){
                                error += '<p>Select Due Date</p>';
                            }
                            if($("input[name='minute']").attr("selectedIndex") == 0){
                                error += '<p>Enter Due Date Minute</p>';
                            }
                            if($("input[name='ampm']").attr("selectedIndex") == 0){
                                error += '<p>Select AM/PM</p>';
                            }
                            if($("input[name='type']").attr("selectedIndex") == 0){
                                error += '<p>Select Type</p>';
                            }
                            //check if form has empty val
                            if(error == '') {
                                $("#addjobpost").trigger('submit');
                            }else{
                                 $.alert({
                                     theme: 'modern',
                                     closeIcon: false,
                                     type: 'dark',
                                     typeAnimated: true,
                                     icon: 'fa fa-warning',
                                     title: 'Error!!',
                                     content: error,
                                 });
                            }
                        } else {
                            $('#form-nothing-changed').show();
                            setInterval(function () { $('#form-nothing-changed').fadeOut(200) }, 3000);
                        }
                    }

                }
            });
        }
    });

    // $("#addjobpost").submit(function(e) {
    //     // code here
    // });

var settings = {
	dataType: "html",
	url: "<?php echo base_url().'admin_jobpost/'.'upload';?>",
	method: "POST",
    allowedTypes:"jpg,jpeg,docx,xls,xlsx,ppt,pptx,png,gif,doc,pdf,zip,tar,txt,ai,mp3,wav,csv",
	fileName: "myfile",
	multiple: false,
	onSuccess:function(files,data,xhr)
	{
		$("#test").val("Glenn Quagmire");
		var total=$('#totalFile').val();
		$('#totalFile').val(total+data);
		var total1=$('#totalFile').val();
		var filePath = data;
		var currentId= $(".remove-file-cls").attr("id");
 		 $('#upload-statusbar-'+currentId).find('.remove-file-cls').html("<a href='javascript:void(0);' onclick='return theFunction();' class='test' id='"+filePath+"'>Remove</a>");

	},
    afterUploadAll:function()
    {
        //alert("all images uploaded!!");
    },
	onError: function(files,status,errMsg)
	{
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>
<script type="text/javascript">
  	function theFunction () {
	var id = $(".test").attr('id');
		 $.ajax({
					dataType: "html",
					type: "POST",
					data: {id:id},
					cache: false,
					url:  '<?php echo  base_url().'admin_jobpost/linkdelete';?>',
					success: function (data, textStatus){
						alert(data);
                	}
            });
    exit;
    }
</script>
