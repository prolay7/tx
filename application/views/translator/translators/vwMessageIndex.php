<?php
$this->load->view('vwHeader');
?>
<link rel="stylesheet" href="<?php echo  base_url() ?>includes/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
<div id="content">
  <div id="title">
    <h1 class="inner title-2"> My Profile
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Messages 
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
      <li> <a href="">Messages</a></li>
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
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr> <th class="center">Job Title</th>
                                                 
                                                 <th class="center">Message</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <style type="text/css">
											.order_by_cls {
												display:none;	
											}
											.nonvisible
											{
											display:none !important;	
											}
										</style>
                                    <?php
									//$job_id= $this->uri->segment(3);
									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
									//save the columns names in a array that we will use as filter         
									$options_category = array();
									//echo '<pre>'; print_r($category);
									foreach ($messages as $array) {
									foreach ($array as $key => $value) {
										$options_category[$key] = $key;
									  }
									  break;
									}
							
								    echo form_open('admin/messages/', $attributes);																
									//echo form_label('Search:', 'search_string');
									echo form_input('search_string', $search_string_selected, 'style="width: 170px;
									height: 26px; display:none;"');								
								    //echo form_label('Order by:', 'order');
								echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');									
			          $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm nonvisible', 'value' => 'Go');
								$options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
		               echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');                             	echo form_submit($data_submit);							
                                echo form_close();
                                      
                                      
                                      
            
                                            //echo "<pre>"; print_r($jobprofit);die;
											if ($count_messages!='0')
											{
											//echo '<pre>'; print_r($messages);die;
                                            foreach($messages as $key => $val){ 
											//echo '<pre>'; print_r($val);die;										
											
											$job_id=$val['job_id'];
											$jobsql="select * from `jobpost` where `id`='$job_id'";
											$jobquery=mysql_query($jobsql);
											$jobfetch=mysql_fetch_array($jobquery);
											$job_title=$jobfetch['name'];
											$job_alias=$jobfetch['alias'];
										    ?>
                                            <tr>
                                            <td>
                                              <?php
									$sql="SELECT * FROM `message` WHERE `job_id` = '$job_id' and `type`= '0' and `read`='0'";
									$query=$this->db->query($sql);
									$num=$query->num_rows();
                                            if($num>0){
											?>
              <b><a href="<?php echo base_url(); ?>job/<?php echo $job_alias; ?>"> <?php echo $job_title.'('.$num.')'; ?></a></b>
                                            <?php
                                            }else
                                            {
											?>                                            
                                             <a href="<?php echo base_url(); ?>job/<?php echo $job_alias; ?>"><?php echo $job_title; ?></a>
                                           <?php 
										    }
											?>                                           
                                            </td> 
                                           <td>
                                           <a href="<?php echo base_url(); ?>translator/message/<?php echo $job_id; ?>" class="btn btn-success" >&nbsp;&nbsp;&nbsp; View&nbsp;&nbsp;&nbsp;</a>
                                           </td>                                            
                                           </tr>
                                            <?php
											
											
											}
											} 
											else											
											{ ?>
                                            <tr><td colspan="5" align="center">No Messages Found!</td></tr>
                                            <?php
											
											}
											
                                        ?>
                                     
                                    
                                     </tbody>
                                     </table>
            
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

<script>
    initSample();
</script>

      
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>
