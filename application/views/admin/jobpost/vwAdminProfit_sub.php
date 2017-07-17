<?php
$this->load->view('admin/includes/vwHeader');
?>

         <style type="text/css">
			.access {
				color:red;
				font-size:16px;
				text-align:center;
			}
			
		</style>
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
								<a href="#">Job Profit</a>
							</li>
							<li class="active">Profit List</li>
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
								Job Profit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Profit List
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
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
								 <div class="alert alert-block alert-danger">	
								 <button type="button" class="close" data-dismiss="alert">
                                 <i class="ace-icon fa fa-times"></i>
                                 </button>	
									
                                <p><?php echo $this->session->flashdata('error_message'); ?></p>
                                 </div>
								
                               <?php 
							   } 
							  ?>
                                
								<div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Job Profit List"
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 <th class="center">Translator</th>
                                                 <!--<th class="center">Proposal</th>
                                                 <th class="center">Time Need</th>-->
                                                 <th class="center">Job Price</th>
                                                  <th class="center">Awarded Price</th>
                                                  <th class="center">Profit Margin</th>
                                                 <!--<th class="center">View File</th>-->
                                                 <!--<th class="center">Awarded Date</th>-->
                                                <!-- <th class="center">Canceled</th>-->
                                              <!--  <th class="center">Completed</th>-->
                                                 <!--<th>Details</th>-->
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <tr>
                                        <td colspan="5" class="access">
                                        You Have No Permission to Access this Page!
                                        </td>
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



<?php
$this->load->view('admin/includes/vwFooter');
?>
