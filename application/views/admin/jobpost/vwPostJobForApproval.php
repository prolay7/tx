<?php
$this->load->view('admin/includes/vwHeader');
?>

<!-- <script type="text/javascript" src="<?php// echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/switch/dist/js/bootstrap-switch.js"></script> -->
<!-- <link href="<?php// echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/switch/dist/css/bootstrap-switch.css" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/jquery-confirm.min.css">
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
							<li class="active">Edit Job</li>
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
									Edit Job
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

                                           <?php if($this->session->flashdata('success_message'))
	  						    { ?>
								 <div class="alert alert-block alert-success">
								 <button type="button" class="close" data-dismiss="alert">
                                 <i class="ace-icon fa fa-times"></i>
                                 </button>

                                <p><?php echo $this->session->flashdata('success_message'); ?></p>
                                 </div>

                               <?php
							   }
							  ?>

                                  <?php if($this->session->flashdata('error_message'))
							    { ?>
								 <div class="alert  alert-danger">
								 <button type="button" class="close" data-dismiss="alert">
                                 <i class="ace-icon fa fa-times"></i>
                                 </button>

                                <p><?php echo $this->session->flashdata('error_message'); ?></p>
                                 </div>

                               <?php
							   }
							  ?>


                <?php
                $attributes = array('class' => 'form-horizontal', 'id'=>'admin-edit', 'enctype' => 'multipart/form-data');
                echo form_open('admin_jobpost/pendingEditApproval/'.$fetch->id, $attributes);
                ?>


                	<!-- <div class="form-group lineNumberCodeHide">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Line Number</label>
                        <div class="col-sm-9">
                        	<?php echo $fetch->lineNumberCode; ?> <span class="action-buttons editLineNumber" style="cursor:pointer;"><a class="editLineNumber"><i class="green ace-icon fa fa-pencil"></i></a></span>
                        </div>
                    </div> -->

                    <div class="form-group lineNumberInput">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Line Number* </label>
						<div class="col-sm-9">

							<select name="lineMonth" id="lineMonth" class="col-xs-3 col-sm-2 validate[required]" >
								<option value="01" <?php if($fetch->lineMonth == "01") echo "selected"; ?>>January</option>
								<option value="02" <?php if($fetch->lineMonth == "02") echo "selected"; ?>>February</option>
								<option value="03" <?php if($fetch->lineMonth == "03") echo "selected"; ?>>March</option>
								<option value="04" <?php if($fetch->lineMonth == "04") echo "selected"; ?>>April</option>
								<option value="05" <?php if($fetch->lineMonth == "05") echo "selected"; ?>>May</option>
								<option value="06" <?php if($fetch->lineMonth == "06") echo "selected"; ?>>June</option>
								<option value="07" <?php if($fetch->lineMonth == "07") echo "selected"; ?>>July</option>
								<option value="08" <?php if($fetch->lineMonth == "08") echo "selected"; ?>>August</option>
								<option value="09" <?php if($fetch->lineMonth == "09") echo "selected"; ?>>September</option>
								<option value="10" <?php if($fetch->lineMonth == "10") echo "selected"; ?>>October</option>
								<option value="11" <?php if($fetch->lineMonth == "11") echo "selected"; ?>>November</option>
								<option value="12" <?php if($fetch->lineMonth == "12") echo "selected"; ?>>December</option>
							</select>
							<div style="float:left;">&nbsp;</div>
							<select name="lineYear" id="lineYear" class="col-xs-2 col-sm-1 validate[required]" >
								<?php foreach(range(2016, 2050) as $year) { ?>
									<option value="<?php echo substr($year, -2); ?>" <?php if($fetch->lineYear == substr($year, -2)) echo 'selected'; ?>><?php echo $year; ?></option>
								<?php } ?>
							</select>
							<span style="float:left;">&nbsp;L&nbsp;</span>
						  	<input name="lineNumber" type="number" id="lineNumber" class="col-xs-2 col-sm-1" value="<?php echo $fetch->lineNumber; ?>" />
						</div>
					</div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Job Name* </label>
                        <div class="col-sm-9">
                        	<input name="name" id="name" class="col-xs-10 col-sm-5 validate[required]"  type="text" value="<?php echo $fetch->name; ?>" >

                        </div>
                    </div>

                	<input name="job_alias" id="job_alias" class="col-xs-10 col-sm-5 validate[required]"  type="hidden" value="<?php echo $fetch->alias; ?>">

                	<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Client Name* </label>
                        <div class="col-sm-9">
                        	<input name="clientName" id="clientName" class="col-xs-10 col-sm-5 validate[required]"  type="text" value="<?php echo $fetch->clientName; ?>" >

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Amount Charged($)*</label>
                        <div class="col-sm-9">
                        	<input name="price" id="price" class="col-xs-10 col-sm-5"  type="text" value="<?php echo $fetch->price; ?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Custom Instruction*</label>
                        <div class="col-sm-9">
                            <textarea  name="desc" id="editor" class="validate[required]"><?php echo $fetch->description; ?></textarea>
                        </div>
                    </div>
					<?php
						$sql=" SELECT * FROM `languages` ";
						$query=$this->db->query($sql);
						$Language_fetch=$query->result();
						$domain = strstr($fetch->file, '/',true);
						$view=explode("##",$fetch->file);
						array_pop($view);
						$num_of_file= count($view);
                	?>
                    <input type="hidden" name="domain" value="<?php echo $domain; ?>" />
                    <input type="hidden" name="numoffile" id="numoffile" value="<?php echo $num_of_file; ?>" />
					<?php
						for ($i = 0; $i < $num_of_file; $i++){
		                    if($view[$i]!= "") {
		                    $vie = strstr($view[$i], '/');
		                    $str = ltrim($vie, '/');
		                    if($str == ''){
		                    $str = $view[$i];
	                    }
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Uploaded File :                                        </label>
                        <div class="col-sm-9">
                            <a href="<?php echo base_url() ?>admin/jobpost/document/viewer/<?php echo $fetch->id ?>/<?php echo base64_encode($view[$i]) ?>" class="btn btn-app btn-purple btn-lg" target="_blank"><?php echo $str ?></a>
                            <a href="javascript:void(0);" class="btn btn-danger" id="remove" onclick="removealert('<?php echo $fetch->id; ?>','<?php echo $view[$i]; ?>')">Remove File</a>
                        </div>
                    </div>
                <input type="hidden" name="prefile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $fetch->file; ?>" />

               		 <?php }} //else { ?>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                        	<div id="mulitplefileuploader">Upload</div>
                        	<div id="status"></div>
                        	<input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
                        </div>
                    </div>
                         <?php $lang= $fetch->language;
							  		$lang=explode('/',$lang);
							  		//print_r($lang);
									 $lang_from=$lang[0];
									 $lang_to=$lang[1];
							  ?>

                              <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From* </label>
                                  <?php
                                      $sql="SELECT * FROM `languages` ORDER BY `name` ";
                                      $val = $this->db->query($sql);
                                      $lang = $val->result();
                                  ?>
                                  <div class="col-sm-9">
                                      <select name="language_from" id="language_from" class="validate[required]" style="width:42%">
                                          <option value=""> Select Language </option>
                                          <?php foreach ($lang as $lang1) { ?>
                                              <option value="<?php echo $lang1->id; ?>" <?php if($lang_from == $lang1->id) echo "selected"; ?>><?php echo $lang1->name; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To* </label>
                                  <div class="col-sm-9">
                                      <select name="language" id="language" class="validate[required]" style="width:42%">
                                          <option value=""> Select Language </option>
                                          <?php foreach ($lang as $lang1) { ?>
                                              <option value="<?php echo $lang1->id; ?>" <?php if($lang_to == $lang1->id) echo "selected"; ?>><?php echo $lang1->name; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                                <input type="hidden" name="language_from_val" value="<?php echo $lang_from; ?>">
                                <input type="hidden" name="language_val" value="<?php echo $lang_to; ?>">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Due Date*</label>
                            <div class="col-sm-9">
                                <?php
                                $due_date = explode(' ', $fetch->dueDate);
                                $time = explode(':', $due_date[1]);
                                if ($time[0]) {
                                    $hr = $time[0];
                                } else {
                                    $hr = date('h');
                                }
                                if ($time[1]) {
                                    $min = $time[1];
                                } else {
                                    $min = date('i');
                                }
                                if (isset($due_date[2])) {
                                    $ampm = $due_date[2];
                                } else {
                                    $ampm = date('A');
                                }
                                 ?>
                                <input type="text" name="dueDate" id="dueDate" class="datepicker col-xs-5 col-sm-2 validate[required]" value="<?php echo $due_date[0]; ?>" />
                                <select class="col-xs-5 col-sm-1 validate[required]" name="hour" style="height: 37px; margin-left: 7px;">
                                    <option value="">Hr</option>
                                    <option value="01" <?php echo ($hr == '01') ? 'selected' : '' ?> >01</option>
                                    <option value="02" <?php echo ($hr == '02') ? 'selected' : '' ?> >02</option>
                                    <option value="03" <?php echo ($hr == '03') ? 'selected' : '' ?> >03</option>
                                    <option value="04" <?php echo ($hr == '04') ? 'selected' : '' ?> >04</option>
                                    <option value="05" <?php echo ($hr == '05') ? 'selected' : '' ?> >05</option>
                                    <option value="06" <?php echo ($hr == '06') ? 'selected' : '' ?> >06</option>
                                    <option value="07" <?php echo ($hr == '07') ? 'selected' : '' ?> >07</option>
                                    <option value="08" <?php echo ($hr == '08') ? 'selected' : '' ?> >08</option>
                                    <option value="09" <?php echo ($hr == '09') ? 'selected' : '' ?> >09</option>
                                    <option value="10" <?php echo ($hr == '10') ? 'selected' : '' ?> >10</option>
                                    <option value="11" <?php echo ($hr == '11') ? 'selected' : '' ?> >11</option>
                                    <option value="12" <?php echo ($hr == '12') ? 'selected' : '' ?> >12</option>
                                </select>
                                <select class="col-xs-5 col-sm-1 validate[required]" name="minute" style="height: 37px; margin-left: 7px;">
                                    <option value="">Min</option>
                                    <?php for ($i = 0; $i <= 59; $i++) { ?>
                                    <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT)?>" <?php echo ($min == $i) ? 'selected' : '' ?> ><?php echo str_pad($i, 2, '0', STR_PAD_LEFT)?></option>
                                    <?php } ?>
                                </select>
                                <select class="col-xs-5 col-sm-1 validate[required]" name="ampm" style="height: 37px; width: 79px; margin-left: 7px;">
                                    <option value="AM" <?php echo ($ampm == 'AM') ? 'selected' : '' ?> >AM</option>
                                    <option value="PM" <?php echo ($ampm == 'PM') ? 'selected' : '' ?> >PM</option>
                                </select>
                            </div>
                        </div>

                		<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Job Type </label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="col-xs-10 col-sm-5 validate[required]">
                	                <option value="1" <?php echo ($fetch->job_type == 1) ? "selected" : "" ?>>Private</option>
                	                <option value="0" <?php echo ($fetch->job_type == 0) ? "selected" : "" ?>>Public</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group" id="proofreadQuestion">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Proofreading required? </label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <input type="radio" class="form-input input-radio proofread_required" value="1" id="proofread_required" name="proofread_required" <?php echo ($fetch->proofread_required == 1) ? "checked" : "" ?> /> Yes |
                                <input type="radio" class="form-input radio-input proofread_required" value="0" id="proofread_required" name="proofread_required" <?php echo ($fetch->proofread_required == 0) ? "checked" : "" ?> /> No
                            </div>
                        </div>
                		<input type="hidden" name="job_stage" value="0">

<!--                        <div class="form-group" style="display:none;" id="proofreadSettings">-->
<!--                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Proofreading type</label>-->
<!--                            <div class="col-sm-9" style="padding-top:5px">-->
<!--                                <input type="radio" class="form-input input-radio" value="editing" id="proofreadType" name="proofreadType" /> Editing |-->
<!--                                <input type="radio" class="form-input radio-input" value="comparison" id="proofreadType" name="proofreadType" /> Comparison-->
<!--                            </div>-->
<!--                        </div>-->

                		<div class="clearfix form-actions">
                			<div class="col-md-offset-3 col-md-9">
                				<button class="btn btn-info" type="submit" id="toggle-submit-job">
                					<i class="ace-icon fa fa-check bigger-110"></i>
                					Post Job
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
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

        <div id="dialog-line-numbers" title="Validating Job Line Number" style="display:none">
            <p style="font-size: 14px;">This line number already has a job associated to it. Do you want to associate this?</p>
            <div class="job-info-wrapper" style="padding: 10px; font-size: 15px;"> </div>
        </div>

        <div id="dialog-language" title="Change language" style="display:none">
            <p style="font-size: 14px;">Are you sure you want to change the language selection of this job? This may affect who is able to bid on this job.</p>
        </div>

        <div id="dialog-common" title="Data has been changed" style="display:none">
            <p style="font-size: 14px;">Are you sure you want to make this change?</p>
        </div>

<!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>


<script>
    initSample();
</script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jqueryn.js"></script>
<script type="text/javascript">
function removealert(id,file)
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
	else
	{
		var $fileUpload = $("#numoffile").val();
        if ($fileUpload>1){
         window.location.href="<?php echo base_url(); ?>admin_jobpost/removefile/"+id+"/"+file;
        }else{
		alert("Atleast 1 file is mandatory");
		}
	}
}
</script>
<?php $this->load->view('admin/includes/vwFooter'); ?>

