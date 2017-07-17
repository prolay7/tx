<?php
$this->load->view('admin/includes/vwHeader');
$adminID=$this->session->userdata('admin_id');
?>

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
								<a href="#">Completed Review Job</a>
							</li>
							<li class="active">Completed Review Job List</li>
						</ul><!-- /.breadcrumb -->


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
								Completed Review Job
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Completed Review Job List
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
                                        Results for "Completed Job List"
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 <th class="center">Translator</th>
                                                 <th class="center">Proposal</th>
                                                 <th class="center">Time</th>
                                                 <th class="center">Message</th>
                                                 <th class="center">Price</th>
                                                 <th class="center">Completed Date</th>
                                                <th class="center">Status</th>
                                                <th class="center">Invoice</th>
                                            </tr>
                                        </thead>

                                        <tbody>
								<style type="text/css">
                                .invisible2 {
                                display:none !important;
                                }
                                </style>
                                <?php
                                $attributes= array('class' => 'form-inline reset-margin', 'id' => 'myform');
                                $options_category = array();
                                foreach ($completedjob as $array) {
                                  foreach ($array as $key => $value) {
                                    $options_category[$key] = $key;
                                  }
                                  break;
                                }
                                  echo form_open('admin_review/completed', $attributes);

                                  echo form_label('Search:', 'search_string'); echo '&nbsp;';
                                  //echo form_input('search_string', $search_string_selected, 'style="width:155px;height:30px;"');
								  $datai = array(
                                           'name'        => 'search_string',
										   'placeholder' => 'Enter Job Title/Line Number',
                                           'value'          =>$search_string_selected,
                                           'style'       => 'width:450px;height:30px;'
                                                 );
								  echo form_input($datai);
								  echo '&nbsp;';
                                  echo form_dropdown('order', $options_category, $order, 'class="span2 invisible2"');
                                  $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                                  echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 invisible2"');
                                  $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-info btn-sm', 'value' => 'Search');
                                  echo form_submit($data_submit);
                                  echo '&nbsp;';
                                  echo form_close();
                                  ?>

                                  <button class="btn btn-info btn-reser btn-sm" onClick="reload()">&nbsp;Reset&nbsp;</button>
                                  <div class="clearfix">
                                      <div class="pull-right tableTools-container"></div>
                                  </div>

                                        <?php
											if (count($completedjob)) {
                                                foreach ($completedjob as $key => $val) {
        											$translator_id=$val['trans_id'];
        											$sql="select * from `translator` where `id`='$translator_id'";
        											$query=mysql_query($sql);
        											$fetch=mysql_fetch_array($query);
        											$trans_name=$fetch['first_name'].'&nbsp;'.$fetch['last_name'];

        											$job_id=$val['job_id'];
        											$jobsql="select * from `jobpost` where `id`='$job_id'";
        											$jobquery=mysql_query($jobsql);
        											$jobfetch=mysql_fetch_array($jobquery);
        											$job_title=$jobfetch['name'];
        											$job_alias=$jobfetch['alias'];

                                                    if ($job_id) {
                                                        $sql = "SELECT lineNumberCode FROM jobpost WHERE id = {$job_id}";
                                                        $line_number_code = '';
                                                        $query1 = $this->db->query($sql);
                                                        if ($query1->num_rows()) {
                                                            $row = $query1->row();
                                                            if ($row->lineNumberCode != '') {
                                                                $line_number_code = "&nbsp;/&nbsp;".$row->lineNumberCode;
                                                            } else {
                                                                $line_number_code = '';
                                                            }

                                                        }
                                                    } else {
                                                        $line_number_code = '';
                                                    }
                                            ?>
                                            <tr>
                                            <td><a href="<?php echo base_url(); ?>admin_review/viewsummary/<?php echo $val['job_id']; ?>" target="_blank" ><?php echo $job_title; ?><?php echo $line_number_code ?></a></td>
                                            <td><a href="<?php echo base_url().'admin_translators/edittranslator/'.$val['trans_id']; ?>" target="_blank" ><?php echo $trans_name; ?></a></td>
                                            <td>
                                                <?php
                                                if (strlen($val['proposal'])>75) {
                                                    echo substr($val['proposal'],0,75).'...';
                                                } else {
                                                    echo $val['proposal'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $val['time_need']/1440; ?>&nbsp;Day(s)
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="<?php echo base_url(); ?>chat-box/?bid_id=<?php echo $val['bidjob_id'];?>&job_id=<?php echo $val['job_id'] ?>&trans_id=<?php echo $val['trans_id'];  ?>&type=admin&ciadminId=<?php echo $adminID; ?>" target="_blank">
                                                    <i class="fa fa-envelope"></i>&nbsp;Chat &nbsp;&nbsp;&nbsp;&nbsp;
                                                </a>
                                            </td>
                                            <td>$<?php echo $val['price']; ?></td>
                                            <td><?php echo date('m-d-Y', strtotime($val['complete_date'])); ?></td>
                                            <td>
                                                <?php // echo '<pre>'; print_r($val); echo '</pre>'; ?>
                                                <?php if ($val['stage'] == 3) { ?>
                                                <button  onclick="dconfir(<?php echo $val['bidjob_id']; ?>,<?php echo $val['job_id'];?>,<?php echo $val['proofread_job_award_id']?>)"type="button" class="btn btn-success " aria-haspopup="true" aria-expanded="false">Completed</button>
                                                <?php } else { ?>
                                                <button onclick="confir(<?php echo $val['id']; ?>,<?php echo $val['job_id'];?>)" type="button" class="btn btn-danger " aria-haspopup="true" aria-expanded="false">Working</button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($val['stage'] == 3) { ?>
                                                <a class="btn btn-info" href="<?php echo base_url(); ?>admin_jobpost/reinvoice/<?php echo $val['id']; ?>/<?php echo $val['job_id']; ?>/<?php echo $val['trans_id']; ?>">
                                        &nbsp;          <i class="fa fa-paper-plane"></i>&nbsp; Resend &nbsp;
                                                </a>
                                                <?php } ?>
                                            </td>
                                                <?php
                                                $review_sql= "SELECT *  FROM `review` WHERE `job_id`='".$val['job_id']."' and `translator_id`='".$val['trans_id']."' ";
                                                $review_query=$this->db->query($review_sql);
                                                $review_num=$review_query->num_rows();
                                                ?>
                                          </tr>
                                            <?php
											}
											} else { ?>
                                            <tr><td colspan="10" align="center">No Review Completed Jobs Found!</td></tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>

                                    <?php if ($this->pagination->create_links()) { ?>
                                    <div class="pagination"><?php echo $this->pagination->create_links() ?></div>
                                    <?php }?>


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
	window.location.href="<?php echo base_url(); ?>admin_review/award_complete/"+id+"/"+job_id;
	}

}
</script>
<script type="text/javascript">
function dconfir(id,job_id,proofread_job_award_id)
{
    con = confirm("Are you sure to cancel this Completion of awarded project?");
    if (con != true) {
        return false;
    } else {
	       window.location.href="<?php echo base_url(); ?>admin_review/undo_complete/"+id+"/"+job_id+"/"+proofread_job_award_id;
	}
}
</script>
<script type="text/javascript">
function reload()
{
window.location.href="<?php echo base_url().'admin_review/completed/'?>";
}
</script>
<script>
function goBack() {
    window.history.back();
}
</script>
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>fancybox/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
        $('.give_review').click(function(){
        var translator_id= $(this).attr('id');
		var job_id= $(this).attr('job_id');
		//alert(translator_id);
		//alert(job_id);
        $(".various").fancybox({
        maxWidth	: 800,
        maxHeight	: 600,
        fitToView	: false,
        width		: '70%',
        height		: '70%',
        autoSize	: false,
        closeClick	: false,
        openEffect	: 'none',
        closeEffect	: 'none',
        href        :'<?php echo base_url(); ?>admin_awardjob/review/'+translator_id+'/'+job_id
        });

        });
        });

        </script>

<?php
$this->load->view('admin/includes/vwFooter');
?>
