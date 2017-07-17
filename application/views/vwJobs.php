<?php
$this->load->view('vwHeader');
?>

<div id="content">
  <div id="title">
    <h1 class="inner">Total Jobs<span id="jobs-counter">(<?php echo $count_jobpost; ?>)</span>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
        <li> <a href="<?php echo base_url()?>jobs">Job</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
			<?php if($this->session->flashdata('success_message'))
            { ?>
                <div class="alert alert-block alert-success"> 
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                    </button> 
                <p><?php echo $this->session->flashdata('success_message'); ?></p>
                </div>
            <?php 
            } 
            ?>
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Left -->
      <div class="content-left">
        <div id="search-filter" class="block background">
           <?php 
		  $lansql="select * from `languages`";
		  $lanquery=mysql_query($lansql);
		  ?>
          <h2 class="title-1">Search</h2>
          <div class="block-content">
         
         <style type="text/css">
			.order_by_cls {
				display:none !important;	
			}
		</style>
							<?php
                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                $options_category = array();
                foreach ($jobpost as $array) {
					foreach ($array as $key => $value) {
						$options_category[$key] = $key;
					}
					break;
                }
                echo form_open('jobs', $attributes);
				?>
                <input type="text" name="search_string" value="<?php echo $search_string_selected; ?>" placeholder="Search..." />
                <?php									
                //echo form_label('Search:', 'search_string');
                //echo form_input('search_string', $search_string_selected, 'style="width: 170px; height: 26px;"');
                echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');
                $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Go');
                $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');
				?>
                <label>Search By Language</label>
                <div class="form-group">
                <div class="col-sm-9">
                <select name="job_language" class="col-xs-10 col-sm-5 validate[required]" >
                <option value=""> Select Language </option>
                <?php while($lanfetch=mysql_fetch_array($lanquery)) {?>
                <option value="<?php echo $lanfetch['id'];?>" <?php if ($language_selected==$lanfetch['id']){echo 'selected';}?>><?php echo $lanfetch['name'];?></option>
                <?php }?>
			    </select>
                </div>
                </div> 
                
               <div style="padding-top:5px;"> 
                <input type="submit"  value="Search" id="search-job-page-submit"/>              
                <a href="<?php base_url().'jobs'?>" ><button class="btn btn-info btn-reser">Reset</button></a>              
                </div>
               
                
                <?php
                //echo form_submit($data_submit);
                echo form_close();
                ?>
              
              
              
            
            
            
          </div>      
          </div>
          </div>
      <!-- /Content Left --> 
      
      <!-- Content Center -->
      <div class="content-center">
        
        <div class="clear"></div>
        <div class="heading-l">
          <h2> Available Jobs </h2>
        </div>
        <div class="clear"></div>
        <div class="page-top-nav-bar jobpage-nav">
          
         <!-- <div class="page-sorter">
            <div class="sorter-select">
              <select class="select">
                <option selected="selected" value="Sort By">- Sort By -</option>
                <option value="Sort Criterion 1">Sort Criterion 1</option>
                <option value="Sort Criterion 2">Sort Criterion 2</option>
                <option value="Sort Criterion 3">Sort Criterion 3</option>
              </select>
            </div>
          </div>-->
          <!--<div class="pager">
            <ul>
              <li class="prev noactive"><a></a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">6</a></li>
              <li class="next"><a href="#"></a></li>
            </ul>
          </div>-->
        </div>
        <div class="clear"></div>
        <div id="job-content-fields">
          <div id="list" class="view_mode">
            <div class="field-container odd box-1 box-field">
              <div class="nav-buttons">
                <!--<ul>
                
                  <li class="favorite"><a href="#"></a></li>
                
                </ul>-->
              </div>
              <?php 
			  if($jobpost[0]=='')
			  {
			  echo '<p class="no-record">No Records Found!</p>';  
			  }
			  else
			  foreach($jobpost as $genfetch)
			  {
			  ?>
              
              <div class="header-fields">
              
                <?php 
				$date=date("jS F ,Y", strtotime($genfetch['created']));				
				$mon=substr($date,4,4);
				$day=substr($date,0,4);
				?>
                <div class="date"><?php echo $day; ?><span><?php echo $mon; ?></span></div>
                <div class="title-company">
    <div class="title"><a href="<?php echo base_url().'job/'.$genfetch['alias']; ?>"><?php echo $genfetch['name'];?></a></div>
                  
                </div>
               
              </div>
              <div class="body-field">
                <div class="teaser">
                  <p><?php echo $genfetch['description'];?></p>
                </div>
                
                
                
                <div class="buttons-field applybtns">
                  <div class="apply"><a href="#">Apply for This Job</a></div>
                  <div class="full"><a href="#">Apply On MotibU</a></div>
                </div>
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
      
      <div class="clear"></div>
      <!-- Clear Line --> 
      
    </div>
    <!-- /Content Inner --> 
    
  </div>
</div>
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>