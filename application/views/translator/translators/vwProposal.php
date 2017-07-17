<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">My Profile
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
      Proposals 
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="#">Proposals</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
         
         <div class="proposal_list"> <?php if ($count_bidjob!='0')
				{?>
  <div class="proposal_title">Proposals</div>
  <p>These are the jobs that you have Bid on</p>

      <div class="table-responsive">
      
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
          <thead>
            <tr>
              <th style = "width: 120px;">Bid Date</th>
              <th>Job Name</th> 
               <th>Proposal</th>
               <th style = "width: 100px;">Job Status</th>
               <th>View</th>             
            </tr>
          </thead>
          <tbody>
			<?php
            foreach ($bidjob as $row) {
				//echo '<pre>'; print_r($bidjob);
				echo $row->created;
            ?>  
            <tr>
              <td><?php echo date("jS F, Y", strtotime($row['created'])) ; ?></td>
               <?php $sql="select * from jobpost where id='" . $row['job_id'] . "'";
				  $val = $this->db->query($sql);
				  $fetch= $val->row();
				  //echo $fetch->name; ?>
              <td><a href="<?php echo base_url().'job/'.$fetch->id.'/'.$fetch->alias; ?>" target="_blank"><?php echo $fetch->name; ?></a></td>
                <td>
                <?php 
				  
				 $des=strlen($row['proposal']);
				   if($des>100){
					  echo substr($row['proposal'],0,100).'...'; 
					   }
				   else{ 
				  		echo $row['proposal'];
						}
						?>
                  
				
                </td>
                <td>
                  <?php 
                    switch ($row['stage']){
                      case 0: echo "Hiring Open";
                        break;
                      case 1: echo "Hiring Closed";
                        break;
                      default: echo "Hiring Closed";
                        break;  
                    }

                    $row['stage']; 
                  ?>
                </td>
                <td><a href="<?php echo base_url().'job/'.$fetch->id.'/'.$fetch->alias; ?>" target="_blank" class="btn gray next-btn">View </a></td>
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
