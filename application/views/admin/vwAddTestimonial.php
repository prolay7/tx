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
								<a href="#">Testimonial</a>
							</li>
							<li class="active">Add Testimonial</li>
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
								Testimonial
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Testimonial
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
							  $attributes = array('class' => 'form-horizontal', 'id' => 'addtranslator');
							  //form validation
							  echo form_open_multipart('admin/testimonial/add', $attributes);
							  ?>
                            
                                
                                	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name* </label>

										<div class="col-sm-9">
					<input name="name" type="text" id="name" class="col-xs-10 col-sm-5 validate[required] text-input" value="" />
										</div>
									</div>
                                    
                                    <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Designation* </label>

										<div class="col-sm-9">
			<input name="designation" type="text" id="designation" class="col-xs-10 col-sm-5 validate[required]" value="" />
										</div>
									</div>
                                    
                                    <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description* </label>

										<div class="col-sm-9">
							
                            <textarea name="desc" id="desc" class="col-xs-10 col-sm-5 validate[required]"></textarea>
 										</div>
									</div>
                                    
                                    <div class="form-group">
  <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Image(png,jpeg,jpg,gif)(300 X 300)* </label>

										<div class="col-sm-9">
						<input name="file" type="file" id="testimonial" class="col-xs-10 col-sm-5 validate[required]" value="" />
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" > Select Status: </label>
                <div class="col-sm-9">
                   
						<select name="status" class="col-xs-10 col-sm-5 ">                          
							<option value="1"  >Active</option>
							<option value="0"  >Inactive</option>
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

<script type="text/javascript">
  CKEDITOR.replace( 'desc' );
  CKEDITOR.add            
</script>
  
<?php
$this->load->view('admin/includes/vwFooter');
?>