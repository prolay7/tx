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
								<a href="#">Invoice</a>
							</li>
							<li class="active">Invoice List</li>
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
								Invoice
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Invoice List
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                <?php 
                                           $partial = 0;

                                           ?>

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
                                        Results for "Invoice List"
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 <th class="center">Translator</th>
                                                 <!--<th class="center">Proposal</th>-->
                                                 <th class="center">Time</th>
                                                 <th class="center">Price</th>
                                                 <!--<th class="center">View File</th>-->
                                                 <th class="center">Awarded Date</th>
                                                <th class="center">Completed Date</th>
                                                
                                                <th class="center">Invoice No</th>
                                                <th class="center">Due Date</th>
                                                <th class = "center">Date Paid</th>
                                                <th class="center">Payment</th>
                                                
                                                 
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <style type="text/css">
											.order_by_cls {
												display:none;	
											}
										</style>
                                    <?php
									//$job_id= $this->uri->segment(3);
									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
									//save the columns names in a array that we will use as filter         
									$options_category = array();
									//echo '<pre>'; print_r($category);
									foreach ($invoice as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}
							
									
									?>


<div id = "filters" style = "margin: 10px 0;">
	
	<?php echo form_open('admin/invoice/', $attributes); ?>
		
		<input type="text" id = "invoiceDateFrom" name = "invoiceDateFrom" placeholder = "From Date">
		<input type="text" id = "invoiceDateTo" name = "invoiceDateTo" placeholder = "To Date">
        
	    <select name="payment_status" class="validate[required]" style = "height: 33px;">
	        <option value=""> Select Payment Status </option>                                                 
	        <option value="1" <?php if($payment_status_selected=='1'){echo 'selected';} ?> >Paid</option>
	        <option value="0" <?php if($payment_status_selected=='0'){echo 'selected';} ?> >Unpaid</option>
	    </select>
		
		<input name = "search_string" id = "search_string" placeholder = "Search Key" type = "text">

		<?php /*
		<input type = "hidden" id = "order" name = "order" value = "id">
		<input type = "hidden" id = "order_type" name = "order_type" value = "Asc">
		*/ ?>

		<?php						
			//echo form_input('search_string', $search_string_selected, 'style="width: 170px;height: 26px;margin-left: 10px;" placeholder="Invoice Number"');
			//echo form_label('Order by:', 'order');
			//echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');
									
		    $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Go');
									
			//$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
			//echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');                                
			echo '&nbsp;&nbsp;'.form_submit($data_submit).'&nbsp;&nbsp;';
			
        ?>

    <?php echo form_close(); ?>
     
    <button class="btn btn-info btn-reser btn-sm" onClick="reload()" >Reset</button>

	<script>
		$(function() {

	    	$( "#invoiceDateFrom" ).datepicker().on('changeDate',function(e) {
			    
			});

	    	$( "#invoiceDateTo" ).datepicker().on('changeDate',function(e) {
			   
			});

	  	});
	</script>

