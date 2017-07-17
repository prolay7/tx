<?php
$this->load->view('admin/cust_service/includes/vwHeader');
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>


			<?php
				$this->load->view('admin/cust_service/includes/vwSidebar-left');
			?>


			<div class="main-content">
				<div class="main-content-inner">

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
							<li class="active">List For Approval Jobs</li>
						</ul>


					</div>


					<div class="page-content">
						<?php
							$this->load->view('admin/cust_service/includes/vwSidebar-settings');
						?>

						<div class="page-header">
							<h1>
								Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									List For Approval Job
								</small>
							</h1>
						</div>

						<div class="row">
							<div class="col-xs-12">

							<!--################start##################-->

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
                                                 <th class="center">Date</th>
												 <th class="center">Job Title</th>
                                                 <th class="center">Line Number</th>
                                                 <th class="center">Status</th>
                                                 <th class="center">Operations</th>
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

								    echo form_open('cs_admin/csListForApprovalJobs', $attributes);
									echo form_label('Search:', 'search_string');
									//echo form_input('search_string', $search_string_selected, 'style="width: 170px;height: 26px;"');
									$datai = array(
                                           'name'        => 'search_string',
										   'placeholder' => 'Enter Job Title',
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
												<?php echo $val['created']; ?>
											  </td>

											 <td>
												<a href="javascript:void(0);"><?php echo $val['name']; ?></a>

											   </td>

											      <td>
												  <?php echo $val['lineNumberCode']; ?>
												  </td>


											   <td>
											   <?php
											 $approval_status=$val['approval_status'];
                                             if($approval_status==0)
											 {
											 echo 'Pending';
											 }
											  if($approval_status==1)
											 {
											 echo 'Accepted';
											 }
											 ?>
											   </td>

											   <td>

											    <div class="hidden-sm hidden-xs action-buttons">

										 <?php
											 $approval_status=$val['approval_status'];
                                             if($approval_status==0)
											 {?>

                                 <a class="green" href="<?php echo base_url(); ?>cs_admin/pendingEditApproval/<?php echo $val['id']; ?>">
                                             <i class="ace-icon fa fa-pencil bigger-130"></i></a>


											 <a onclick="return  confir()" class="red" href="<?php echo base_url(); ?>cs_admin/deletejob/<?php echo $val['id']; ?>">
                                             <i class="ace-icon fa fa-trash-o bigger-130"></i></a>
											 <?php }?>
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

                                    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

                                </div>
                               <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
								<!-- PAGE CONTENT ENDS -->
							<!--################end##################-->


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
function confir()
{
    con=confirm("Are you sure you want to proceed?");
    if(con!=true) {
        return false;
    } else {
		return true;
	}

}
function reload()
{
    window.location.href="<?php echo base_url().'cs_admin/csListForApprovalJobs/'?>";
}
    initSample();
</script>
<!--<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jqueryn.js"></script>-->


<?php
$this->load->view('admin/cust_service/includes/vwFooter');
?>
