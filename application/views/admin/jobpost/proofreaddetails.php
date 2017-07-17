<?php
$this->load->view('admin/includes/vwHeader');
?>
<!-- <script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/switch/dist/js/bootstrap-switch.js"></script> -->
<!-- <link href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/switch/dist/css/bootstrap-switch.css" rel="stylesheet" type="text/css" /> -->
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
                echo form_open('admin_review/showReviewDetails/'.$fetch->id, $attributes);
                ?>
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

                	<div class="form-group lineNumberCodeHide">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Line Number</label>
                        <div class="col-sm-9">
                        	<?php echo $fetch->lineNumberCode; ?> <span class="action-buttons editLineNumber" style="cursor:pointer;"><a class="editLineNumber"><i class="green ace-icon fa fa-pencil"></i></a></span>
                        </div>
                    </div>
                    <div class="form-group lineNumberInput" style="display:none;">
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
                            <a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $view[$i]; ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a>
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
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From*</label>
                        <div class="col-sm-9">
                            <select name="language_from" class="col-xs-10 col-sm-5 validate[required]" >
                            	<option value=""> Select Language </option>
								<?php foreach($Language_fetch as $row) {?>
                                <option value="<?php echo $row->id;?>" <?php if($lang_from==$row->id){echo "selected";} ?> ><?php echo $row->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To*</label>
                             <div class="col-sm-9">

                                <select name="language" class="col-xs-10 col-sm-5 validate[required]" >
                                    <option value=""> Select Language </option>


                                    <?php foreach($Language_fetch as $row) {?>
                                    <option value="<?php echo $row->id;?>" <?php if($lang_to==$row->id){echo "selected";} ?> ><?php echo $row->name;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <?php
                        $due_date = explode(' ', $fetch->dueDate);
                        if (isset($due_date[1])) {
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
                        } else {
                            $hr = date('h');
                            $min = date('i');
                            $ampm = date('A');
                        }

                         ?>

                    <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Due Date*</label>
						<div class="col-sm-9">
                        	<input type="text" name="dueDate" id="dueDate" class="datepicker col-xs-5 col-sm-2 validate[required]" value="<?php echo $due_date[0] ?>" />
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
                	                <option value="1">Private</option>
                	                <option value="0">Public</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="proofreadQuestion">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Proofreading required? </label>
                            <div class="col-sm-9"> Yes </div>
                        </div>
                		<input type="hidden" name="job_stage" value="0">

                        <div class="form-group" id="proofreadSettings">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Proofreading type</label>
                            <div class="col-sm-9">
                                Editing <input type="radio" class="form-input input-radio" value="editing" id="proofreadType" name="proofreadType" <?php if($fetch->proofreadType == 'editing') echo "checked"; ?>/> |
                                Comparison <input type="radio" class="form-input radio-input" value="comparison" id="proofreadType" name="proofreadType" <?php if($fetch->proofreadType == 'comparison') echo "checked"; ?>/>
                            </div>
                        </div>

                		<div class="clearfix form-actions">
                			<div class="col-md-offset-3 col-md-9">
                				<button class="btn btn-info" type="submit">
                					<i class="ace-icon fa fa-check bigger-110"></i>
                					Post Proofread Job
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

<!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>


<script>
    initSample();
</script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jqueryn.js"></script>
<!-- <script>
				$(document).ready(function() {alert("hello");
                    $("#userfile").change(function (){
					var filename = $('#userfile').val();

					var filename1 = filename.split('.');

					var filename2 = filename1.pop();

					var ext = filename2.toLowerCase();

					//var ext = $('#formID').val().split('.').pop().toLowerCase();
					if($.inArray(ext, ['pdf','doc','xls','xlsx','docx','txt','jpg','jpeg','png','zip','gif']) == -1) {
						alert('Invalid file format!. Please select pdf,doc,docx,xls,jpg,jpeg,png,zip or txt.');
						$('#userfile').val('');
					}
					});

					});


       </script>-->

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
<?php
$this->load->view('admin/includes/vwFooter');
?>
      <!-- <script>
$(function(){alert("hello");
    $("#remove").click(function(){//alert("hello");

	   var $fileUpload = $("#numoffile").val();
        if (parseInt($fileUpload.get(0).files.length)<1){
         alert("Atleat 1 file is mandatory.");
		// $("#file").val('');
        }
    });
});
</script>   -->
       <link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/uploadfilemulti.css" />
<!--<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-1.8.0.min.js"></script>-->
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>
$(document).ready(function()
{
    $(document).on('change', '#type', function() {
        if($(this).val() == 1) {
            $("proofreadQuestion").show();
        } else {
            $("proofreadQuestion").hide();
        }
    });
    $(document).on('click', '.proofread_required', function() {
        if($(this).val() == 1) {
            $("#proofreadSettings").show();
        } else {
            $("#proofreadSettings").hide();
        }
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
