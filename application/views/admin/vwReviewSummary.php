<?php
	$this->load->view('admin/includes/vwHeader');
	$adminID=$this->session->userdata('admin_id');
?>

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">

<script type="text/javascript">
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
</script>

<!-- #section:basics/sidebar -->
<?php $this->load->view('admin/includes/vwSidebar-left'); ?>
<!-- /section:basics/sidebar -->

<div class="main-content">
	<div class="main-content-inner">

		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>

			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a></li>
				<li><a href="#">Review Job </a></li>
				<li class="active">Summary</li>
			</ul>

			<!-- /.breadcrumb -->
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
            <?php $this->load->view('admin/includes/vwSidebar-settings'); ?>
			<!-- /.ace-settings-container -->

            <?php
				$job_id= $this->uri->segment(3);
				$sql1 = "SELECT * FROM jobpost WHERE id = '$job_id'";
				$val1 = $this->db->query($sql1);
				$fetch1= $val1->row();

                $sql = "SELECT id FROM jobpost WHERE lineNumberCode LIKE '%".$fetch1->lineNumberCode."%'";
                $query = $this->db->query($sql);

                if ($query->num_rows()) {
                    foreach ($query->result_array() as $row) {
                        $ids_arr[] = $row['id'];
                    }

                    $ids = implode(',', $ids_arr);

                    $sql = "SELECT SUM(price) AS remaining_balance FROM bidjob WHERE awarded = 1 AND job_id IN (".$ids.")";
                    $query = $this->db->query($sql);
                    $balance = $query->row();

                    $remaining_balance = $fetch1->price - $balance->remaining_balance;
                } else {
                    $remaining_balance = $fetch1->price;
                }

			?>

			<!-- /section:settings.box -->
			<div class="page-header">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Review Job <small><i class="ace-icon fa fa-angle-double-right"></i> Summary</small></h1>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url() ?>admin_review/edit/<?php echo $fetch1->id ?>" style="float:right; margin-right: 70px" class="btn btn-app btn-lg" target="_blank" ><i class="glyphicon glyphicon-pencil" style="margin-right: 10px"></i>Edit</a>
                    </div>
                </div>

			</div>
			<!-- /.page-header -->

            <?php if ($this->session->flashdata('msg')!="") { ?>
                <div class="alert alert-block alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <p><?php echo $this->session->flashdata('msg'); ?> </p>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('wmsg')!="") { ?>
				<div class="alert alert-danger">
                	<button type="button" class="close" data-dismiss="alert">
                    	<i class="ace-icon fa fa-times"></i>
                	</button>
                	<p><?php echo $this->session->flashdata('wmsg'); ?> </p>
            	</div>
			<?php } ?>



            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Job Name:</h4>
                </div>
                <div class="col-xs-8">
                    <h5><a href="javascript:void(0)"><?php echo $fetch1->name; ?></a></h5>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Client Name:</h4>
                </div>
                <div class="col-xs-8">
                    <h5> <?php echo $fetch1->clientName; ?></h5>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Line Number:</h4>
                </div>
                <div class="col-xs-8">
                    <h5> <?php echo $fetch1->lineNumberCode; ?></h5>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Amount Charged:</h4>
                </div>
                <div class="col-xs-2">
                    <h5>$<?php echo $fetch1->price; ?></h5>
               	</div>

                <div class="col-xs-2">
                    <h4 class="blue">Remaining Balance:</h4>
                </div>
                <div class="col-xs-6">
                    <h5>$<?php echo $remaining_balance; ?></h5>
               	</div>
            </div>

            <div class="row">
                <?php
                if ($fetch1->dueDate) {
                    $due = $fetch1->dueDate;
                    $due_arr = explode(' ', $due);
                    if (isset($due_err[1])) {
                        $date = str_replace('-', '/', $due_arr[0]).' '.$due_arr[1];
                        $due_date = date('jS F Y h:i A', strtotime($date)).' EST';
                    } else {
                        $date = str_replace('-', '/', $due_arr[0]);
                        $due_date = date('jS F Y', strtotime($date));
                    }
                } else {
                    $due_date = 'No due date set';
                }
                ?>
                <div class="col-xs-2">
                    <h4 class="blue">Due Date:</h4>
                </div>
                <div class="col-xs-8">
                    <h5><?php echo $due_date; ?></h5>
               	</div>
            </div>

            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Job Details:</h4>
                </div>
                <div class="col-xs-8">
                    <h5><?php echo $fetch1->description; ?></h5>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Type of Review:</h4>
                </div>
                <div class="col-xs-8">
                    <h5><?php echo ($fetch1->proofreadType) ? ucfirst($fetch1->proofreadType) : 'Not Applicable' ?></h5>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2">
                    <h4 class="blue">Translate From:</h4>
                </div>

                <?php

                	$language_id = $fetch1->language;
			 		//echo $language_id;
					$pieces = explode("/", $language_id);
					$languagef_id = $pieces[0];

					$sql5 = "select `name` from `languages` where `id`='$languagef_id'";

					$query5 = $this->db->query($sql5);
					$fetch5 = $query5->row();
					$languagef_name = $fetch5->name;

					$language_id = $pieces[1];

					$sql6 = "select `name` from `languages` where `id`='$language_id'  ";

					//echo $sql;die;
					$query6 = $this->db->query($sql6);
					$fetch6 = $query6->row();
					$language_name = $fetch6->name;
				?>

                <div class="col-xs-2">
                    <h5> <?php echo $languagef_name; ?></h5>
                </div>

                <div class="col-xs-2">
                    <h4 class="blue">Translate To:</h4>
                </div>

                <div class="col-xs-2">
                    <h5> <?php echo $language_name; ?></h5>
                </div>
            </div>

			<?php
                $sql  = "SELECT p2.*, p2.id AS proofread_job_doc_id, CONCAT(first_name, ' ', last_name) AS translator_name FROM proofread_jobs p1";
                $sql .= " JOIN proofread_jobs_docs p2 ON p2.proofread_job_id = p1.id ";
                $sql .= " JOIN translator t ON t.id = p2.translator_id ";
                $sql .= "WHERE p1.job_id=".$fetch1->id;
                $sql .= ' AND p2.is_active = 1';
                $sql .= " ORDER BY p2.doc_order ASC";
                $query = $this->db->query($sql);

                if ($query->num_rows()) {
                ?>
                <div class="row">
                    <div class="col-xs-2">
                        <h4 class="blue">Documents:</h4>
                    </div>
                </div>

                <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width: 70%">
                    <thead>
                        <tr>
                            <th class="center" style="width: 5%">#</th>
                            <th class="center" style="width: 30%">Original File</th>
                            <th class="center" style="width: 30%">Translated File</th>
                            <th class="center" style="width: 20%">Translator</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
				$k=1;
                    foreach ($query->result_array() as $i => $result) {
                        $original = explode('/', $result['original_file']);
                        $translated = explode('/', $result['translated_file']);
						
                ?>
                        <tr>
                            <!--<td style="text-align: center; vertical-align: middle;"><?php// echo $result['doc_order'] ?></td>-->
							<td style="text-align: center; vertical-align: middle;"><?php echo $k; ?></td>
                            <td><a href="<?php echo base_url() ?>admin/review/document/viewer/<?php echo $result['proofread_job_doc_id'] ?>/original_file" class="btn btn-app btn-purple btn-lg" target="_blank"><?php echo $original[1]; ?></a></td>
                            <td><a href="<?php echo base_url() ?>admin/review/document/viewer/<?php echo $result['proofread_job_doc_id'] ?>/translated_file" class="btn btn-app btn-purple btn-lg" target="_blank"><?php echo $translated[1]; ?></a></td>
                            <td style="vertical-align: middle"><?php echo $result['translator_name'] ?></td>
                        </tr>
                <?php
                   $k++;  }
                ?>
                    </tbody>
                </table>
                <?php
                }

                // $view=explode("##", $fetch1->file);
                // array_pop($view);
                //print_r($view);
                // $num_of_file= count($view);
            ?>

                <div class="row">
                    <div class="col-xs-2">
                	    <h4 class="blue">Job Status:</h4>
                    </div>

                	<div class="col-xs-8">
                    	<?php if($fetch1->stage!='2') { ?>
                     		<a href="#" style="margin-left:36px;"><button onclick="hiring(<?php echo $job_id; ?>)" type="button" class="btn btn-danger " aria-haspopup="true" aria-expanded="false">Hiring Open</button></a>
					 	<?php } ?>


                        <?php if($fetch1->stage=='2') { ?>
                             <a href="#" style="margin-left:36px;"><button onclick="openhiring(<?php echo $job_id; ?>)"  type="button" class="btn btn-success " aria-haspopup="true" aria-expanded="false">Hiring Closed</button></a>
						<?php } ?>
                    </div>
                </div>

				<div class="row">
					<div class="col-xs-12">

						<!-- PAGE CONTENT BEGINS -->
						<div class="tabbable">

							<!-- #section:pages/faq -->
							<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
								<li class="active">
									<a data-toggle="tab" href="#faq-tab-1">
										<i class="green ace-icon fa fa-user bigger-120"></i>
										Translator Bids
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#faq-tab-2">
										<i class="blue ace-icon fa fa-user bigger-120"></i>
										Invitations
									</a>
								</li>
							</ul>

							<!-- /section:pages/faq -->
							<div class="tab-content no-border padding-24">
								<div id="faq-tab-1" class="tab-pane fade in active">
									<h4 class="blue">
										<i class="green ace-icon fa fa-user bigger-110"></i>
										Translator Bids
									</h4>

									<div class="space-8"></div>

                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    	<thead>
                                        	<tr>
                                        		<th class="center">Job Title</th>
                                                <th class="center">Translator Name</th>
                                                <th class="center">Translator Review</th>
                                                <th class="center">Time Need</th>
                                                <th class="center">Price</th>
                                                <th class="center">Awarded</th>
                                                <th class="center">Message</th>
                                                <th>Bid Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <style type="text/css">
											.order_by_cls { display:none; }
										</style>

										<?php

											$sql5 = "SELECT * FROM bidjob WHERE job_id = '$job_id;' ORDER BY id DESC";

											$val5 = $this->db->query($sql5);
											$fetch5= $val5->result_array();
											//echo'<pre>'; print_r($fetch5);

										  	foreach($fetch5 as $key => $val){
												// echo '<pre>'; print_r($val);die;

												$translator_id=$val['trans_id'];
												$sql="select * from `translator` where `id`='$translator_id'";
												$query=mysql_query($sql);
												$fetch=mysql_fetch_array($query);
												$trans_name=$fetch['first_name'].'&nbsp;'.$fetch['last_name'];

												$trans_pic=$fetch['images'];
												//echo $trans_pic;
												$job_id=$val['job_id'];
												$sql1="select * from `jobpost` where `id`='$job_id'";
												$query1=mysql_query($sql1);
												$fetch1=mysql_fetch_array($query1);
												$job_title=$fetch1['name'];
                                        ?>
                                            	<tr>
                                           			<td>
                                           				<a href="<?php echo base_url(); ?>admin_jobpost/edit/<?php echo $job_id; ?>" target="_blank"></a><?php echo $job_title; ?>
                                           			</td>
                                           			<td>
                                           				<a href="<?php echo base_url().'admin/translators/edit/'.$val['trans_id']; ?>" target="_blank"></a>
                                                        <div class="row">
                                                            <div class="col-xs-12" style="margin-bottom: 7px;"><?php echo $trans_name; ?></div>
                                                        </div>
                                           			</td>
                                           			<td style="padding-left: 30px;">
                                                        <?php
                                                        $sql = "SELECT TRUNCATE(sum(rating)/count(id), 2) as average_rating FROM ratings WHERE translator_id = ".$translator_id;
                                                        $query = $this->db->query($sql);

                                                        $avg = $query->row();

                                                        $sql = "SELECT COUNT(id) as awarded FROM bidjob WHERE trans_id = ".$translator_id." AND awarded = 1";
                                                        $query = $this->db->query($sql);

                                                        $projects = $query->row();

                                                        // echo '<pre>'; print_r($val); exit;
                                                        ?>
                                                        <div class="row" style="margin-below: 7px;">
                                                            <a class="various btn btn-success"  href="<?php echo base_url(); ?>admin/translatorreview/<?php echo $val['trans_id']; ?>">View</a>
                                                        </div>
                                           				<div class="row">
                                           				    <a href="<?php echo base_url() ?>admin/translatorreview/<?php echo  $translator_id?>" traget="_blank"><?php echo $projects->awarded ?> projects, <?php echo ($avg->average_rating) ? $avg->average_rating : '0' ?> average rating</a>
                                           				</div>
                                           			</td>
                                             		<?php
                                             			$time=$val['time_need'];
										   				$time= $time/1440;
										   			?>
                                            		<td><?php echo  $time; ?>&nbsp;Day(s)</td>
                                            		<td>$<?php echo $val['price']; ?></td>
													<td>
                                                        <?php
                                                        $proofread_job = $this->db->from('proofread_jobs')->where('job_id', $val['job_id'])->get();
                                                        if ($proofread_job->num_rows()) {
                                                            $proofread_job_id = $proofread_job->row()->id;

                                                            $proofread_job_docs = $this->db->from('proofread_jobs_docs')->where(array('proofread_job_id' => $proofread_job_id))->get();
                                                            if ($proofread_job_docs->num_rows()) {
                                                                $proofread_job_doc_id = $proofread_job_docs->row()->id;
                                                            } else {
                                                                $proofread_job_doc_id = 0;
                                                            }
                                                        } else {
                                                            $proofread_job_id = 0;
                                                            $proofread_job_doc_id = 0;
                                                        }
                                                        ?>
                                                        <?php if ($val['awarded'] == 0) { ?>
                                                        <button type="button" id="toggle-award-review-job" data-id="<?php echo $val['id'] ?>" data-jobid="<?php echo $val['job_id'];?>" data-bidjob="<?php echo $val['id'] ?>" data-translator="<?php echo $translator_id ?>" class="btn btn-danger" aria-haspopup="true" aria-expanded="false">No</button>
                                                        <?php } ?>

                                                        <?php if ($val['awarded'] == 1) { ?>
                                                        <button type="button" id="toggle-unaward-review-job"  data-jobid="<?php echo $val['job_id'];?>" data-bidjob="<?php echo $val['id'] ?>" data-translator="<?php echo $translator_id ?>" data-proofread-job="<?php echo $proofread_job_id ?>" data-proofread-doc="<?php echo $proofread_job_doc_id ?>" class="btn btn-success" aria-haspopup="true" aria-expanded="false">Yes</button>
                                                        <?php }?>
													</td>
							                        <td>
							                            <?php
															$bid_id=$val['id'];
															$invoicesql="select `bid_id` from `message` where `bid_id`='$bid_id' ";
															$invoicequery=$this->db->query($invoicesql);
															$invoice_num=$invoicequery->num_rows();
														?>
							                            <a class="btn btn-info" href="<?php echo base_url(); ?>chat-box/?bid_id=<?php echo $bid_id; ?>&job_id=<?php echo $val['job_id']; ?>&trans_id=<?php echo $val['trans_id']; ?>&type=<?php echo "admin"; ?>&ciadminId=<?php echo $adminID; ?>" target="_blank">
							                            &nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;Chat &nbsp;&nbsp;&nbsp;&nbsp;
							                            </a>
							                        </td>
						                            <td>
						                                <div class="hidden-sm hidden-xs action-buttons">
						          							<a class="green" href="<?php echo base_url(); ?>admin_jobpost/bidjobedit/<?php echo $val['id']; ?>">
						                                		<i class="ace-icon fa fa-pencil bigger-130"></i>
						                                	</a>
						                                	<a class="red" href="#"  onclick="alert1(<?php echo $val['job_id']; ?>,<?php echo $val['id']; ?>)">
						                                		<i class="ace-icon fa fa-trash-o bigger-130"></i>
						                                	</a>
						                                	<a class="various btn btn-success btn-xs" data-fancybox-type="iframe" href="<?php echo base_url(); ?>admin_jobpost/viewbiddetails/<?php echo $val['id']; ?>">
						                                		<i class="fa fa-eye"></i>View
						                                	</a>
						                                </div>
						                            </td>
                                          		</tr>
                                            <?php
											}
											?>

										</tbody>
                                    </table>
								</div>

								<div id="faq-tab-2" class="tab-pane fade">
									<h4 class="blue">
										<i class="blue ace-icon fa fa-user bigger-110"></i>
										Invitations
									</h4>

									<div class="space-8"></div>

									<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center blue">Translator Name</th>
                                                <th class="center blue">Translator Email Addresses</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php

											$sql4 = "SELECT * FROM send_invitation WHERE job_id = '$job_id;'";

											$val4 = $this->db->query($sql4);

											$fetch4= $val4->result_array();

											//echo'<pre>'; print_r($fetch4);

											$new_invite=array();

											foreach($fetch4 as $count){

												$invite=$count['invite_id'];

												if (strpos($invite, ',') == false) {
													array_push($new_invite, $invite);
												}

												if (strpos($invite, ',') !== false) {

													$newarray=explode(", ",$invite);

													foreach($newarray as $new){
														array_push($new_invite, $new);
													}
												}

												//echo'<pre>';print_r($new_invite);
											}

											foreach($new_invite as $row){

												//echo'<pre>';print_r($row);

											?>
                                          		<tr>
                                            		<td>

											 			<?php

															// $invite_id=$row['invite_id'];

															//$invite_id = str_replace(",", "', '", $invite_id);

															$invite_sql = "SELECT * FROM `translator` WHERE `id` ='" .$row. "'";

															$invite_query= $this->db->query($invite_sql);

															//echo '<pre>';print_r($invite_fetch= $invite_query->result());

															$invite_count=$invite_query->num_rows();

											 				if($invite_count>1) {

											 					$invite_fetch= $invite_query->result();

											 					foreach($invite_fetch as $invite_row) {
											 						echo $invite_row->first_name.'&nbsp;'.$invite_row->last_name.',';
										     					}
											 				}

											 				if($invite_count==1) {									 					$invite_fetch= $invite_query->row();
											 					echo $invite_fetch->first_name.'&nbsp;'.$invite_fetch->last_name;
											 				}

											 			?>
                                            		 </td>
                                           			<td>
														<?php
															if($invite_count>1) {
														  		$invite_fetch= $invite_query->result();
														  		foreach($invite_fetch as $invite_row) {
														 			echo $invite_row->email_address.',';
													     		}
														 	}

														 	if($invite_count==1) {
														 		$invite_fetch= $invite_query->row();
														 		echo $invite_fetch->email_address;
														 	}
														?>
                                             		</td>

												</tr>
										<?php
											}
                                        ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>

					<!-- PAGE CONTENT ENDS -->
					</div><!-- /.col -->
				</div><!-- /.col -->

		</div>

	</div>
