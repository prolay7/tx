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
								<a href="#">Dashboard</a>
							</li>

							<li>
								<a href="#">Enquiry</a>
							</li>
							<li class="active">Enquiry lists</li>
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
								Enquiry								
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                
                               
								<div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Enquiry"
                                    </div>
                                    
                                    <table width="100%">
                                        <tbody>
                                        	<tr>
                                                <td colspan="2" style="padding-top:10px;"><strong>Client Details</strong></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Name</td>
                                                <td><?php echo $results[0]['clfnm']?>&nbsp;<?php echo $results[0]['cllnm']?></td>
                                            </tr>
                                            <tr>
                                                <td>Company Name</td>
                                                <td><?php echo $results[0]['company']?></td>
                                            </tr>
                                            <tr>
                                                <td>Company Name</td>
                                                <td><?php echo $results[0]['company']?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Address</td>
                                                <td><?php echo $results[0]['address']?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td><?php echo $results[0]['telephone']?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $results[0]['email']?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="padding-top:10px;"><strong>Event Details</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td><?php echo $results[0]['date']?></td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td><?php echo $results[0]['type']?></td>
                                            </tr>
                                            <tr>
                                                <td>Area</td>
                                                <td><?php echo $results[0]['area']?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Address</td>
                                                <td><?php echo $results[0]['event_address']?></td>
                                            </tr>
                                            <tr>
                                                <td>Extra Information</td>
                                                <td><?php echo $results[0]['additional_info']?></td>
                                            </tr>
                                            <tr>
                                                <td>Estimated Budget</td>
                                                <td><?php echo $results[0]['budget']?></td>
                                            </tr>
                                            <tr>
                                                <td>Hear From</td>
                                                <td><?php echo $results[0]['hear_about']?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="2" style="padding-top:10px;"><strong>Artist Details</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td><?php echo $results[0]['afnm']?>&nbsp;<?php echo $results[0]['alnm']?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $results[0]['aeml']?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                   
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
$this->load->view('admin/includes/vwFooter');
?>
