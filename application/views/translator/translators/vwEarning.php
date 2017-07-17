<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">My Profile
     <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
      Earnings
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="#">Earnings</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
       
         <div class="proposal_list">
           <?php
			$sql = "SELECT * FROM invoice as a LEFT join bidjob AS b ON a.trans_id = b.trans_id WHERE  a.payment='1' AND a.trans_id ='" . $this->session->userdata('translator_id') . "' AND  b.id =a.bid_id  "; //GROUP BY a.job_id
			//echo $sql; die;
			$val = $this->db->query($sql);
			$count=$val->num_rows();
			//echo $count; die;
			if($count>0){
			$earning=$val->result_array();	
			//echo $sql; die;?>
  <div class="proposal_title">Earnings</div>
		<div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
          <thead>
            <tr>
              <th>Job Title</th>
              <th>Awarded Price</th> 
               <th>Payment Date</th>
                           
            </tr>
          </thead>
          <tbody>
			
			<?php
            foreach ($earning as $row) {
				//echo '<pre>'; print_r($bidjob);
				echo $row->created;
            ?>  
            <tr>
             
               <?php $sql="select * from jobpost where id='" . $row['job_id'] . "'";
				  $val = $this->db->query($sql);
				  $fetch= $val->row();
				  //echo $fetch->name; ?>
              <td><a href="<?php echo base_url().'job/'.$fetch->alias; ?>"><?php echo $fetch->name; ?></a></td> 
               <td><?php echo $row['price'] ; ?></td>
               <td><?php echo date("jS F, Y", strtotime($row['payment_date'])) ; ?></td>
               
            </tr>
			<?php
            }
            ?>

          </tbody>          
        </table>
      </div>
      <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
          <thead>
            <tr>
              <th>Total Earnings: $<?php echo $results[0]['earning']?></th>
                 <?php if($this->session->flashdata('error'))
            { ?>
                <div class="alert alert-block alert-danger"> 
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                    </button> 
                <p><?php echo $this->session->flashdata('error'); ?></p>
                </div>
            <?php 
            } 
            ?>          
            </tr>
          </thead>
          
        </table>
      </div><!--end of .table-responsive-->
        <?php } else{?>
         <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
          <thead>
            <tr>
              <th>Total Earnings: $0</th>
            </tr>
          </thead>
          
        </table>
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
