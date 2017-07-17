<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">My Profile
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Message
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="<?php echo base_url()?>translator/chat">Message</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
         
               <div class="block field-container odd box-1 hide">  

        <!--<div id="contacts" class="block post-box box-1 contact-address">-->
          <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Message</h2>
          <div class = "block-content chat_list">
              <ul>
                 <li><?php
                     $trans_id = $this->session->userdata('translator_id');
                         $check = 0;
                     if($jobs->num_rows() > 0){
                         foreach ($jobs->result() as $job) {
                             $chats = $this->db->get_where('ajax_chat_messages',['trans_id' => $trans_id, 'job_id' => $job->job_id,'bid_id' => $job->bid_id,'type' => 'admin','status' => 'unread'])->num_rows();
//	   $sql6 = "SELECT * FROM bidjob WHERE trans_id = '".$trans_id."' ";
//        $val6 = $this->db->query($sql6);
//		$fetch6= $val6->result();
//
//	  foreach($fetch6 as $row){
//		// echo $row->id.'<br>';
//
//		 $sql7 = "SELECT * FROM ajax_chat_messages WHERE trans_id = '".$trans_id."'AND job_id ='".$row->job_id."' AND bid_id = '".$row->id."' ";
//
//		 $val7 = $this->db->query($sql7);
//		$fetch7= $val7->row();
//	  $sql_com = "SELECT * FROM bidjob WHERE trans_id = '".$trans_id."' AND id = '".$row->id."' AND job_id ='".$row->job_id."' AND stage=1";
//        $val_com = $this->db->query($sql_com);
//
//		/* if($val7->num_rows()>0 || $val_com->num_rows()>0){*/
//			 if($val7->num_rows()>0 ){
//			  $sql8 = "SELECT * FROM jobpost WHERE id ='".$row->job_id."'";
//		 $val8 = $this->db->query($sql8);
//		 $fetch8= $val8->row();
//		 //echo $fetch8->name;
//		  $sql9 = "SELECT * FROM ajax_chat_messages WHERE trans_id = '".$trans_id."'AND job_id ='".$row->job_id."' AND bid_id = '".$row->id."' AND type='admin' AND status= 'unread' ";
//		 $val9 = $this->db->query($sql9);
//		//echo $val9->num_rows();

if($chats > 0) {
    $check = 1;
    ?>
    <a href="<?php echo base_url() ?>chat-box/?bid_id=<?php echo $job->bid_id; ?>&job_id=<?php echo $job->job_id; ?>&trans_id=<?php echo $trans_id; ?>&type=<?php echo "user"; ?>"
       target="_blank"
       class="menuclass"></i><?php echo ($job->job_name != '') ? $job->job_name : 'Job Manually Entered/' . $job->lineNumberCode; ?>
        &nbsp; (<?php echo $chats; ?>)</a>
    <!--		 --><?php //}

}
                         }
                     }

                     if($check == 0){ ?>
                         <p class="menuclass">No unread messages</p>

                    <?php }
                     ?></li>
            </ul>  
              
          </div>
        </div>
            
          </div>
        </div>
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
		


      
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>