</div>

<?php /*
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
*/ ?>

<div id="award-review-job-details" title="Award Review Job" style="display:none">
    <div class="wrapper"></div>
</div>

<div id="dialog-end-hiring" title="End Hiring" style="display:none">
    <p style="font-size: 14px;padding:10px;">Job is awarded, do you want to end hiring now?</p>
</div>

<div id="dialog-document-award" title="Documents" style="display:none">
    <p style="font-size: 14px;padding:10px;">ALL files have been assigned to proofreaders.</p>
</div>

<div id="dialog-document-unaward" title="Documents" style="display:none">
    <p style="font-size: 14px;padding:10px;">Do you want to unaward this job?</p>
</div>

<div id="dialog-document-unaward-confirm" title="Documents" style="display:none">
    <p style="font-size: 14px;padding:10px;">Doing so will delete the invoice due to the translator Name <span id="translator-name"></span>, amount of <span id="invoice-due"></span></p>
</div>

<div id="dialog-document-unaward-message" title="Documents" style="display:none">
    <div class="row">
        <div class="col-md-12">
            <p style="font-size: 14px;padding:10px 0 10px;">Let the Freelancer know why their job is being unawarded.</p>
        </div>
        <div class="col-md-12">
            <form id="notification-form" method="post">
                <textarea id="message" name="message" style="width: 100%; height: 100px"></textarea>
            </form>
        </div>
    </div>
