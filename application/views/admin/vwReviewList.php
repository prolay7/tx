<?php
$this->load->view('admin/includes/vwHeader');
?>


		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>


			<?php
				$this->load->view('admin/includes/vwSidebar-left');
			?>


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
								<a href="#">Translator</a>
							</li>
							<li class="active"> List</li>
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
								Translator
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View List
								</small>
							</h1>
						</div><!-- /.page-header -->

                        <?php if ($this->session->flashdata('msg')!="") { ?>
                         <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo $this->session->flashdata('msg'); ?> </p>
                        </div>
                    <?php } ?>
                           <?php if ($this->session->flashdata('wmsg')!="") { ?>
			 <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo $this->session->flashdata('wmsg'); ?> </p>
            </div>
		<?php } ?>



						<div class="row">
							<div class="col-xs-12">

								    <div>
                                    <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Translator Feedback List"
                                    </div>



                               <!-- <style type="text/css">
                                .invisible2 {
                                display:none !important;
                                }
                                </style>
                                <div class="design-form">
                                    <?php
									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
									$options_review= array();
									foreach ($review as $array) {
									foreach ($array as $key => $value) {
										$options_review[$key] = $key;
									  }
									  break;
									}
								    echo form_open('admin/translatorreview/', $attributes);
									echo form_label('Search:', 'search_string');
									echo form_input('search_string', $search_string_selected, 'style="width: 190px;
									height: 26px;"');echo '&nbsp;';
								    echo form_dropdown('order', $options_review, $order, 'class="span2 invisible2"');                                  $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                                  echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1                                  invisible2"');
                                  $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-info btn-sm', 'value' => 'Search');
                                  echo form_submit($data_submit);echo '&nbsp;';
                                  echo form_close();

                                  ?>
                                  </div>
                                <div class="design-reset" ><a  href="<?php echo base_url().'admin/translatorreview';?>" class="btn btn-info btn-reser btn-sm yellow" >Reset</a></div>
                                <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>-->

                                        <div class="row">
                                            <div class="col-xs-12" style="padding-left: 15px; padding-top: 15px;">
                                                <h2><?php echo $translator_name->first_name . ' ' . $translator_name->last_name ?></h2>
                                            </div>
                                            <div class="col-xs-2" style="padding: 5px 15px 15px 15px;">
                                                No. of Jobs Awarded: <?php echo $no_awarded_jobs->awarded ?> projects
                                            </div>
                                            <div class="col-xs-2" style="padding: 5px 15px 15px 15px;">
                                                Average: <?php echo $rating->average_rating ?>
                                            </div>
                                        </div>


                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="center">Job Name</th>
                                                    <th class="center">Rating </th>
                                                    <th class="center">Date Rated</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                        <?php
                                        if (count($review)) {
                                            foreach ($review as $review_row) {
										?>
                                            <tr>
                                                <td>
        										<?php
                                                $job_sql= "SELECT *  FROM `jobpost` WHERE `id`='".$review_row->job_id."'  ";
                                                $job_query=$this->db->query($job_sql);
                                                $job_num=$job_query->num_rows();
                                                if ($job_num>0) {
                                                    $job_fetch=$job_query->row();
                                                    echo  $job_fetch->name;
                                                }
                                                ?>
                                                </td>
                                                <td><?php echo $review_row->rating ?>/10</td>
                                                <td> <?php echo date('jS F Y', strtotime($review_row->date_rated)); ?> </td>
                                            </tr>
                                        <?php
                                            }
										} else {
										?>
                                            <tr>
        										<td colspan='3'> No Result found! </td>
                                            </tr>
                                        <?php
										}
										?>
                                        </tbody>
                                    </table>
                                    </form>
                                    <?php
                                    if ($this->pagination->create_links()) {
                                        echo '<div class="pagination">'.$this->pagination->create_links().'</div>';
                                    }
                                    ?>


                                 </div>
                                <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->


      <?php
$this->load->view('admin/includes/vwFooter');
?>
<script>
function goBack() {
    window.history.back();
}
</script>
