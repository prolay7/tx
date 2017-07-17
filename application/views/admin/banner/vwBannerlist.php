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
								<a href="#">Banner</a>
							</li>
							<li class="active">Banner List</li>
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
								Banner
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Banner
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php
                                //flash messages
                                if($this->session->flashdata('flash_message')){
									if($this->session->flashdata('flash_message') == 'deleted')
									{ ?>
                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button> 
                                        <p> Banner deleted successfully. </p>
                                    </div>
                                    <?php } ?>
      							<?php } ?>
                                
								<div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Banner List"
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">Title</th>
                                               
                                                <th class="center">Image</th>
                                                 <th class="center">Status</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        
                                        <?php
										$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
										//save the columns names in a array that we will use as filter         
										$options_wedding = array();
										//echo '<pre>'; print_r($category);
  										foreach ($wedding as $array) {
										  foreach ($array as $key => $value) {
											$options_wedding[$key] = $key;
										  }
										  break;
										}
							
										/*echo form_open('admin/category', $attributes);
										
										echo form_label('Search:', 'search_string');
										echo form_input('search_string', $search_string_selected, 'style="width: 170px;
										height: 26px;"');
										
										
										echo form_label('Order by:', 'order');
										echo form_dropdown('order', $options_category, $order, 'class="span2"');
										
										$data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
										
										$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
										echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');
										
										echo form_submit($data_submit);
										
										echo form_close();*/
										?>
            
                                            <?php
                                            foreach($wedding as $key => $val){
                                            ?>
                                          <tr>
                                            <td><?php echo $val['title']; ?></td>
                                            
                                              <td >
                                              <?php if( $val['images']!="" && file_exists("./uploads/banner/". $val['images'])) { ?>
                                              <img src="<?php echo base_url(); ?>uploads/banner/<?php echo $val['images']; ?>" class="img-responsive" style="max-height:50px; max-width:50px;" />
                                              <?php } else{echo "no image exist";}?>
                                              </td>
                                             <td><?php if($val['status']=='0') { echo 'Inactive'; } ?> <?php if($val['status']=='1') { echo 'Active'; } ?></td>
                                            <td>
                                            
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                        <!--<a class="blue" href="#">
                                                            <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                        </a>-->

                                                        <a class="green" href="<?php echo base_url(); ?>admin/editbanner/<?php echo $val['id']; ?>">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a>
<a class="red" href="<?php echo base_url(); ?>admin/deletebanner/<?php echo $val['id']; ?>" onClick="return doconfirm();">
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