<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/uploadfilemulti.css" />
<!--<link rel="stylesheet" href="--><?php //echo HTTP_ASSETS_PATH_ADMIN; ?><!--css/jquery-ui-1.12.1.min.css" />-->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/select2.css" />

<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-1.8.2.min.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.custom.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/select2.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo  HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-confirm.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var last_selected_type = $("#type option:selected").val();
    var last_selected_proofread_required = $("input[name='proofread_required']:checked").val();

    var current_selected_line_month = $("#lineMonth option:selected").val();
    var current_selected_line_year = $("#lineYear option:selected").val();
    var current_line_number_value = $('#lineNumber').val();

    var formChanged = false;

    $("#language_from").change(function(){
        $("input[name='language_from_val']").val($("#language_from").val());
    });
    $("#language").change(function(){
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

    $(document).on('change', '#type', function(e) {
        $('#dialog-common').dialog({
            resizable: false,
            height: "auto",
            width: 500,
            modal: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                'Yes': function () {
                    $(this).dialog('close');
                    formChanged = true;
                },
                'No': function () {
                    $(this).dialog('close');
                    formChanged = false;

                    $('#type option[value='+ last_selected_type +']').attr('selected', 'selected');
                }
            }
        });
    });

    $(document).on('click', '#type', function () {
        last_selected_type = $("#type option:selected").val();
    });

    $(document).on('change', '.proofread_required', function() {
        var has_changed = false;
        var proofread_required_val = $(this).val();

        $('#dialog-common').dialog({
            resizable: false,
            height: "auto",
            width: 500,
            modal: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                'Yes': function () {
                    $(this).dialog('close');
                    has_changed = true;
                    formChanged = true;

                    if($('.proofread_required').val() == proofread_required_val) {
                        $("#proofreadSettings").show();
                    } else {
//                        $("#proofreadSettings").hide();
//                        $('#proofreadType').val('');
                    }
                },
                'No': function () {
                    $(this).dialog('close');
                    formChanged = false;

                    $("input[name=proofread_required][value='"+ last_selected_proofread_required +"']").prop("checked", true);
                }
            }
        });
    });

    $('#language_from').select2({
        placeholder: "Select language",
        allowClear: true
    });

    $('#language').select2({
        placeholder: "Select language",
        allowClear: true
    });

	$(".editLineNumber").click(function() {
		$(".lineNumberInput").show();
		$(".lineNumberCodeHide").hide();
	});

	$('body').on('focus', '#dueDate', function() {
		$(this).datetimepicker({
	        format: 'MM-DD-YYYY',
	        minDate: 'now'
	   	});
	});

    $(document).on('change', '#language_from', function (e) {
        $('#dialog-language').dialog({
            resizable: false,
            height: "auto",
            width: 500,
            modal: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                'Yes': function () {
                    $(this).dialog('close');
                    formChanged = true;
                },
                'No': function () {
                    $('#language_from').val("<?php echo $lang_from ?>").trigger("change");
                    formChanged = false;
                    $(this).dialog('close');
                }
            }
        });
    });

    $(document).on('change', '#language', function (e) {
        $('#dialog-language').dialog({
            resizable: false,
            height: "auto",
            width: 500,
            modal: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                'Yes': function () {
                    $(this).dialog('close');
                    formChanged = true;
                },
                'No': function () {
                    $('#language').val("<?php echo $lang_to ?>").trigger("change");
                    formChanged = false;
                    $(this).dialog('close');
                }
            }
        });
    });

    $(document).on('blur', '#lineNumber', function (e) {
        if (current_selected_line_month == $("#lineMonth option:selected").val() && current_selected_line_year == $('#lineYear option:selected').val() && current_line_number_value == $(this).val()) {
        } else {
            $.ajax({
                url: "<?php echo base_url() ?>admin_jobpost/check_line_numbers",
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
                                        url: "<?php echo base_url() ?>admin_jobpost/get_job_price",
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
                    } else {
                        formChanged = false;
                    }
                }

            });
        }
    });

    $(document).on('click', '#toggle-submit-job', function (e) {
        e.preventDefault();

        if ( $('lineNumberInput').is(':visible') ) {
            $.ajax({
                url: "<?php echo base_url() ?>admin_jobpost/check_line_numbers",
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
                                        url: "<?php echo base_url() ?>admin_jobpost/get_job_price",
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
                                        if($("input[name='clientName']").val() == ''){
                                            error += '<p>Enter Client Name.</p>';
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
                                        if($("input[name='language_val']").val() == ''){
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
                                            $("#admin-edit").trigger('submit');
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
                                        $('#lineNumber').focus();
                                    }
                                }
                            }
                        });

                        var content = "Job: <span style='font-weight: bold'>" + response.job_name + "</span>, <span style='font-weight: bold'>Language: " + response.language_from + "</span> to <span style='font-weight: bold'>" + response.language_to + "</span>, Date Posted: <span style='font-weight: bold'>" + response.date_added + "</span>";
                        $('.job-info-wrapper').html(content);
                    } else {
                        if (formChanged) {
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
                            if($("input[name='clientName']").val() == ''){
                                error += '<p>Enter Client Name.</p>';
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
                            if($("input[name='language_val']").val() == ''){
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
                                $("#admin-edit").trigger('submit');
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
                            $('#lineNumber').focus();
                        }
                    }

                }
            });
        } else {
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
            if($("input[name='clientName']").val() == ''){
                error += '<p>Enter Client Name.</p>';
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
            if($("input[name='language_val']").val() == ''){
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
                $("#admin-edit").trigger('submit');
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
//            if (formChanged) {
//            } else {
//                $('#form-nothing-changed').show();
//                $('#lineNumber').focus();
//                setInterval(function () { $('#form-nothing-changed').fadeOut(200) }, 3000);
//            }
        }
    });

    // $("#admin-edit").submit(function (e){
    //
    // });

var settings = {
	dataType: "html",
	url: "<?php echo base_url().'admin_jobpost/'.'upload';?>",
	method: "POST",
    allowedTypes:"jpg,jpeg,docx,xls,xlsx,ppt,pptx,png,gif,doc,pdf,zip,tar,txt,ai,mp3,wav,csv",
	fileName: "myfile",
	multiple: true,
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
