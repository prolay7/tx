<?php
$this->load->view('vwHeader');
?>


<div id="content">
  <div id="title">
    <h1 class="inner title-2">Job Details
          <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
     <?php  //echo  $job_id ;die;?>
        <li> <a href="#">Job Details</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner "> 
   
  
 		<?php
				$sqljob="select * from jobpost where id=$job_id";
				 $valjob = $this->db->query($sqljob);
				  $job= $valjob->row();
			?>

      <!-- Content Center -->
     
        
          <div class="heading-l">
          <h2> Job Description </h2>
        </div> <?php //print_r($results); 
		 //echo $job->file;die;
		$string=rtrim($job->file, " "); 
		$view=explode("##",$string);
		array_pop($view);
		//print_r($view);
		$num_of_file= count($view);
		?>      
        <div class=" border box-1">
          <div id="job-content-field">
            <div class="field-container single no_border">
              <div class="header-fields">            
                
                <div class="title-company">
                  <div class="title"><a href="#"> <?php echo $job->name;?></a></div>
                  
                </div>
              </div>
              <div class="body-field">
                
                <div class="teaser">
                  <p><?php echo $job->description;?></p>
                </div>
               <!-- <div class="full-body" style="display: block">
                  <p>Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>-->
              </div>
              <div class="block-fields">
             <div class="block ">
                  <div class="block-content">
                   <?php $sql="select * from languages where id='" . $job->language_from . "'  ORDER BY `name`";
				  $val = $this->db->query($sql);
				  $fetch= $val->row();
				  //echo $fetch1->name; ?>
                    <div class = "tag-field">From  <?php echo  $fetch->name;?></div>
                    <?php $sql="select * from languages where id='" .$job->language . "'";
				  $val = $this->db->query($sql);
				  $fetch= $val->row();
				// echo 
				  ?>
                    <div class = "tag-field">To <?php echo  $fetch->name;?></div>
                    <div class = "tag-field">Job Posted: <?php echo date("jS F, Y", strtotime($job->created));?></div>
                  <?php 
					 for ($i = 0; $i < $num_of_file; $i++){
						 
						 if($view[$i]!="" && file_exists("./uploads/jobpost/".$view[$i])) {
							  $vie = strstr($view[$i], '/');
							 $str = ltrim($vie, '/');
							 if($str == ''){
								 $str = $view[$i];
								 }
						
				?>
                    <div class = "tag-field"><a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $view[$i]; ?>" class="tag-field" target="_blank"><?php echo $str; ?></a></div>
                    <?php } } ?>
                  </div>
                  <!-- Cleaner -->
                  <div class="clear"></div>
                   
                  
                  <!-- /Cleaner --> 
                </div>
              <div class="block ">
                <div class="block-content invisible">
                    <?php 
					 for ($i = 0; $i < $num_of_file; $i++){
						 if($view[$i]!="" && file_exists("./uploads/jobpost/".$view[$i])) {
						
				?>
                    <div class = "tag-field"><a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $view[$i]; ?>" class="tag-field" target="_blank">Download</a></div>
                    <?php } } ?>
                   
                   </div>
                   </div>  
              </div>
              <div class="block-fields">
                
                
              
              <div class="block ">
                <div class="block-content">
                    
                   
                   </div>
                   </div>
                  
              </div>
              <!--<input type="reset" class="btn gray next-btn" value="Login to Proposal">-->
               
            </div>
          </div>
        </div>
        
        <div class="clear"></div>
            <div class="heading-l">
            <h2> Bids On this Job </h2>
            </div>
		
<?php
$sql1 = "SELECT * from bidjob WHERE job_id = '" . $job_id . "' ";
$val1 = $this->db->query($sql1);
$fetch1= $val1->result_array();
//echo'<pre>';print_r($fetch1);
//echo $fetch1[0]['id'];
?>
       
       <div class = "block-content border box-1 block">
  

      <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
          <thead>
            <tr>
              <th>Translator Name</th>
              <th>Time Need</th>
               <th>Price</th>
               <th>Details</th>
              
            </tr>
          </thead>
          <tbody>
          <?php foreach($fetch1 as $fet){ 
		  //echo'<pre>';print_r($fet);
		  
		  ?>
            <tr>
              <?php $sql_trans="select * from translator where id='".$fet['trans_id']."'";
			  $va_trans = $this->db->query($sql_trans); 
			  $fet_trans= $va_trans->row();?>
              
              <td><?php echo  $fet_trans->first_name."&nbsp;".$fet_trans->last_name;?></td>
              <td><?php echo $fet['time_need']/1440 ;?>day(s)</td>
              <td><?php echo $fet['price'] ;?></td>
             	<td><a class="various btn btn-success" data-fancybox-type="iframe" href="<?php echo base_url(); ?>admin_jobpost/viewbiddetails/<?php echo $fet['id']; ?>">View Details</a></td>
            </tr>
            <?php } ?>
          </tbody>          
        </table>
      </div>
      </div>
      
          
        <div class="clear"></div>
            <div class="heading-l">
            <h2> Invitation this Job </h2>
            </div>
		
				<?php
                $sql2 = "SELECT * from send_invitation WHERE job_id = '" . $job_id . "' ";
                $val2 = $this->db->query($sql2);
                $fetch2= $val2->result_array();
               // echo'<pre>';print_r($fetch2);die;
                //echo $fetch1[0]['id'];
                ?>
       
               <div class = "block-content border box-1 block">
          
        
              <div class="table-responsive">
                <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
                
                  <thead>
                    <tr>
                      <th>Translator Name</th>
                      <th>Translator email</th>
                       <th>Invitation Description</th>
                       <th>Date Of Invitation</th>
                       
                      
                    </tr>
                  </thead>
                  <tbody>
              
                  
                  <?php foreach($fetch2 as $fetc){ 
                  //echo'<pre>';print_r($fet);
                  
                  ?>
                    <tr>
							<?php
                            $invite=$fetc['invite_id'] ;
                            $invites=explode(",",$invite);
							//print_r( $invites);
                            $sql=" SELECT * FROM `translator`";
                            $val=$this->db->query($sql);
                            $invite1=$val->result();
                            ?>
						<?php /*?> <?php $sql_trans="select * from translator where id='".$fetc['invite_id']."'";
                        $va_trans = $this->db->query($sql_trans); 
                        $fet_trans= $va_trans->row();?><?php */?>
                        <?php foreach ($invite1 as $inv) 
    { 
	//echo $inv->id;die;
	if(in_array($inv->id, $invites))
	{ ?>
    <td><?php echo $inv->first_name; ?>&nbsp;<?php echo $inv->last_name; ?></td>
    <td><?php echo  $inv->email_address;?></td>
   
                      
                     <!-- <td><?php echo  $fet_trans->first_name."&nbsp;".$fet_trans->last_name;?></td>
                      <td><?php echo  $fet_trans->email_address;?></td>-->
                      
                      <td><?php echo $fetc['description'] ;?></td>
                      <td> <?php echo date("jS F, Y", strtotime($fetc['created']));?> </td>
                       
                    </tr>
                    <?php } ?>
                     <?php 
	} 
	} ?>
                  </tbody>          
                </table>
              </div>
              </div>
          
      
      
      
      </div><!--end of .table-responsive-->
    </div>
      
   
      </div>
      
   
      <div class="clear"></div>
     
      
    </div>
  
    
  </div>
</div>


    </div>

</div>
</div>
<div class="clearfix"></div>

 <div class="clear"></div>
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.pack.js"></script> 
<script type="text/javascript">
	$(document).ready(function() {//alert("hello");
		//$(".fancybox").fancybox();
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

<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>