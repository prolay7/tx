<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">My Profile
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
      Reviews
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="#">Feedbacks</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner">

    <!-- Content Inner -->
    <div class="content-inner">

      <!-- Content Center -->
         <div class="content-center">

         <div class="proposal_list"> <?php if ($count_review!='0')
				{?>
  <div class="proposal_title">Feedbacks</div>
      <div class="table-responsive">
          <h2><?php echo $translator->first_name . ' ' . $translator->last_name ?></h2>
          <table class="table table-hover">
              <tr>
                  <td>No. projects: <?php echo $no_awarded_jobs->awarded ?></td>
                  <td>Average rating: <?php echo $rating->average_rating ?></td>
              </tr>
        </table>
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">

          <thead>
            <tr>
              <th>Job Name</th>
              <th>Rating</th>
               <th>Date Rated</th>
            </tr>
          </thead>
          <tbody>
			<?php
			//echo '<pre>';print_r($review);die;
            foreach ($review as $review_row) {
            ?>
            <tr>
              <td>
				<?php
                $job_sql= "SELECT *  FROM `jobpost` WHERE `id`='".$review_row->job_id."'  ";
                $job_query=$this->db->query($job_sql);
                $job_num=$job_query->num_rows();
				if($job_num>0){
				$job_fetch=$job_query->row();
				if(empty($job_fetch->name)) {
					echo $job_fetch->lineNumberCode; 
				} else {
					echo  $job_fetch->name;
				}
			    
			    
				}
			   ?>
              </td>
              <td><?php echo $review_row->rating ?>/10</td>
              <td>
              <?php echo date('jS F Y',strtotime($review_row->date_rated)); ?>
              </td>
            </tr>
			<?php
            }
            ?>

          </tbody>
        </table>
      </div>
      <!--end of .table-responsive-->
      <?php } else{?>
         <div class="body-field">
                <div class="teaser">
                </div>
                <div class="title" align="center">No Records Found!</div>
                </div>
				<?php
                }
                ?>
    </div>

        <div class="clear"></div>

        <div class="clear"></div>
        <div class="page-top-nav-bar jobpage-nav">


        </div>
        <div class="clear"></div>

        <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
        <div class="clear"></div>

      </div>
      <!-- /Content Center -->

      <!-- Content Right -->
       <div class="content-right">
 		<?php
				$this->load->view('translator/includes/vwSidebar-left');
		?>
            </div>
      <!-- /Content Right -->

      <div class="clear"></div>
      <!-- Clear Line -->

    </div>
    <!-- /Content Inner -->

  </div>
</div>



        <!-- inline scripts related to this page -->

   <!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>


<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>
