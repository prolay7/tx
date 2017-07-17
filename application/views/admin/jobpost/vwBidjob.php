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
								<a href="#">Bid Job</a>
							</li>
							<li class="active">Bid Job List</li>
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
								Bid Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Bid Job List
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
                                        Results for "Bid Job List"
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 <th class="center">Translator Name</th>
                                                
                                                 <th class="center">Time Need</th>
                                                 <th class="center">Price</th>
                                               
                                                 <th class="center">Awarded</th>
                                                 <th class="center">Message</th>
                                                 <th class="center">Invoice</th>
                                                <!-- <th class="center">Canceled</th>-->
                                                 <th>Bid Details</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <style type="text/css">
											.order_by_cls {
												display:none;	
											}
										</style>
                                    <?php
									$job_id= $this->uri->segment(2);
									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
									//save the columns names in a array that we will use as filter         
									$options_category = array();
									//echo '<pre>'; print_r($category);
									foreach ($bidjob as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}
							
								    echo form_open('bidjob/'.$job_id, $attributes);									
									echo form_label('Search:', 'search_string').'&nbsp;';
									echo form_input('search_string', $search_string_selected, 'style="width: 170px;
									height: 26px;"');
									
									
								//echo form_label('Order by:', 'order');
								echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');
									
							   $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Go');
									
								$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
					echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');               
								
								echo '&nbsp;&nbsp;'.form_submit($data_submit).'&nbsp;&nbsp;';					
								echo form_close();
                                      
                                   ?>                                   
       <a href="<?php base_url().'admin/bidjob/'.$job_id?>" class="btn btn-info btn-reser btn-sm" >Reset</a>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                 <?php                
                                      
            
                                            
											if ($count_bidjob!='0')
											{
											
                                            foreach($bidjob as $key => $val){ 
											//echo '<pre>'; print_r($val);die;
											
											$translator_id=$val['trans_id'];
											$sql="select * from `translator` where `id`='$translator_id'";
											$query=mysql_query($sql);
											$fetch=mysql_fetch_array($query);
											$trans_name=$fetch['first_name'].'&nbsp;'.$fetch['last_name'];
											$job_id=$val['job_id'];
											$sql1="select * from `jobpost` where `id`='$job_id'";
											$query1=mysql_query($sql1);
											$fetch1=mysql_fetch_array($query1);
											$job_title=$fetch1['name'];
                                            ?>
                                            <tr>
                                           <td><a href="<?php echo base_url(); ?>admin_jobpost/edit/<?php echo $job_id; ?>" target="_blank"></a><?php echo $job_title; ?></td> 
                                           <td><a class="various " data-fancybox-type="iframe" href="<?php echo base_url(); ?>admin_jobpost/viewbiddetails/<?php echo $val['id']; ?>"><?php echo $trans_name; ?> </a></td>
                                          <!-- <td><a href="<?php echo base_url().'admin/translators/edit/'.$val['trans_id']; ?>" target="_blank"></a><?php echo $trans_name; ?></td>-->
                                           <?php $time=$val['time_need'];
										   $time= $time/1440;
										   ?> 
                                            <td><?php echo  $time; ?>&nbsp;Day(s)</td>
                                            <td>$<?php echo $val['price']; ?></td>
                                          
                                           
                       
                            
 <td><a href="#"><?php if($val['awarded']=='0') { ?><button onclick="confir(<?php echo $val['id']; ?>,<?php echo $val['job_id'];?>)" type="button" class="btn btn-danger " aria-haspopup="true" aria-expanded="false">No</button><?php } ?></a> 
 
 <a href="#"><?php if($val['awarded']=='1') { ?><button  onclick="dconfir(<?php echo $val['id']; ?>,<?php echo $val['job_id'];?>)"type="button" class="btn btn-success " aria-haspopup="true" aria-expanded="false">Yes</button><?php } ?></a>
 

 </td>                                        
                                            
                                            
                           
                            
<!--<td><a href="#"><?php if($val['canceled']=='0') { ?><button onclick="canconfir(<?php echo $val['id']; ?>,<?php echo $val['job_id'];?>)" type="button" class="btn btn-danger " aria-haspopup="true" aria-expanded="false">No</button><?php } ?></a>

<a href="#"><?php if($val['canceled']=='1') { ?><button onclick="dcanconfir(<?php echo $val['id']; ?>,<?php echo $val['job_id'];?>)" type="button" class="btn btn-success " aria-haspopup="true" aria-expanded="false">Yes</button><?php } ?></a>


 </td>   -->                      
                            <td>
                            <?php 
							$bid_id=$val['id'];
							$invoicesql="select `bid_id` from `message` where `bid_id`='$bid_id' ";	
							$invoicequery=$this->db->query($invoicesql);
							$invoice_num=$invoicequery->num_rows();
							
								
							?>
 <!--  <a class="btn btn-info" href="<?php echo base_url(); ?>admin_jobpost/message/<?php echo $bid_id; ?>/<?php echo $val['job_id']; ?>/<?php echo $val['trans_id']; ?>">
                            &nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;Send Message &nbsp;&nbsp;&nbsp;&nbsp;
                            </a>                           
                           -->
                              <a class="btn btn-info" href="<?php echo base_url(); ?>chat-box/?bid_id=<?php echo $bid_id; ?>&job_id=<?php echo $val['job_id']; ?>&trans_id=<?php echo $val['trans_id']; ?>&type=<?php echo "admin"; ?>" target="_blank">
                            &nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;Chat &nbsp;&nbsp;&nbsp;&nbsp;
                            </a>  
                            
                            
                            </td>
                               <td>
                            <?php if($val['awarded']=='1')
							{
							$bid_id=$val['id'];
							$invoicesql="select `bid_id` from `invoice` where `bid_id`='$bid_id' ";	
							$invoicequery=$this->db->query($invoicesql);
							$invoice_num=$invoicequery->num_rows();
							if($invoice_num=='0'){
								
							?>
   <a class="btn btn-info" href="<?php echo base_url(); ?>admin_jobpost/invoice/<?php echo $val['id']; ?>/<?php echo $val['job_id']; ?>/<?php echo $val['trans_id']; ?>">
                            &nbsp;&nbsp;<i class="fa fa-paper-plane"></i>&nbsp;Send &nbsp;&nbsp;&nbsp;&nbsp;
                            </a>                           
                            
                            <?php	
							}
							else
							{?>
								
                           <a class="btn btn-info" href="<?php echo base_url(); ?>admin_jobpost/reinvoice/<?php echo $val['id']; ?>/<?php echo $val['job_id']; ?>/<?php echo $val['trans_id']; ?>">
                            &nbsp;<i class="fa fa-paper-plane"></i>&nbsp; Resend &nbsp;
                            </a>     
                           <?php 
							}
							}
							else
							{?>
							<a style="cursor:default;"class="btn btn-danger" href="javascript:void(0)">
                            Not Awarded
                            </a>   	
								
								
							<?php }							
							?>
                            
                            
                            
                            </td>
                            
                            
                                <td>
                                <div class="hidden-sm hidden-xs action-buttons">
          <a class="green" href="<?php echo base_url(); ?>admin_jobpost/bidjobedit/<?php echo $val['id']; ?>">
                                <i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                <a class="red" href="#"  onclick="delalert(<?php echo $val['job_id']; ?>,<?php echo $val['id']; ?>)">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>  
                                </a> 
                                  <a class="various btn btn-success" data-fancybox-type="iframe" href="<?php echo base_url(); ?>admin_jobpost/viewbiddetails/<?php echo $val['id']; ?>"> <i class="fa fa-eye"></i>View Bid </a>
                               
                                </div>
                                </td>
                                          </tr> 
                                            <?php
											}
											} 
											else											
											{ ?>
                                            <tr><td colspan="7" align="center">No Bids Found!</td></tr>
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
function delalert(job_id,id)
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin_jobpost/bidjobdelete/"+job_id+"/"+id;
	}
}
</script>
<script type="text/javascript">
function confir(id,job_id)
{
    con=confirm("Are you sure to award this project?");
    if(con!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin/awardupdate/"+id+"/"+job_id;
	}
	
}
</script>

<script type="text/javascript">
function canconfir(id,job_id)
{
    con=confirm("Are you sure to cancel this awarded project?");
    if(con!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin/cancelupdate/"+id+"/"+job_id;
	}
	
}
</script>
<script type="text/javascript">
function dconfir(id,job_id)
{
    con=confirm("Are you sure to cancel this awarded project?");
    if(con!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin/awardcupdate/"+id+"/"+job_id;
	}
	
}
</script>

<script type="text/javascript">
function dcanconfir(id,job_id)
{
    con=confirm("Are you sure to revert this project Cancelation?");
    if(con!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin/cancelcupdate/"+id+"/"+job_id;
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

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.pack.js"></script> 
<script type="text/javascript">
	$(document).ready(function() {//alert("hello");
		//$(".fancybox").fancybox();
		$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	});
	
</script>


