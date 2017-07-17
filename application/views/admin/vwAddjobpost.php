<?php
$this->load->view('admin/includes/vwHeader');
?>

<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<?php
				$this->load->view('admin/includes/vwSidebar-left');
			?>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
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
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!--<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div>--><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- #section:settings.box -->
						<!-- /.ace-settings-container -->
						<?php
							$this->load->view('admin/includes/vwSidebar-settings');
						?>
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Job
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
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
                            
                                
                                	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name* </label>

										<div class="col-sm-9">
											<input name="name" type="text" id="name" class="col-xs-10 col-sm-5 validate[required]" value="" />
										</div>
									</div>
                                    <input name="alias" type="hidden" id="alias" class="col-xs-10 col-sm-5" value="" />
                                    <!--<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alias(User friendly url) </label>

										<div class="col-sm-9">
											<input name="alias" type="hidden" id="alias" class="col-xs-10 col-sm-5" value="" />
										</div>
									</div>-->
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price($)* </label>

										<div class="col-sm-9">
	  	<input name="price" type="text" id="price" class="col-xs-10 col-sm-5 validate[required,custom[integer]" value="" />
										</div>
									</div>
                                    
                                    
                                <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select file(pdf,doc,docx,xls,txt,jpg,jpeg,png,gif,zip)*: </label>                                  <div class="col-sm-9">
                            <input type="file" name="file[]" id="file" size="20" class="col-xs-10 col-sm-5 validate[required]" multiple>
								</div>
							    </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description*</label>

										<div class="col-sm-9">
                                        	<textarea  name="desc" id="editor" class="validate[required]">
											 
                                            </textarea>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From* </label>
										<?php 
										 $sql=" SELECT * FROM `languages` ";
							  			$val=$this->db->query($sql);
							 			 $lang=$val->result();
										?>
										<div class="col-sm-9">
                                <select name="language_from" id="language_from" class="col-xs-10 col-sm-5 validate[required]" >
                                <option value=""> Select Language </option>
                                                <?php foreach ($lang as $lang1) {
											    ?>
   								<option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
							     
                                  <?php } ?>
                                 </select>
                                        </div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To* </label>
										<?php 
										 $sql=" SELECT * FROM `languages` ";
							  			$val=$this->db->query($sql);
							 			 $lang=$val->result();
										?>
										<div class="col-sm-9">
                                <select name="language" id="language" class="col-xs-10 col-sm-5 validate[required]" >
                                <option value=""> Select Language </option>
                                                <?php foreach ($lang as $lang1) {
											    ?>
   								<option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
							     
                                  <?php } ?>
                                 </select>
                                        </div>
									</div>
                                    <!--<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stage* </label>

										<div class="col-sm-9">
                                    <select name="stage" id="status" class="col-xs-10 col-sm-5 validate[required]">
                                  
                                    <option value="0">Open</option>
                                    <option value="1">Close</option>
                                    </select>
                                        </div>
									</div>-->
                                    <input type="hidden" name="stage" value="0">
                                    <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status* </label>

										<div class="col-sm-9">
                                    <select name="status" id="status" class="col-xs-10 col-sm-5 validate[required]">
                                  
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    </select>
                                        </div>
									</div>
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
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

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
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
 <script>
				$(document).ready(function() {
                    $("#file").change(function (){ 
					var filename = $('#file').val();
										
					var filename1 = filename.split('.');
					
					var filename2 = filename1.pop();
					
					var ext = filename2.toLowerCase();
					
					//var ext = $('#formID').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['pdf','doc','xls','docx','txt','jpg','jpeg','png','gif','zip']) == -1) {
	alert('Invalid file format!. Please select pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip or txt.');
						$('#file').val('');
					}
					});
				
					});
				
                
       </script>

<?php
$this->load->view('admin/includes/vwFooter');
?>
      