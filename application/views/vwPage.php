<?php
$this->load->view('vwHeader');
$page_alias= $this->uri->segment(2);
$sql="select `title` from `cms` where  `alias` = '$page_alias' ";
$query=$this->db->query($sql);
$fetch=$query->row();
$title=$fetch->title;
?>  
    <?php /*?><div id="title">
    <h1 class="inner title-2"><?php echo $title; ?>
    
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <!--<li> <a href="<?php echo base_url()?>translator/contactinfo">Title</a></li>-->
      </ul>
    </h1>
  </div><?php */?>
  
  <div id="content">
  <div id="title">
    <h1 class="inner title-2"><?php echo $title; ?>
          <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
  		<li> <a href="#"><?php echo $title; ?></a></li>
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
          <h2> <?php echo $title; ?> </h2>
        </div>
        
        <div class=" block-content border box-1 block">
          
       
          <div id="job-content-field">
            <div class="field-container single no_border">
              <div class="body-field">
              
                <div class="teaser">
                  <p> <?php echo $page_content; ?></p>
                </div>
               <!-- <div class="full-body" style="display: block">
                  <p>Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>-->
              </div>
              
                </div>
          </div>
        </div>
                  
             
   
      
			
		

       
      </div>
      
   
      <div class="clear"></div>
     
      
    </div>
  
    
  </div>
  
  
  
  
  
  
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>