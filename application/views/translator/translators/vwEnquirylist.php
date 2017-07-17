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
                        <?php if($this->session->flashdata('flsh_success')){  ?>
                       <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p><?php  echo $this->session->flashdata('flsh_success'); ?></p>
                                    </div>
                         <?php } ?>
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                
                               
								<div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Enquiry"
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">Description</th>                                               
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        
                                                    
                                            <?php
                                            foreach($results as $key => $val){
                                            ?>
                                          <tr>
                                            <td><?php echo $val['content']; ?></td>                                            
                                            <td><a href="<?php echo base_url(); ?>artist/sendenquery/<?php echo $val['id']; ?>"><button class="btn btn-xs btn-info"><i class="ace-icon fa fa-paper-plane bigger-120" title="Reply to Admin"></i></button></a></td>
                                          </tr> 
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    
                                    <?php //echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
                                    
                                </div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

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
