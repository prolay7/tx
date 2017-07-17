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
              <div class="nav-buttons">
                <!--<ul>
                
                  <li class="favorite"><a href="#"></a></li>
                
                </ul>-->
              </div>
              <?php
			 //echo '<pre>'; print_r($bidjob);die; 
			if(count($bidjob)>=1)
			{
			$job_id=$this->uri->segment(3);	
			
			$sql4="update `message` set `read`='1' where `job_id`='$job_id' and `type`='0'";
			$query4=$this->db->query($sql4);
			
			$sql3="select * from jobpost where id ='".$job_id."'";
									$query3=$this->db->query($sql3);
									$fetch3=$query3->row();	
			?>	
			<div class="title-3"><a href="<?php echo base_url().'job/'.$fetch3->alias; ?>"><?php echo $fetch3->name;;?></a></div>
			
			<?php
			foreach($bidjob as $key => $val){
				
			  ?>
              
             <div class="header-fields">
              
                
              <!--  <div class="date"><?php echo $day; ?><span><?php echo $mon; ?></span></div>-->
                <div class="title-company">
             
                
                
    
               
                  <div class="company">Job Posted : <?php echo date("jS F ,Y", strtotime($fetch3->created));?></div>
                </div>
               
              </div>
								<!-- PAGE CONTENT BEGINS -->
                                
                            
                           
                                
								<div class="body-field">
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                  
                                   
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                 
                                         <style type="text/css">
											.order_by_cls {
												display:none;	
											}
											.nonvisible
											{
											display:none;	
											}
										</style>
                                             <div class="teaser">
                                               
											<div class="dialogs">
														<div class="itemdiv dialogdiv">
															<div class="user">
															Admin
															</div>

															<div class="body" >
																<div class="time">
                                                                   Date:<span class="green">
													<?php  echo date('m-d-Y',strtotime($val['created']));?>
                                                                    </span>
																	<i class="ace-icon fa fa-clock-o"></i>
													                
                                                                    <span class="green">
													<?php  echo date('h:i:sa',strtotime($val['created']));?>
                                                                    </span>
																</div>

																<div class="name">
																<?php  echo $val['text'];?>
																</div>
															<!--	<div class="text">
                                                                To:
																<?php  $totrans_id=$val['trans_id'];
                                                                $sql2="select * from `translator` where `id`='$totrans_id'";
                                                                $query2=$this->db->query($sql2);
                                                                $fetch2=$query2->row();
                                                                $toname=$fetch2->first_name.'&nbsp;'.$fetch2->last_name;
                                                               echo $toname;
                                                                ?>
                                                                </div>-->
																<div class="name">
															  <a class="btn btn-info " href="<?php echo base_url(); ?>translator/reply/<?php echo $val['id']; ?>/<?php echo $val['job_id']; ?>/<?php echo $val['trans_id']; ?>"><i class="fa fa-reply"></i> Reply</a>  &nbsp; &nbsp;<?php if($val['file']!="" && file_exists("./uploads/message/".$val['file'])) { ?>
                  <a href="<?php echo base_url(); ?>uploads/message/<?php echo $val['file']; ?>" class="btn btn-info" target="_blank"><i class="icon-only ace-icon fa fa-download"></i>File</a><?php } ?>
																</div>
                                                                
																<!--<div class="tools">
																	<a href="#" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-download"></i>
																	</a>
																</div>-->
															</div>
														</div>	
                                                         			
									</div>
                                    </div>                   <!--<a class="btn btn-info " style="float:right;"href="<?php echo base_url(); ?>translator/reply/<?php echo $val['id']; ?>/<?php echo $val['job_id']; ?>/<?php echo $val['trans_id']; ?>"><i class="fa fa-reply"></i> Reply</a>							
							-->
                                            <?php $id=$val['id'];
                                            $sql="select * from `message` where `reply_id`='$id'  and `trans_id`='$totrans_id'";
											$query=$this->db->query($sql);
											if($query->num_rows()>=1)
											{
											$fetch=$query->result_array();
											foreach($fetch as $row)
											{
											?>	
                                            
                         				<div class="dialogs" style="padding-left:50px;">
														<div class="itemdiv dialogdiv">
															<div class="user">
															<?php
                                                            $trans_id=$row['trans_id'];
                                                            $sql1="select * from `translator` where `id`='$trans_id'";
                                                            $query1=$this->db->query($sql1);
                                                            $fetch1=$query1->row();
                                                            $name=$fetch1->first_name.'&nbsp;'.$fetch1->last_name;
                                                            echo $name;
                                                            ?>
															</div>
                                                   <div class="clearfix">
                                                   <div class="pull-right tableTools-container"></div>
                                                   </div>
                                                   <div class="clearfix">
                                                   <div class="pull-right tableTools-container"></div>
                                                   </div>
                                                   <div class="clearfix">
                                                   <div class="pull-right tableTools-container"></div>
                                                   </div>
															<div class="body" style="margin-top:30px">
																<div class="time">
                                                                   Date:<span class="green">
													<?php  echo date('m-d-Y',strtotime($row['modified']));?>
                                                                    </span>
																	<i class="ace-icon fa fa-clock-o"></i>
													                
                                                                    <span class="green">
																				
											        <?php	echo date('h:i:sa',strtotime($row['modified']));?>
											
                                                                    </span>
																</div>

																<div class="name">
																<?php  echo $row['text'];?>
																</div>
																<div class="text">
                                                                To:Admin
																<div style="float:right;"><?php if($row['file']!="" && file_exists("./uploads/reply/".$row['file'])) { ?>
                  <a href="<?php echo base_url().'uploads/reply/'.$row['file'] ; ?>" class="btn btn-info" target="_blank"><i class="icon-only ace-icon fa fa-download"></i>File</a><?php } ?></div>
                                                                </div>
																
																<!--<div class="tools">
                                                                
                                                                <?php if($row['file']!="" && file_exists("./uploads/reply/".$row['file'])) { ?>
                  <a href="<?php echo base_url().'uploads/reply/'.$row['file'] ; ?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>View File</a><?php } ?>
                                                                <?php if($row['file']!="" && file_exists("./uploads/reply/".$row['file'])) { ?>
					<a target="_blank" href="<?php echo base_url().'uploads/reply/'.$row['file'] ; ?>" class="btn btn-minier btn-info">
																<i class="icon-only ace-icon fa fa-download"></i>
																</a><?php } ?>
																</div>-->
                                                                
															</div>
														</div>											
									                 </div>											
											<?php	
											}
											
											}
											
											?>
                               </div>

								<!-- PAGE CONTENT ENDS -->
                             
                                
						<?php }
						}
						else
						{
					    ?>					
						<div class="title" align="center">No Messages Found!</div>
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

<script>
    initSample();
</script>

      
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>
