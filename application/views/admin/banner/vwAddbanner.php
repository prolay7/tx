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
							<li class="active">Banner</li>
						</ul><!-- /.breadcrumb -->

					
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
								Banner
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Banner
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                        <div class="col-xs-12">
                         <?php if (validation_errors()!="") { ?>
                         <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo validation_errors(); ?> </p>
                        </div>
                    <?php } ?>
                     <?php if ($message_success!="") { ?>
                         <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo $message_success; ?> </p>
                        </div>
                    <?php } ?>
                     <?php if ($message_error!="") { ?>
			 <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo $message_error; ?> </p>
            </div>
		<?php } ?>
							
                            
        <?php 
		$attributes = array('class' => 'form-horizontal', 'id'=>'admin-Register','enctype' => 'multipart/form-data'); 
		echo form_open('admin/addbanner', $attributes); 
		?>   
             
          <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title </label>
                <div class="col-sm-9">
                    <input name="title" id="title" class="col-xs-10 col-sm-5 validate[required]"  type="text" >
                </div>
            </div>
            <div class="form-group">
  <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Profile Image(jpeg,jpg,png,gif)(1349 X 500):*</label>
                <div class="col-sm-9">
                    <input name="images" id="banner" class="col-xs-10 col-sm-5 validate[required]"  type="file">
                </div>
            </div>
          
           
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" > Select Status: </label>
                <div class="col-sm-9">
                   
						<select name="status" class="col-xs-10 col-sm-5 ">
                            <option value="">Select Status type</option>
							<option value="1"  >Active</option>
							<option value="0"  >Inactive</option>
						</select>
                </div>
            </div>
         
            
            
                  <div class="clearfix"></div>        
            
                                            
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

            <?php echo form_close(); ?>
            
        

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
	
   
    	
<?php
$this->load->view('admin/includes/vwFooter');
?>