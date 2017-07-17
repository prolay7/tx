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
        <li> <a href="#">private job</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
        
         
      
 

      <div class="content-center">
        <div class="proposal_title">Private Job</div>
        
         <?php 
			  if($count_privatejob!='0')
			  {
			  foreach($jobpost as $genfetch)
			  { 
				
				
				$job_id=$genfetch['job_id'];						
			   $sql="select * from `jobpost` where `id`='$job_id' ";
			  $query=$this->db->query($sql);
			   $fetch=$query->row();
			   $language_id=$fetch->language;
				//echo $language_id;
				$pieces = explode("/", $language_id);
				$languagef_id=$pieces[0];
				$sql5="select `name` from `languages` where `id`='$languagef_id'";
				$query5=$this->db->query($sql5);
				$fetch5=$query5->row();
				$languagef_name=$fetch5->name;
				
				$language_id=$pieces[1];
				$sql6="select `name` from `languages` where `id`='$language_id'  ";
				//echo $sql;die;
				$query6=$this->db->query($sql6);
				$fetch6=$query6->row();
				$language_name=$fetch6->name;	
			  
			  
			  ?>
        <div id="job-content-fields">
          <div id="list" class="view_mode">
            <div class="field-container odd box-1">
              
           
              <div class="header-fields">
              
                <?php 
				$date=date("jS F, Y", strtotime($fetch->created));				
				$mon=substr($date,5,3);
				$day=substr($date,0,4);
				?>
                <!--<div class="date"><?php echo $day; ?><span><?php echo $mon; ?></span></div>-->
                <div class="title-company ">
    <div class="title" ><a href="<?php echo base_url().'job/'.$fetch->alias; ?>" ><?php echo $fetch->name; ?></a></div>
                </div>
              </div>
              <div class="body-field">
                <div class="teaser">
                  <p><?php 
				  
				 $des=strlen(strip_tags($fetch->description));
				   if($des>150){
					  echo substr(strip_tags($fetch->description),0,150).'...'; 
					   }
				   else{ 
				  		echo strip_tags(($fetch->description));
						}
						?>
                  </p>
                </div>
              
                <ul class="candidate-meta meta-fields">
                  <li class="pull-left">Job Posted: <span><?php echo $date; ?></span></li>
                  <li class="pull-center">&nbsp;&nbsp;&nbsp;&nbsp;Translate From: <span>
				  <?php echo $languagef_name; ?></span></li>
                  <li class="pull-right">Translate To: <span>
				  <?php echo $language_name;  ?></span></li>
                <!--  <li class="pull-right">Career Level: <span>Mid Career</span></li>-->
                </ul>
                
                </div>
              
          
             
            </div>
           
          </div>     
          
        </div>
            <?php
			  }
			  }
			  else
			  {			 
			  ?>
			 <div class="title" align="center">No Records Found!</div>
             <?php
			  }
			  ?>
              
        <div class="clear"></div>
        <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
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


      
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>