</div>

<div id="dialog-document-unaward-error" title="Documents" style="display:none">
    <p id="error-message-wrapper" style="font-size: 14px;padding:10px;"></p>
</div>


<?php $this->load->view('admin/includes/vwFooter'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/uploadfilemulti.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/jquery-ui-1.12.1.min.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/select2.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-1.8.2.min.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.custom.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/select2.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
$(function () {
    var prompt = "<?php echo $prompt ?>";

    if (prompt) {
        $('#dialog-end-hiring').dialog({
            resizable: false,
            height: "auto",
            width: 500,
            modal: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                "Yes": function () {
                    $(this).dialog('close');
                    var href = window.location.href;
                    href_arr = href.split('/');
                    params = href_arr[6].split('?');
                    id = params[0];

                    if (id) {
                        window.location.href = "<?php echo base_url(); ?>admin_awardjob/jobcomplete/" + id;
                    }
                },
                "No": function () {
                    $(this).dialog('close');
                }
            }
        });
    }

    $(document).on('click', '#toggle-unaward-review-job', function () {
        var jobid            = $(this).data('jobid');
        var trans_id         = $(this).data('translator');
        var bidjob_id        = $(this).data('bidjob');
        var proofread_job_id = $(this).data('proofread-job');
        var proofread_doc_id = $(this).data('proofread-doc');
        var redirect;

        $('#dialog-document-unaward').dialog({
            resizable: false,
            height: "auto",
            width: 500,
            modal: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                "Yes": function () {
                    $(this).dialog('close');

                    $.ajax({
                        url: "<?php echo base_url('admin_review/unaward_check_if_invoiced') ?>",
                        type: "get",
                        data: { job_id: jobid, bidjob_id: bidjob_id, trans_id: trans_id },
                        dataType: 'json',
                        success: function (response) {
                            redirect = response.redirect;

                            if (response.success && response.data.is_invoiced) {
                                $('#dialog-document-unaward-confirm').dialog({
                                    resizable: false,
                                    height: "auto",
                                    width: 500,
                                    modal: false,
                                    closeOnEscape: false,
                                    open: function(event, ui) {
                                        $(".ui-dialog-titlebar-close").hide();
                                    },
                                    buttons: {
                                        "Yes": function () {
                                            $(this).dialog('close');

                                            $('#dialog-document-unaward-message').dialog({
                                                resizable: false,
                                                height: "auto",
                                                width: 500,
                                                modal: false,
                                                closeOnEscape: false,
                                                open: function(event, ui) {
                                                    $(".ui-dialog-titlebar-close").hide();
                                                },
                                                buttons: {
                                                    "Submit": function () {
                                                        $(this).dialog('close');

                                                        var message = $('#message').text();

                                                        $.ajax({
                                                            url: "<?php echo base_url('admin_review/unaward_review_doc') ?>",
                                                            type: 'get',
                                                            data: { job_id: jobid, bidjob_id: bidjob_id, trans_id: trans_id, proofread_job_id: proofread_job_id, proofread_doc_id: proofread_doc_id, form: $('#notification-form').serialize() },
                                                            success: function (response) {
                                                                window.location.href = redirect;
                                                            }
                                                        });
                                                    },
                                                    "Cancel": function () {
                                                        $(this).dialog('close');
                                                    }
                                                }
                                            });
                                        },
                                        "No": function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });

                                $('#translator-name').text(response.data.translator_name);
                                $('#invoice-due').text('$' + response.data.invoice_amount);

                            } else if (response.success && !response.data.is_invoiced) {
                                $('#dialog-document-unaward-message').dialog({
                                    resizable: false,
                                    height: "auto",
                                    width: 500,
                                    modal: false,
                                    closeOnEscape: false,
                                    open: function(event, ui) {
                                        $(".ui-dialog-titlebar-close").hide();
                                    },
                                    buttons: {
                                        "Submit": function () {
                                            $(this).dialog('close');

                                            var message = $('#message').text();

                                            $.ajax({
                                                url: "<?php echo base_url('admin_review/unaward_review_doc') ?>",
                                                type: 'get',
                                                data: { job_id: jobid, bidjob_id: bidjob_id, trans_id: trans_id, proofread_job_id: proofread_job_id, proofread_doc_id: proofread_doc_id, form: $('#notification-form').serialize() },
                                                success: function (response) {
                                                    window.location.href = redirect;
                                                }
                                            });
                                        },
                                        "Cancel": function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });
                            } else {
                                $('#dialog-document-unaward-error').dialog({
                                    resizable: false,
                                    height: "auto",
                                    width: 500,
                                    modal: false,
                                    closeOnEscape: false,
                                    open: function(event, ui) {
                                        $(".ui-dialog-titlebar-close").hide();
                                    },
                                    buttons: {
                                        "Okay": function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });
                            }
                        }
                    });


                },
                "No": function () {
                    $(this).dialog('close');
                }
            }
        });
    });

    $(document).on('click', '#toggle-award-review-job', function () {
        var id = $(this).data('id');
        var jobid = $(this).data('jobid');
        var trans_id = $(this).data('translator');
        var bidjob_id = $(this).data('bidjob');

        $.ajax({
            url: "<?php echo base_url('admin_review/check_document_to_award') ?>",
            data: { job_id: jobid },
            success: function (response) {
                if (response) {
                    $('#dialog-document-award').dialog({
                        resizable: false,
                        height: "auto",
                        width: 500,
                        modal: false,
                        closeOnEscape: false,
                        open: function(event, ui) {
                            $(".ui-dialog-titlebar-close").hide();
                        },
                        buttons: {
                            'Ok': function () {
                                $(this).dialog('close');
                            }
                        }
                    });
                } else {
                    $('#award-review-job-details').load('<?php echo base_url() ?>admin_review/get/review-job?id='+ id +'&jobid=' + jobid + '&bidjob=' + bidjob_id + '&transid=' + trans_id).dialog({
                        resizable: false,
                        height: "auto",
                        width: 700,
                        modal: false,
                        closeOnEscape: false,
                        open: function(event, ui) {
                            $(".ui-dialog-titlebar-close").hide();
                        },
                        buttons: {
                            "Yes": function () {
                                $('#form-docs').submit();
                            },
                            "No": function () {
                                $(this).dialog('close');
                            }
                        }
                    });
                }
            }
        });
    });

    $(document).on('change', '#toggle-select-all', function (e) {
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });
});
</script>

<script type="text/javascript">
	$(document).ready(function() {

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

<script type="text/javascript">
function alert1(id) {
    del = confirm("Are you sure to delete permanently?");

    if (del != true) {
        return false;
    } else {
        window.location.href="<?php echo base_url(); ?>admin_translator/delete/"+id;
    }
}

function dconfir(id,job_id) {
    con = confirm("Are you sure to cancel this awarded project?");

    if (con!=true) {
        return false;
    } else {
        window.location.href="<?php echo base_url(); ?>admin/awardcupdate/"+id+"/"+job_id;
    }
}

function hiring(id)
{
    con = confirm("Are you sure to end hiring for the job?");
    if (con!=true) {
        return false;
    } else {
        window.location.href="<?php echo base_url(); ?>admin_awardjob/jobcomplete/"+id;
	}
}
</script>

<script type="text/javascript">
function openhiring(id)
{
    con=confirm("Are you sure to open the job again?");
    if (con!=true) {
        return false;
    } else {
        window.location.href="<?php echo base_url(); ?>admin_awardjob/jobopen/"+id;
	}

}
</script>
