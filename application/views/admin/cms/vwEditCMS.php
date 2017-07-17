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
								<a href="#">Pages</a>
							</li>
							<li class="active">Simple &amp; Dynamic</li>
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
								Pages
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Edit Pages
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
								<?php
                                //flash messages
                                if($this->session->flashdata('flash_message')){
									if($this->session->flashdata('flash_message') == 'updated')
									{ ?>
                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button> 
                                        <p> Page Content updated successfully. </p>
                                    </div>
                                    <?php } else { ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo validation_errors(); ?> </p>
									</div>
									<?php } ?>
      							<?php } ?>
                                
                                <?php
							  //form data
							  //echo "<pre>"; print_r($cms);die;
							  
							  
							  $attributes = array('class' => 'form-horizontal', 'id' => '');
							  //form validation
							  echo form_open('admin/cms/update/'.$this->uri->segment(4).'', $attributes);
							  ?>
                                <!--<form method="post" action="<?php echo base_url(); ?>admin/cms/update" class="form-horizontal">-->
                                <input type="hidden" value="<?php echo isset($cms[0]['id']) && !empty($cms[0]['id']) ? $cms[0]['id'] : '';?>" name="pst_id"> 
                                	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Page Name </label>

										<div class="col-sm-9">
											<input name="label" type="text" id="label" class="col-xs-10 col-sm-5" value="<?php  
                                                echo isset($cms[0]['label']) && !empty($cms[0]['label']) ? $cms[0]['label'] : '';     
                                                ?>" readonly="readonly" />
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Page Title </label>

										<div class="col-sm-9">
											<input name="title" type="text" id="title" class="col-xs-10 col-sm-5" value="<?php  
                                                echo isset($cms[0]['title']) && !empty($cms[0]['title']) ? $cms[0]['title'] : '';     
                                                ?>" />
										</div>
									</div>
                                    
                                    
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Page Content </label>

										<div class="col-sm-9">
                                        	<textarea  name="content" id="editor">
											 <?php  
                                                echo isset($cms[0]['content']) && !empty($cms[0]['content']) ? $cms[0]['content'] : '';     
                                            ?>
                                            </textarea>
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

<?php
$this->load->view('admin/includes/vwFooter');
?>