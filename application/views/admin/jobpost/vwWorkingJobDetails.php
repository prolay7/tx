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
								<a href="#">View</a>
							</li>
							<li class="active">View Working Job</li>
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
							$this->load->view('admin/includes/vwSidebar-settings');
						?>
						<!-- /.ace-settings-container -->
						
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
							Working Job Details				
							</h1>
						</div><!-- /.page-header -->
                    
                        
            <div class="row">
            
            
            <div class="col-xs-12">
            <div class="col-xs-6">
            
                                    
            <div class="form-group" style="padding-top:30px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Proposal: </label>
                <div class="col-sm-8">
                <?php echo $fetch->proposal; ?>
                </div>
            </div>
        
            </div>

								<!-- PAGE CONTENT ENDS -->
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
<script type="text/javascript">
      CKEDITOR.replace( 'editor1' );
      CKEDITOR.add            
   </script>

   <script type="text/javascript">
      CKEDITOR.replace( 'editor2' );
      CKEDITOR.add            
   </script> 
   <script type="text/javascript">
      CKEDITOR.replace( 'editor3' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor4' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor5' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor6' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor7' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor8' );
      CKEDITOR.add            
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
$this->load->view('admin/includes/vwFooter');
?>
