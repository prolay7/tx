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
							<li class="active">Pending Approval</li>
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
									View Pending Approval List
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
                                        Results for "Job List"
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                 <th class="center">Client Name</th>
                                                 <th class="center">Amount Charged</th>
                                                 <th class="center">Job Status</th>
                                                 <!-- <th class="center">Job Type</th> -->
                                                 <th class="center">Description</th>
                                                 <th class="center">Translate From</th>
                                                 <th class="center">Translate To</th>
                                                 <!-- <th class="center">Send Invitation</th> -->
                                                 <!-- <th class="center">Bids</th> -->

                                                <th>Operations
                                                <input type="checkbox" id="selecctall"/> Select All</span>
											<input type="submit" class="btn btn-danger" value="Multiple Delete" id="alldelete" />
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        <style type="text/css">
											.order_by_cls {
												display:none;
											}
										</style>
                                    <?php

									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
									//save the columns names in a array that we will use as filter
									$options_category = array();
									//echo '<pre>'; print_r($category);
									foreach ($jobpost as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}

								    echo form_open('admin/pendingjobpost', $attributes);
									echo form_label('Search:', 'search_string');
									//echo form_input('search_string', $search_string_selected, 'style="width: 170px;height: 26px;"');
									$datai = array(
                                           'name'        => 'search_string',
										   'placeholder' => 'Enter Job Title, Line Number',
                                           'value'          =>$search_string_selected,
                                           'style'       => 'width: 470px;height: 30px;'
                                                 );
								  echo form_input($datai);

								//echo form_label('Order by:', 'order');
								echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');

							   $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Go');

								$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
								echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');

								echo '&nbsp;&nbsp;'.form_submit($data_submit).'&nbsp;&nbsp;';

								echo form_close();

                                        ?>
                             <button class="btn btn-info btn-reser btn-sm" onClick="reload()" >Reset</button>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                     <?php


                                            if ($count_jobpost!='0')
											{$count=1;
                                            foreach($jobpost as $key => $val){
												$num= $count++;
                                            ?>
                                            <tr>
                                            <td>
                                            <input class="checkbox1" type="checkbox" name="check[]" value=" <?php echo $val['id']; ?>" id="chk<?php echo $num;?>" >
                                            <!-- <a href="<?php echo base_url(); ?>admin_jobpost/viewsummary/<?php echo $val['id']; ?>" target="_blank" ><?php echo $val['name']; ?></a> -->
                                            <?php echo $val['name']; ?>
                                            </td>
                                            <td><?php echo "$ ".$val['price']; ?></td>
                                            <td>
                                            <?php
                                            // @benjie Job Status
                                            echo "For Approval";
											 // $satge=$val['stage'];
            //                                  if($satge!=2)
											 // {
											 // echo 'OPEN';
											 // }
											 //  if($satge==2)
											 // {
											 // echo 'CLOSE';
											 // }
											 ?>
                                            </td>
                                             <!-- <td>  -->
                                            <?php
                                            // @benjie Job Type
											 // $job_type=$val['job_type'];
            //                                  if($job_type==0)
											 // {
											 // echo 'Public';
											 // }
											 //  if($job_type==1)
											 // {
											 // echo 'Private';
											 // }
											 ?>
                                            <!-- </td> -->

                                            <td>
	                                            <?php
													if(strlen($val['description']) > 70) {
														echo substr($val['description'],0,70).'...';
		                                            } else {
		                                            	echo $val['description'];
		                                            }
	                                            ?>
                                            </td>

                                             <?php $language_id=$val['language'];
											//echo $language_id;
											$pieces = explode("/", $language_id);
											$languagef_id=$pieces[0];
											$sql1="select `name` from `languages` where `id`='$languagef_id'";
											$query1=$this->db->query($sql1);
											$fetch1=$query1->row();
											$languagef_name=$fetch1->name;
											?>

                                             <td><?php echo $languagef_name; ?></td>

                                            <?php
											//echo'<pre>';print_r($pieces);
											$language_id=$pieces[1];
											$sql="select `name` from `languages` where `id`='$language_id'  ";
											//echo $sql;die;
											$query=$this->db->query($sql);
											$fetch=$query->row();
											$language_name=$fetch->name;
											?>

                                             <td><?php echo $language_name; ?></td>
                                              <?php /*?><td><a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $val['file']; ?>" class="btn btn-success" target="_blank"> View  </a></td> <?php */?>

                                                 <!-- <td>
                                                     <a class="btn btn-info" href="<?php echo base_url();?>admin_translators/<?php echo $val['id']; ?>"><i class="fa fa-paper-plane"></i>Send</a> -->

                                       <?php /*?><?php if($val['job_type']==1){ ?>

                                          <a class="btn btn-info" href="<?php echo base_url();?>admin_translators/<?php echo $val['id']; ?>"><i class="fa fa-paper-plane"></i>Send</a>
                                        <?php } ?><?php */?>

                                        <!-- </td> -->

                                        <?php
										$job_id=$val['id'];
										$bidsql="select `job_id` from `bidjob` where `job_id`='$job_id'";
										$bidquery=$this->db->query($bidsql);
										$bid_num=$bidquery->num_rows();
									 	if($bid_num>=1)
                                        {
										?>
                                        <!-- <td><a href="<?php echo base_url(); ?>admin_jobpost/viewsummary/<?php echo $val['id']; ?>" target="_blank" class="btn btn-success" > <?php echo $bid_num; ?>&nbsp;Bids</a></td>  -->
                                        <?php
										/*echo base_url(); ?>bidjob/<?php echo $val['id'];*/
										}
                                        else
                                        {
										?>
                                        <!-- <td><a href="javascript:void(0)" style="cursor:default"class="btn btn-success" ><?php echo $bid_num; ?> &nbsp;Bids</a></td>   -->
                                        <?php
										}
										?>
                                        <!--<td><a href="<?php echo base_url(); ?>admin_jobpost/viewbid/<?php echo $val['id']; ?>" class="btn btn-info" >View Bid</a></td> -->


                                      <td>

                                                <div class="hidden-sm hidden-xs action-buttons">
                                                        <!--<a class="blue" href="#">
                                                            <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                        </a>-->

                                 <a class="green" href="<?php echo base_url(); ?>admin_jobpost/pendingEditApproval/<?php echo $val['id']; ?>">
                                             <i class="ace-icon fa fa-pencil bigger-130"></i></a>

                                                       <!-- <a class="red" href="#"  onclick="alert1(<?php echo $val['id']; ?>)">
                   <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                        </a>-->
                                                      <?php /*?>  <?php if($bid_num!=0){?>
                                                        <a href="<?php echo base_url(); ?>admin_jobpost/viewsummary/<?php echo $val['id']; ?>" class="btn btn-info" >View Bid</a>
                                                        <?php } ?><?php */?>
                                                </div>

                                            </td>
                                          </tr>
                                        <?php
                                            }
                                            }
											else
											{ ?>
                                            <tr><td colspan="9" align="center">No Jobs Found!</td></tr>
                                            <?php

											}

                                        ?>
                                        </tbody>
                                    </table>

                                    <?php $links = $this->pagination->create_links(); if(!empty($links)) echo '<div class="pagination">'.$links.'</div>'; ?>

                                </div>
                               <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
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
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#alldelete').click(function(event) {

	del =confirm("Are you sure to delete permanently?");
	 if(del!=true)
    {
        return false;
    }
	else
	{
		del1 =confirm("THERE IS NO WAY TO REVERSE the delete, do want to proceed anyway?. ");
		 if(del1!=true)
    		{
       			 return false;
   			 }else{
					var arr=[];
				$.each($("input[name='check[]']:checked"),function(){
   				 arr.push($(this).val());
				});
				 var id= arr.toString();
				 if(id!=""){
				$.ajax({
				type: "POST",
				data: {id:id},
				url: "<?php echo base_url(); ?>admin_jobpost/deleteall",
				success: function(data){alert(data);
				 window.location.reload();
				}
				});
			 }else{
				 alert("Please select atleast one job");
			 }

			 }
	}//on click

    });

});
</script>
<script type="text/javascript">
function alert1(id)
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin_jobpost/delete/"+id;
	}
}
</script>
<script type="text/javascript">
function reload()
{
<?php //$this->session->unset_userdata('search_string_selected'); ?>
window.location.href="<?php echo base_url().'admin/pendingjobpost/'?>";
}
</script>
<script>
function goBack() {
    window.history.back();
}
</script>
