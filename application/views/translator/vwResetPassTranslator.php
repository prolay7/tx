<?php
$this->load->view('vwHeader');
?>

<div id="content">
  <div id="title">
    <h1 class="inner title-2">Translator Reset password
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
        <li> <a href="<?php echo base_url()?>translator/forgotpassword">Reset Password</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
      <div class="content-center">
        <div class="block field-container odd box-1 hide">
    <!--    <div id="contacts" class="block post-box box-1 contact-address" style="
    width: 100%;
">
     -->     <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Forgot Password</h2>
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
        <?php }
		  
		  
		   if($this->session->flashdata('success_message')){ ?>
        	<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $this->session->flashdata('success_message'); ?> </p>
                
            </div>
        <?php } ?>
        
        <?php if($this->session->flashdata('error_message')){ ?>
        	<div class="alert alert-block alert-danger">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $this->session->flashdata('error_message'); ?> </p>
            </div>
        <?php } 
		 
		  
		  
		  
		$hash=$this->uri->segment(3);	
		$attributes = array('class' => 'form-login', 'id'=>'artist-forgotpass'); 
		echo form_open('translator/forgotpass/', $attributes);
		?>
           <input name="hash" id="hash" type="hidden"  value="<?php echo $hash; ?>">
           <div id = "about">
           <label class="col-sm-4 control-label no-padding-right" for="form-field-1">New Password<span class='error-label'>*</span> </label>
           <input title="New Password" type="password" name="new_password" class="form-control validate[required] text-input" placeholder="Enter New Password" />                
                
           <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Confirm Password<span class='error-label'>*</span> </label>
           <input title="Confirm Password" type="password" name="confirm_password"  class="form-control validate[required] text-input" placeholder="Enter Confirm Password"  />
                
               
              </div>
             
             
            <div id = "send">                
            <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Submit
            </button>&nbsp; &nbsp;
            <button class="btn btn-info" type="reset" >
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Reset
            </button>
            </div>
               <div class="col-md-offset-4 col-md-8" style="padding-top:30px;">
                    <a href="<?php echo base_url(); ?>translator/login" data-target="#forgot-box" class="forgot-password-link btn btn-primary ">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Back To Login
                    </a>
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
 		<img src="<?php echo base_url();?>includes/images/forgot-password income tax india.gov.in.gif" alt="Register Image" class="img-responsive">
            </div>
      <!-- /Content Right -->
      
      <div class="clear"></div>
      <!-- Clear Line --> 
      
    </div>
    <!-- /Content Inner --> 
    
  </div>
</div>


    </div>

</div>
</div>
<div class="clearfix"></div>



<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>