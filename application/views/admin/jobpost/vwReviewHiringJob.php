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
								<a href="#">Review Job</a>
							</li>
							<li class="active">Hiring Review Job List</li>
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
								Review Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Hiring Review Job List
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

                               <?php if ($this->session->flashdata('success_message')) { ?>
								 <div class="alert alert-block alert-success">
    								 <button type="button" class="close" data-dismiss="alert">
                                     <i class="ace-icon fa fa-times"></i>
                                     </button>

                                    <p><?php echo $this->session->flashdata('success_message'); ?></p>
                                 </div>
                               <?php } ?>

                                 <?php if($this->session->flashdata('error_message')) { ?>
								 <div class="alert alert-block alert-danger">
    								 <button type="button" class="close" data-dismiss="alert">
                                     <i class="ace-icon fa fa-times"></i>
                                     </button>

                                    <p><?php echo $this->session->flashdata('error_message'); ?></p>
                                 </div>

                               <?php } ?>

								<div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Hiring Job List"
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">Job Title</th>
                                                <th class="center">Job Price</th>
                                                <th class="center">Job Status</th>
                                                <th class="center">Job Type</th>
                                                <th class="center">Description</th>
                                                <th class="center">Translate From</th>
                                                <th class="center">Translate To</th>
                                                <th class="center">Send Invitation</th>
                                                <th class="center">Bids</th>
                                                <th>Operations</th>
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
									foreach ($hiringjob as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}

								    echo form_open('admin_review/hiring', $attributes);
									echo form_label('Search:', 'search_string');
									//echo form_input('search_string', $search_string_selected, 'style="width: 170px;height: 26px;"');
									$datai = array(
                                           'name'        => 'search_string',
										   'placeholder' => 'Enter Job Title/Line Number',
                                           'value'          =>$search_string_selected,
                                           'style'       => 'width:450px;height:30px;'
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


                                            if ($count_hiringjob!='0') {
                                            foreach ($hiringjob as $key => $val) {
                                            ?>
                                            <tr>
                                            <td>
                                            <a href="<?php echo base_url(); ?>admin_review/viewsummary/<?php echo $val['id']; ?>" target="_blank" ><?php echo $val['name']; ?>&nbsp;/&nbsp;<?php echo $val['lineNumberCode'] ?></a>
                                            <!-- <a href="<?php echo base_url(); ?>admin_jobpost/viewsummary/<?php echo $val['id']; ?>" target="_blank" ><?php echo $val['name']; ?></a> -->
                                            </td>

                                            <td>$<?php echo $val['price']; ?></td>
                                            <td>
                                            	<?php

                                            		switch($val['stage']){
                                            			case 0:	echo "OPEN";
                                            				break;
                                            			case 1: echo "CLOSE";
                                            				break;
                                            			case 2: echo "COMPLETED";
                                            				break;
                                            			default:
                                            				break;
                                            		}

                                            	?>
                                            </td>
                                            <td>
                                            	<?php

                                            		switch($val['job_type']){
                                            			case 0:	echo "PUBLIC";
                                            				break;
                                            			case 1: echo "PRIVATE";
                                            				break;
                                            			default:
                                            				break;
                                            		}

                                            	?>
                                            </td>

                                            <td>

                                            <?php
											if(strlen($val['description'])>70)
											{
											echo substr($val['description'],0,70).'...';
                                            }
                                            else
                                            {
                                            echo $val['description'];
                                            }
                                            ?>
                                            </td>

                                            <?php /* JBP */ ?>
                                            <?php
                                            	$translationLanguages = $val['language'];
                                            	$languages = explode("/", $translationLanguages);
                                            	$langFrom = $this->adminhiringjob_model->getLanguageInfo($languages[0]);
                                            	$langTo = $this->adminhiringjob_model->getLanguageInfo($languages[1]);
                                            ?>
                                            <td><?php echo $langFrom->name; ?></td>
                                            <td><?php echo $langTo->name; ?></td>
                                            <?php /* JBP */ ?>

                                            <td><a class="btn btn-info" href="<?php echo base_url();?>admin_translators/<?php echo $val['id']; ?>"><i class="fa fa-paper-plane"></i>Send</a></td>

                                            <?php /*?><td><a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $val['file']; ?>" class="btn btn-success" target="_blank"> View  </a></td> <?php */?>


                                        <?php
                                            $job_id = $val['id'];
    										$condition = array('job_id' => $job_id);
    										$total = $this->db->where($condition)->count_all_results('bidjob');
										?>

										<td>
                                        <?php if ($total) : ?>
                                            <a href="<?php echo base_url(); ?>admin_review/viewsummary/<?php echo $job_id; ?>" target="_blank" class="btn btn-success"><?php echo $total; ?>&nbsp;Bids</a>
                                        <?php else : ?>
                                            <a href="javascript:void(0)" style="cursor:default"class="btn btn-success"><?php echo $total; ?>&nbsp;Bids</a>
                                        <?php endif; ?>
                                        </td>
                                        
                                         <td>

                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <?php if ($val['proofread_required']) { ?>
                                                    <a class="green" href="<?php echo base_url(); ?>admin_review/edit/<?php echo $val['id']; ?>"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                                    <?php } else { ?>
                                                    <a class="green" href="<?php echo base_url(); ?>admin_jobpost/edit/<?php echo $val['id']; ?>"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                                    <?php }?>

                                                    <a class="red" href="#"  onclick="alert(<?php echo $val['id']; ?>)"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                                                </div>

                                            </td>
                                          </tr>
                                        <?php
                                            }
                                            }
											else
											{ ?>
                                            <tr><td colspan="11" align="center">No Jobs Found!</td></tr>
                                            <?php

											}

                                        ?>
                                        </tbody>
                                    </table>

																	<?php if ($this->pagination->create_links()) { ?>
																	<div class="pagination"><?php echo $this->pagination->create_links() ?></div>
																	<?php } ?>

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
function alert(id)
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin_review/delete/" + id;
	}
}
</script>
<script type="text/javascript">
    function reload()
    {
        window.location.href="<?php echo base_url().'admin_review/hiring/'?>";
    }
</script>
<script type="text/javascript">
    function goBack()
    {
        window.history.back();
    }
</script>

<?php
$this->load->view('admin/includes/vwFooter');
?>
