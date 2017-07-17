<?php
$this->load->view('vwHeader');
?>
<script>
jQuery(document).ready(function(){
	jQuery("#user-changeprofilepicture").validationEngine();
});
</script>

<div id="content">
  <div id="title">
    <h1 class="inner title-2">Job Details
          <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
     <?php    $alias = $this->uri->segment(2); ?>
        <li> <a href="<?php echo base_url()?>job/<?php echo $alias;?>">Job Details</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner blog"> 
   
  
 		<?php
				//$this->load->view('translator/includes/vwSidebar-left');
			?>

      <!-- Content Center -->
     
        
          <div class="heading-l">
          <h2> Job Details </h2>
        </div>
        <div class="row-fluid">
          <div class="page-nav">
            <div class="span3">
              <a class="btn gray jobbtn" href="<?php echo base_url(); ?>jobs">back to listing</a>
            </div>
            <a href="javascript:history.go(-1)" class="btn gray jobbtn">back</a>
          </div>
        </div>
        <div class=" block-content border box-1 block">
          
       
          <div id="job-content-field">
            <div class="field-container single no_border">
              <div class="header-fields">
                <ul class=" pull-right">
                  <li> <a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $results[0]['file']; ?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>View File</a> </li>
                </ul>
                <?php
				$date=date("jS F ,Y", strtotime($results[0]['created']));
				//echo $date;
				$day = substr($date,0,4);
				//echo $year;
				$month= substr($date,5,3);
				//echo $month;
				
				
				 ?>
           		<div class="date"><?php echo $day;?><span><?php echo $month;?></span></div>
                <div class="title-company">
                  <div class="title"><a href="#"> <?php echo $results[0]['name']?></a></div>
                  
                <div class="company">Posted : <?php echo date("jS F ,Y", strtotime($results[0]['created']));?></div>
                </div>
              </div>
              <div class="body-field">
                <div class="row-fluid">
                  
                </div>
                <div class="teaser">
                  <p><?php echo $results[0]['description']?></p>
                </div>
               <!-- <div class="full-body" style="display: block">
                  <p>Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>-->
              </div>
              <div class="block-fields">
              <ul class="candidate-meta meta-fields">
<!--                  <li class="pull-left">Job Price: <span><?php echo $results[0]['price']?>$</span></li>
-->                  <?php $sql="select * from languages where id='" . $results[0]['language'] . "'";
				  $val = $this->db->query($sql);
				  $fetch= $val->row();
				// echo 
				  ?>
                   <li class="pull-left">Language: <span><?php echo  $fetch->name;?></span></li>
                </ul>
                    <!-- Cleaner -->
                    <div class="clear"></div>
                    <!-- /Cleaner --> 
                  </div>
                </div>
          </div>
        </div>
                    <div class="heading-l">
         		 <h2> Bid On Jobs </h2>
       		 </div>
             <?php
			//echo $this->session->userdata('is_awarded');die;
			  ?>
            
      <?php if(!$this->session->userdata('is_translator')){ ?>
			<a href="<?php echo base_url()?>translator/login" class="btn btn-info">Login To Bid </a>
		
	<?php
	  }else {
			
			$sql1 = "SELECT * from bidjob WHERE trans_id = '" . $this->session->userdata('translator_id') . "' AND job_id = '".$results[0]['id']."'";
			$val1 = $this->db->query($sql1);
			$fetch1= $val1->row();
			?>
       <div class=" block-content border box-1 block">
          
       
          <div id="job-content-field">
            <div class="field-container single no_border">
              <div class="header-fields">
                
                <?php
				$date=date("jS F ,Y", strtotime($results[0]['created']));
				//echo $date;
				$day = substr($date,0,4);
				//echo $year;
				$month= substr($date,5,3);
				//echo $month;
				
				
				 ?>
           		
                <div class="title-company">
                  <div class="title">Job Proposal</div>
                  
                <div class="company">Awarded date: <?php echo date("jS F ,Y", strtotime($fetch1->award_date));?></div>
                </div>
              </div>
              <div class="body-field">
                <div class="row-fluid">
                  
                </div>
                <div class="teaser">
                  <p><?php echo $fetch1->proposal ;?></p>
                </div>
            
              </div>
              <div class="block-fields">
             
                    <!-- Cleaner -->
                    <div class="clear"></div>
                    <!-- /Cleaner --> 
                  </div>
                </div>
          </div>
        </div>
       
        <?php 
		} 
         ?>
   
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

<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>