</div>
                                 <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>     
                                      <?php
            
                                            
											if ($count_invoice!='0')
											{
											//echo "<>";print_r($invoice);die;
                                            foreach($invoice as $key => $val){ 
											$bid_id=$val['bid_id'];
											$bidsql="select * from `bidjob` where `id`='$bid_id'";
											$bidquery=mysql_query($bidsql);
											$bidfetch=mysql_fetch_array($bidquery);
											$job_id=$bidfetch['job_id'];
											$trans_id=$bidfetch['trans_id'];
											
											
											$sql="select * from `translator` where `id`='$trans_id'";
											$query=mysql_query($sql);
											$fetch=mysql_fetch_array($query);
											$trans_name=$fetch['first_name'].'&nbsp;'.$fetch['last_name'];
											$paypal_id=$fetch['paypal_id'];
											
											
											$jobsql="select * from `jobpost` where `id`='$job_id'";
											$jobquery=mysql_query($jobsql);
											$jobfetch=mysql_fetch_array($jobquery);
											$job_title=$jobfetch['name'];
											$job_alias=$jobfetch['alias'];
                                            ?>
                                            <tr>
                                            <td>
                                            
                                            
                                            <a href="<?php echo base_url(); ?>admin_jobpost/edit/<?php echo $job_id; ?>" target="_blank" ><?php echo $job_title; ?></a>
                                            </td>                                            
                                            <td><a href="<?php echo base_url().'admin_translators/edittranslator/'.$trans_id; ?>" target="_blank" ><?php echo $trans_name; ?></a></td>
                                          <?php $time=$bidfetch['time_need']/1440;
										  ?>
                                            <td><?php echo $time; ?>&nbsp;Day(s)</td>
                                            <td>$<?php echo $bidfetch['price']; ?></td>
                                           
                                           <?php

                                           $partial = $partial + $bidfetch['price'];

                                           ?>
                          
                                   
        
                                <td>
                                <?php echo date('m-d-Y',strtotime($bidfetch['award_date'])); ?>
                                </td>
                                 <td>
                                <?php
								if($bidfetch['stage']=='2')
								{								
								echo date('m-d-Y',strtotime($bidfetch['complete_date'])); 
								} 
								else
								{
								?>
								<a href="#"><button onclick="confirm(<?php echo $bidfetch['id']; ?>,<?php echo $bidfetch['job_id'];?>)" type="button" class="btn btn-danger btn-xs" aria-haspopup="true" aria-expanded="false">Mark as Completed</button></a> 
                                <?php
								}
								
								?>
                                </td>
                                
                                 <td>
                                <?php echo $val['invoice_id']; ?>
                                </td>
                                 <td>
                               	<?php $date = date('m-d-Y', strtotime('+31 days', strtotime($bidfetch['complete_date'])));
                               	echo $date; ?>
                                </td>
                               	
                               	<td style = "text-align: center; width: 150px;">
                               		
                               	<?php

                               		$invoiceData = $this->invoice_model->getInvoiceInformation($val['invoice_id']);
                               		$nullDate = $invoiceData->payment_date;

                               		if ($nullDate == "0000-00-00 00:00:00"){
                               	?>

                               		<form method = "post" action = "<?php echo base_url();?>admin_invoice/manual_payment/">

                               			<input type = "hidden" name = "invoiceID" value = "<?php echo $val['invoice_id']; ?>">
                               			<button onclick = "return confirm('Are you sure you want to do a manual payment for this Invoice?');" type="submit" class="btn btn-primary btn-xs">Mark as Paid</button>
                               		</form>

                               	<?php 
                               		}else{
                               			$paymentDate = date('F d, Y', strtotime($invoiceData->payment_date));
                               			echo $paymentDate;
                           			}
                               	?>

                               	</td>

                <td style = "width: 150px;">
                    <?php
					    if($val['payment']==0){

							$date = date('m-d-Y', strtotime('+31 days', strtotime($bidfetch['complete_date'])));								
							$current_date=date('m-d-Y');
							
							if ($date < $current_date){
					?>
								<a style="cursor:default;" href="javascript:void(0)" class="btn btn-danger btn-xs" >Overdue</a>  
					<?php } else {?>
								<a style="cursor:default;" href="javascript:void(0)" class="btn btn-success btn-xs" >&nbsp; Open &nbsp;</a>  
					<?php } ?> 
                                    
                            <a href="<?php echo base_url().'paypal/?id='.$bid_id;?>" class="btn btn-warning btn-xs" target="_blank">Pay Now</a>  
									 
					<?php						
						} else {
					?>
							<?php /*
							<a style="cursor:default;" href="javascript:void(0)" class="btn btn-success btn-xs" >&nbsp;&nbsp; Paid &nbsp;&nbsp;</a> 
							*/ ?>


                            <form method = "post" action = "<?php echo base_url();?>admin_invoice/mark_unpaid/">

                            	<input type = "hidden" name = "invoiceID" value = "<?php echo $val['invoice_id']; ?>">
                            	<button onclick = "return confirm('Are you sure you want to mark this Invoice as Unpaid?');" type="submit" class="btn btn-danger btn-xs">Mark as Unpaid</button>
                            </form>

                    <?php } ?>
                </td>
                                
                             
                              
                                          </tr>
                                            <?php
											}
											} 
											else											
											{ ?>
                                            <tr><td colspan="7" align="center">No Invoices Found!</td></tr>
                                            <?php
											
											}
											
                                        ?>
                                     	<tr>
                                     		<td></td>
                                     		<td></td>
                                     		<td></td>
                                     		<td>$<?php echo number_format($partial, 2, '.', ','); ?></td>
                                     		<td></td>
                                     		<td></td>
                                     		<td></td>
                                     		<td></td>
                                     		<td></td>
                                     		<td></td>
                                     	</tr>
                                        </tbody>
                                    </table>
                                    <h3>Total Accounts Payable: $<?php echo  number_format($payable, 2, '.', ','); ?></h3>
                                    
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
function reload()
{
window.location.href="<?php echo base_url().'admin/invoice/'?>";	
}
</script>
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
	window.location.href="<?php echo base_url(); ?>admin/complete/"+id+"/"+job_id;
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
