<?php
//error_reporting(0);
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
							<li class="active">Mainbanner</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- #section:settings.box -->
						<?php
							$this->load->view('admin/includes/vwSidebar-settings');
						?>
                        <!-- /.ace-settings-container -->

						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
							Mainbanner
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Edit Mainbanner
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                         <?php if (validation_errors()!="") { ?>
                         <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo validation_errors(); ?> </p>
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

                     <?php if (isset($message_error) && $message_error!="") { ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo $message_error; ?> </p>
                        </div>
                    <?php } ?>
                    
                    
    <div class="col-xs-12">
    
    <?php
        //print_r($results);
        //die();
    ?>
        <?php 
		//echo "<pre>"; print_r($results);die;
		$attributes = array('class' => 'form-horizontal', 'id'=>'addtranslator'); 
		echo form_open_multipart('admin/editmainbannerprof/'.$this->uri->segment(3).'', $attributes); 
		?>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title* </label>

										<div class="col-sm-9">
					<input name="title" type="text" id="title" class="col-xs-10 col-sm-5 validate[required]" value="<?php echo $results[0]['title'];?>" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tag Line* </label>

										<div class="col-sm-9">
					<input name="tag_line" type="text" id="tag_line" class="col-xs-10 col-sm-5 validate[required]" value="<?php echo $results[0]['tag_line'];?>" />
										</div>
									</div>
                                  
                                    
              <?php if($results[0]['image']!="" && file_exists("./uploads/mainbanner/".$results[0]['image'])) { ?>
                <div class="form-group" style="overflow:hidden;">
                    <div class="col-md-offset-3 col-md-8" style="overflow:hidden;">
                        <img src="<?php echo base_url(); ?>uploads/mainbanner/<?php echo $results[0]['image']; ?>" class="img-responsive" style="max-height:300px; max-width:300px;"  />
                    </div>
                <input name="preimage" id="preimage"  type="hidden" class="form-control col-xs-10 col-sm-5" value="<?php echo $results[0]['image']; ?>" />    
                    </div>
                    
                <?php } ?>
                                    
                                    
                                    
            
                    <div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Image(gif,jpg,jpeg,png)(2000 X 855) </label>

										<div class="col-sm-9">
						<input name="file" type="file" id="mainbanner" class="col-xs-10 col-sm-5" value="" />
										</div>
									</div>         
         <div class="col-md-offset-3 col-md-8" style="padding-top:30px;">
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

            <?php echo form_close(); ?>
            
        

								<!-- PAGE CONTENT ENDS -->
							<!-- /.col -->
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
        
        <!-- inline scripts related to this page -->
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
