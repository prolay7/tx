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
								<a href="#">Job</a>
							</li>
							<li class="active">Job Messages</li>
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
								Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Job Messages
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
                                        Results for "Job Messages"
                                    </div>
                                     <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                   
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 
                                                 <th class="center">Message</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <style type="text/css">
											.order_by_cls {
												display:none;	
											}
											.nonvisible
											{
											display:none;	
											}
										</style>
                                    <?php
									//$job_id= $this->uri->segment(3);
									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
									//save the columns names in a array that we will use as filter         
									$options_category = array();
									//echo '<pre>'; print_r($category);
									foreach ($messages as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}
							
								    echo form_open('admin/messages/', $attributes);																
									//echo form_label('Search:', 'search_string');
									echo form_input('search_string', $search_string_selected, 'style="width: 170px;
									height: 26px; display:none;"');								
								    //echo form_label('Order by:', 'order');
								echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');									
			          $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm nonvisible', 'value' => 'Go');
								$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
		               echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');                             	echo form_submit($data_submit);							
                                echo form_close();
                                      
                                      
                                      
            
                                            //echo "<pre>"; print_r($jobprofit);die;
											if ($count_messages!='0')
											{
											//echo "<pre>"; print_r($messages);die;
                                            foreach($messages as $key => $val){ 
											//echo '<pre>'; print_r($val);die;										
											
											$job_id=$val['job_id'];
											$jobsql="select * from `jobpost` where `id`='$job_id'";
											$jobquery=mysql_query($jobsql);
											$jobfetch=mysql_fetch_array($jobquery);
											$job_title=$jobfetch['name'];
										    ?>
                                            <tr>
                                            <td>
                                            <?php
									$sql="SELECT * FROM `message` WHERE `job_id` = '$job_id' and `type`= '1' and `read`='0'";
									$query=$this->db->query($sql);
									$num=$query->num_rows();									
                                            if($num>0){
											?>
                                            <b><a href="<?php echo base_url(); ?>admin_jobpost/edit/<?php echo $val['job_id']; ?>" target="_blank" ><?php echo $job_title.'('.$num.')'; ?></a></b>
                                            <?php
                                            }else
                                            {
											?>                                            
                                             <a href="<?php echo base_url(); ?>admin_jobpost/edit/<?php echo $val['job_id']; ?>" target="_blank" ><?php echo $job_title; ?></a>
                                           <?php 
										    }
											?>
                                            </td> 
                                           <td>
                                           <a href="<?php echo base_url(); ?>adminjobmessages/<?php echo $val['job_id']; ?>" class="btn btn-success" >&nbsp;&nbsp;&nbsp; View&nbsp;&nbsp;&nbsp;</a>
                                           </td>                                            
                                           </tr>
                                            <?php
											
											
											}
											} 
											else											
											{ ?>
                                            <tr><td colspan="5" align="center">No Messages Found!</td></tr>
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
function confir(id,job_id)
{
    con=confirm("Are you sure to mark as Completed this awarded project?");
    if(con!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin/awardcomplete/"+id+"/"+job_id;
	}
	
}
</script>
<script type="text/javascript">
function dconfir(id,job_id)
{
    con=confirm("Are you sure to cancel this Completion of awarded project?");
    if(con!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin/awarduncomplete/"+id+"/"+job_id;
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
