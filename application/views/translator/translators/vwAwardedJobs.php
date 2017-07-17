<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">My Profile
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
      My Works 
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="#">My Works </a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
        <div class="clear"></div>
       
        <div class="clear"></div>
        <div class="page-top-nav-bar jobpage-nav">
          

        </div>
        <div class="clear"></div>
        <div id="job-content-fields">
          <div id="list" class="view_mode">
            <div class="field-container odd box-1">
              <div class="nav-buttons">
                <!--<ul>
                
                  <li class="favorite"><a href="#"></a></li>
                
                </ul>-->
              </div>
              <?php
			  
			  if ($count_bidjob!='0'){ 
			  foreach($bidjob as $genfetch)
			  { //echo'<pre>'; print_r($genfetch);
			  ?>
             
              <div class="header-fields">
              
                <?php 
				$date=date("jS F ,Y", strtotime($genfetch['award_date']));				
				$mon=substr($date,5,3);
				$day=substr($date,0,4);
				?>
              <!--  <div class="date"><?php echo $day; ?><span><?php echo $mon; ?></span></div>-->
                <div class="title-company">
                <?php
				$sql="select * from jobpost where id ='".$genfetch['job_id']."'";
				$val = $this->db->query($sql);
				$rows = $val->result_array();
				 ?>
                
                
    <div class="title-3"><a href="<?php echo base_url().'job/'.$rows[0]['alias']; ?>"><?php echo $rows[0]['name'];?></a></div>
               
                  <div class="company">Job Posted : <?php echo date("jS F ,Y", strtotime($rows[0]['created']));?></div>
                </div>
               
              </div>
              <div class="body-field">
                <div class="teaser">
                  
                  <p>Time Needed: <?php echo $genfetch['time_need']/1440; ?>&nbsp;Days </p>
                    
                </div>
                 <div class="title">Job Awarded : <?php echo date("jS F ,Y", strtotime($genfetch['award_date']));?></div>
                
                <?php if($genfetch['stage']==2) {?>
                
                <a href="#" class="btn btn-success">Completed</a>
                
                <?php }else{?>
				 <a href="#" class="btn btn-danger">Working</a>
				
				<?php }?>
              
               <?php  $sql1 = "SELECT * FROM ajax_chat_messages WHERE trans_id = '".$genfetch['trans_id']."'AND job_id ='".$genfetch['job_id']."' AND bid_id = '".$genfetch['id']."' ";
		
		 $val1= $this->db->query($sql1);
		
		
		if($val1->num_rows()>0){
			$fetch1= $val1->row();
			//echo'<pre>';print_r($fetch1);
               ?>
                <a href="<?php echo base_url()?>chat-box/?bid_id=<?php echo $genfetch['id']; ?>&job_id=<?php echo $genfetch['job_id']; ?>&trans_id=<?php echo $genfetch['trans_id']; ?>&type=<?php echo "user"; ?>" target="_blank"  ><span class="chat-ss"><i class="fa fa-envelope"></i></span>
</a>
               
               <?php } ?>
                </div>
              
				<?php
                }} 
                else											
                { ?>
                <div class="body-field">
                <div class="teaser">
                </div>
                <div class="title" align="center">No Records Found!</div>
                </div>
				<?php
                }
                ?>
             
            </div>
           <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
          </div>
          
         
          
        </div>
        
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
<style>
.chat-ss .fa-envelope::before {
    content: "";
    color: #234493;
}
</style>