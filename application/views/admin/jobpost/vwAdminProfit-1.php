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
								<a href="#">Job Profit</a>
							</li>
							<li class="active">Profit List</li>
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
								Job Profit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Profit List
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
                                        Results for "Job Profit List"
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 <th class="center">Translator</th>
                                                 <!--<th class="center">Proposal</th>
                                                 <th class="center">Time Need</th>-->
                                                 <th class="center">Job Price</th>
                                                  <th class="center">Awarded Price</th>
                                                  <th class="center">Profit</th>
                                                 <!--<th class="center">View File</th>-->
                                                 <!--<th class="center">Awarded Date</th>-->
                                                <!-- <th class="center">Canceled</th>-->
                                              <!--  <th class="center">Completed</th>-->
                                                 <!--<th>Details</th>-->

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
									foreach ($jobprofit as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}

								    echo form_open('admin/jobprofit/', $attributes);
									?>


                                    <div class="form-group nonvisible">
                                    <div class="">
                                    <select name="job_stage" class=" col-sm-2 validate[required]" >
                                    <option value=""> Select Stage </option>

                                    <option value="1" <?php if($stage_selected=='1'){echo 'selected';} ?> >Working</option>
                                    <option value="2" <?php if($stage_selected=='2'){echo 'selected';} ?>>Completed</option>
                                    </select>
                                    </div>
                                    </div>


										<?php
									//echo form_label('Search:', 'search_string');
									echo form_input('search_string', $search_string_selected, 'style="width: 170px;
									height: 26px; display:none;"');


								//echo form_label('Order by:', 'order');
								echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');

							   $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm nonvisible', 'value' => 'Go');

								$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
					echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');
								echo form_submit($data_submit);
								 ?>
       <!-- <a href="<?php base_url().'admin/jobprofit/'?>" ><button class="btn btn-info btn-reser btn-small">Reset</button></a>-->                                <?php


								echo form_close();




                                            //echo "<pre>"; print_r($jobprofit);die;
											if ($count_jobprofit!=0)
											{
											foreach($jobprofit as $key => $val){
											//echo '<pre>'; print_r($val);die;


											$job_id=$val['job_id'];
											$jobsql="select * from `jobpost` where `id`='$job_id'";
											$jobquery=mysql_query($jobsql);
											$jobfetch=mysql_fetch_array($jobquery);
											$job_title=$jobfetch['name'];
											$job_alias=$jobfetch['alias'];
											$job_price=$jobfetch['price'];




                                            ?>
                                            <tr>
                                            <td>


                                            <a href="<?php echo base_url(); ?>admin_jobpost/viewsummary/<?php echo $val['job_id']; ?>" target="_blank" ><?php echo $job_title; ?></a>
                                            </td>
                                            <td>
                                            <?php
                                            $job_id=$val['job_id'];
											$sql1="select * from `bidjob` where `job_id`='$job_id'";
											$query1=mysql_query($sql1);
											while($fetch1=mysql_fetch_array($query1))
											{
											$translator_id=$fetch1['trans_id'];
											$sql="select * from `translator` where `id`='$translator_id'";
											$query=mysql_query($sql);
											$fetch=mysql_fetch_array($query);
											$trans_name=$fetch['first_name'].'&nbsp;'.$fetch['last_name'];
											?>
                                            <a href="<?php echo base_url().'admin/translators/edit/'.$translator_id; ?>" target="_blank" ><?php echo $trans_name; ?></a>,
                                            <?php
											} ?>
                                            </td>
                                           <td>$<?php echo $job_price ;?></td>
                                           <!-- <td>$<?php //echo $val['awarded_price'] ;?></td> -->
                                           <?php
                                           $sql = "SELECT SUM(price) AS total_awarded_job FROM bidjob WHERE awarded = 1 AND job_id = {$job_id}";
                                           $query = mysql_query($sql);
                                           $price = mysql_fetch_array($query);
                                           ?>
                                           <td>$<?php echo $price['total_awarded_job'] ;?> </td>
                                           <td>
                                               $<?php echo $job_price - $price['total_awarded_job'] ?>
                                           </td>
                                          </tr>
                                            <?php


											}
											}
											else
											{ ?>
                                            <tr><td colspan="5" align="center">No Completed Jobs Found!</td></tr>
                                            <?php

											}

                                        ?>

                                     <tr>
                                     <td colspan="5" class="table-header">
                                     <?php
									 $sqlp="select `job_id` from `bidjob` where `stage`='2' group by `job_id`";
									 $queryp=$this->db->query($sqlp);
									 $fetchp=$queryp->result();
									 $total_job_price = 0;
									 foreach($fetchp as $rowp)
									 {
									        $job_id=$rowp->job_id;
									        $sqlpp="select * from `jobpost` where `id`='$job_id'";
											$querypp=mysql_query($sqlpp);
											$fetchpp=mysql_fetch_array($querypp);
											$pricepp=$fetchpp['price'];
											$total_job_price =$total_job_price+$pricepp;
									 }


									 $totalawardpricesql="SELECT SUM(price) as `award` FROM `bidjob` WHERE `stage`='2'";
									 $totalawardpricequery=$this->db->query($totalawardpricesql);
									 $fetchtotalawardprice=$totalawardpricequery->row();
									 $total_awarded_price=$fetchtotalawardprice->award;
									 $total_profit=$total_job_price-$total_awarded_price;

									 echo 'Total Job Price $'.number_format($total_job_price, 2, '.', ',').',';
                                     echo '&nbsp;Total Awarded Price $'.number_format($total_awarded_price, 2, '.', ',').',';
									 if ($total_profit < 0)
										{

										$loss_profit=substr($total_profit,1);
										echo '&nbsp;Total Loss $'.($loss_profit).',';
										$loss_average=$total_profit/$count_jobprofit;
										$loss_avg=substr($loss_average,1);
										echo '&nbsp;Average Loss $'.($loss_avg);
										}
										else
										{
										echo '&nbsp;Total Profit $'.number_format($total_profit, 2, '.', ',').',';

                                        $average_profit = ($total_profit/$count_jobprofit);
										echo '&nbsp;Average Profit $'.number_format($average_profit, 2, '.', ',');
										}

									 ?>
                                     </td>
                                     </tr>

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
