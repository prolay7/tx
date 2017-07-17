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
							<li class="active">Testimonial List</li>
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
								Testimonial
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Testimonial
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                        
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
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->                             
                            	<div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Testimonial List"
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">Name</th>
                                               
                                                <th class="center">Designation</th>
                                                 <th class="center">Description</th>
                                                 <th class="center">Image</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        
                                        <?php
										$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
										//save the columns names in a array that we will use as filter         
										$options_wedding = array();
										//echo '<pre>'; print_r($category);
  										foreach ($testimonial as $array) {
										  foreach ($array as $key => $value) {
											$options_wedding[$key] = $key;
										  }
										  break;
										}
							
									
										?>
            
                                            <?php											
                                            foreach($testimonial as $key => $val){
                                            ?>
                                          <tr>
                                            <td><?php echo $val['name']; ?></td>
                                            <td><?php echo $val['designation']; ?></td>
                                            <td><?php echo $val['desc']; ?></td>
                                              <td >
                                              <?php if( $val['image']!="" && file_exists("./uploads/testimonial/". $val['image'])) { ?>
                                              <img src="<?php echo base_url(); ?>uploads/testimonial/<?php echo $val['image']; ?>" class="img-responsive" style="max-height:50px; max-width:50px;" />
                                              <?php } else{echo "no image exist";}?>
                                              </td>                                            
                                            <td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                        
                                <a class="green" href="<?php echo base_url(); ?>admin/edittestimonial/<?php echo $val['id']; ?>">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a>
<a class="red" href="<?php echo base_url(); ?>admin/deletetestimonial/<?php echo $val['id']; ?>" onClick="return doconfirm();">
                                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                        </a>
                                                        
                                                </div>
                                                
                                            </td>
                                          </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    
                                    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
                                    
                                </div>
                               <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
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
<script>
function goBack() {
    window.history.back();
}
</script>

<?php
$this->load->view('admin/includes/vwFooter');
?>
