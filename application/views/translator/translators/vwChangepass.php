<?php
$this->load->view('vwHeader');
?>

<div id="content">
  <div id="title">
    <h1 class="inner title-2">My Profile
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Change Password 
    </small>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="<?php echo base_url()?>translator/changeprofile">Change Profile</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
         <div class="block field-container odd box-1 hide">  
       <!-- <div id="contacts" class="block post-box box-1 contact-address">-->
          <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Change Password</h2>
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
		$attributes = array('class' => 'form-registration', 'id'=>'user-registration'); 
		echo form_open('translator/changepassword', $attributes); 
		?>
           
              <div id = "about">
                                 <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Your old password<span class='error-label'>*</span></label>
              
                  <input title="Your old password" type="password" name="old_word" class="form-control text-input validate[required]" placeholder="Your old password" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="" />
                                                   <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Your new password<span class='error-label'>*</span></label>
                <input title="Your new password" type="password" name="pass_word" id="pass_word"class="form-control text-input validate[required]" placeholder="Your new password"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value=""/>
                                                                   <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Confirm new password<span class='error-label'>*</span></label>
                    <input title="Your new confirm password" type="password" name="con_pass_word" class=" form-control  validate[required,equals[pass_word]] text-input" placeholder="Confirm password"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value=""/>
             
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


      
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>