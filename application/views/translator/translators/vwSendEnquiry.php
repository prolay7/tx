<?php
$this->load->view('artist/includes/vwHeader');
?>


		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<?php
				$this->load->view('artist/includes/vwSidebar-left');
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
								<a href="#">Dashboard</a>
							</li>

							<li>
								<a href="#">Enquiry</a>
							</li>
							<li class="active">Send Enquiry to Admin</li>
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
                        <?php
							$this->load->view('artist/includes/vwSidebar-settings');
						?>
						<!-- /.ace-settings-container -->
						
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Enquiry	Send							
							</h1>
						</div><!-- /.page-header -->
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
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->                       
                                <div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                     <?php 
										$attributes = array('class' => 'form-registration', 'id'=>'user-registration', 'enctype' => 'multipart/form-data'); 
										echo form_open('artist/sendenquery', $attributes); 
									  ?>
                                       <div class="col-xs-12" style="margin-top:30px;">
                                            <div class="form-group">
                                            <div class="col-sm-12">
                                            <input name="id" id="id" type="hidden" value="<?php echo $results[0]['id']?>" />                                      
                                                <textarea  name="content" id="editor"></textarea>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-offset-4 col-md-8" style="padding-top:30px;">
                                            <button class="btn btn-info" type="submit">
                                            	<i class="ace-icon fa fa-check bigger-110"></i> Send
                                            </button>
                                        </div>                                    
                                    
                                    <?php echo form_close(); ?>
                                </div>

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
<script type="text/javascript">
function doconfirm()
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
}
</script>


<?php
$this->load->view('artist/includes/vwFooter');
?>
