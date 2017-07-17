<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">Contact Infoformation
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Edit 
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="<?php echo base_url()?>translator/contactinfo">Contact Infoformation</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
        <table width="100%">
                                        <tbody>
                                        	<tr>
                                                <td colspan="2" style="padding-top:10px;"><strong>Contact Details</strong></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Name</td>
                                                <td><?php echo $results[0]['first_name']?>&nbsp;<?php echo $results[0]['last_name']?></td>
                                            </tr>
                                              <tr>
                                                <td width="30%">OverView</td>
                                                <td><?php echo $results[0]['desc']?></td>
                                            </tr>
                                            <tr>
                                                <td>User Name</td>
                                                <td><?php echo $results[0]['user_name']?></td>
                                            </tr>
                                          	<tr>
                                            <?php if($results[0]['images']!="" && file_exists("./uploads/translator/profile/".$results[0]['images'])) { ?>
                                                <td >User Image</td>
                                                <td class="center" style="max-width: 100px;"> 
                                            <img src="<?php echo base_url(); ?>uploads/translator/profile/<?php echo $results[0]['images']; ?>" class="img-responsive" style="max-width: 100px;"/> <?php }?>
												
												
												</td>
                                            </tr>
                                          
                                            <tr>
                                                <td>Email Address</td>
                                                <td><?php echo $results[0]['email_address']?></td>
                                            </tr>
                                            <tr>
                                                <td>Location</td>
                                                <td><?php echo $results[0]['location']?></td>
                                            </tr>
                                             <?php 
												$sql=" SELECT * FROM `languages`";
												//echo $sql;die;
												$val=$this->db->query($sql);
												$lang=$val->result();
												$arrlanguage = $results[0]['language'];
												$language = explode(",", $arrlanguage);
												//echo '<pre>'; print_r($language);die;
												
											?>
                                           
                                            <tr>
                                                <td>Language Knows</td>
                                                <?php 
												foreach ($lang as $lang1) { if(in_array($lang1->id, $language)){  ?>
                                                <td><?php echo $lang1->name; ?></td>
                                                <?php } } ?>
                                            </tr>
                                           <a href="<?php echo base_url()?>translator/changeprofile" class="btn btn-info" >
                                            <i class="icon-edit"></i> 
                                            Edit
                                            </a> 
                                        </tbody>
                                    </table>
        <!--<div id="contacts" class="block post-box box-1 contact-address">
          <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Edit Profile</h2>
          <div class = "block-content">
                 <?php if (validation_errors()!="") { ?>
			 <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo validation_errors(); ?> </p>
            </div>
		<?php } ?>
        
        <?php if (isset($message_error) && $message_error!="") { ?>
			 <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo $message_error; ?> </p>
            </div>
		<?php } ?>
        
        <?php if (isset($message_success) && $message_success!="") { ?>
			 <div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $message_success; ?> </p>
                
            </div>
		<?php } ?>
        
        
        <?php if($this->session->flashdata('message_success')){ ?>
        	<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $this->session->flashdata('message_success'); ?> </p>
               
            </div>
        <?php } ?>
        
        <?php if($this->session->flashdata('message_error')){ ?>
        	<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $this->session->flashdata('message_error'); ?> </p>
            </div>
        <?php } ?>
          <?php 
		$attributes = array('class' => 'form-registration', 'id'=>'artist-registration'); 
		echo form_open('translator/myprofile', $attributes); 
		?>
           
              <div id = "about">
                <?php /*?><input title="Your Title" type="text" name="title" class="textfield2" placeholder="Title" onclick="this.value='';" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                
                <input title="Your alias" type="text" name="alias" class="textfield2" placeholder="Alias" onclick="this.value='';" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/><?php */?>
                
                  <input title="Your email address" type="email" name="email_address" class="textfield2" placeholder="Email address" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['email_address']; ?>" readonly/>
                  
                <input title="Your FirstName" type="text" name="first_name" class="textfield2" placeholder="FirstName"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['first_name']; ?>"/>
                
                   <input title="Your LastName" type="text" name="last_name" class="textfield2" placeholder="LastName"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['last_name']; ?>"/>
              
                 <input title="Your Location" type="text" name="location" class="textfield2" placeholder="Location"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['location']; ?>"/>
                 
                   <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Select Language  </label>
                   <?php 
                        $sql=" SELECT * FROM `languages` ";
                        $val=$this->db->query($sql);
                        $lang=$val->result();
						$arrlanguage = $results[0]['language'];
						$language = explode(",", $arrlanguage);
						//echo '<pre>'; print_r($language);die;
                        ?>
						<select name="language[]" id="language"  multiple="multiple" class="textfield2">
							<option value="">Select language</option>
								<?php 
							
							foreach ($lang as $lang1) { ?>
							<option value="<?php echo $lang1->id; ?>" <?php if(in_array($lang1->id, $language)) { echo 'selected="selected"'; }?>><?php echo $lang1->name; ?></option>
							<?php }  ?>
						</select>
              </div>
             
              <div id = "send">
             <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Submit
           </button>
                <button class="btn btn-info" type="reset" >
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
              </div>
           <?php echo form_close(); ?>
          </div>
        </div>
            
          </div>
        </div>-->
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
