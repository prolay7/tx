<?php
$this->load->view('vwHeader');
?>

</script>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">Translator Login
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
        <li> <a href="<?php echo base_url()?>translator/login">Login</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
      <div class="content-center">
        <div class="body">
          <div class="clear"></div>
          <!--<div class="heading-l">
            <h2>Login</h2>
          </div>-->
         <div class="block field-container odd box-1 hide">
        <!-- <div id="contacts" class="block post-box box-1 contact-address">-->
          <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Login</h2>
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
                <p> If you not get any activation email please click on resend button <a href="<?php echo base_url(); ?>artist/resendactivation/<?php echo $translator_id; ?>/<?php echo $hash; ?>" class="btn btn-success"> Resend Activation Mail </a> </p>
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
        
        <?php if($this->session->flashdata('message_success_new')){ ?>
          <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
          <i class="ace-icon fa fa-times"></i>
        </button>
                <p> <?php echo $this->session->flashdata('message_success_new'); ?> </p>
                
            </div>
        <?php } ?>
        
        <?php if($this->session->flashdata('message_error')){ ?>
          <div class="alert alert-block alert-danger">
        <button type="button" class="close" data-dismiss="alert">
          <i class="ace-icon fa fa-times"></i>
        </button>
                <p> <?php echo $this->session->flashdata('message_error'); ?> </p>
            </div>
        <?php } ?>
          <?php 
    $attributes = array('class' => 'form-registration', 'id'=>'login-form'); 
    echo form_open('translator/login', $attributes); 
    ?>
           
              <div id = "about">
              <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Email<span class='error-label'>*</span> </label>
                <input title="Your user name" type="text" name="user_name" class="form-control validate[required],custom[email] text-input" placeholder="Email"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
              <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Password<span class='error-label'>*</span> </label>
                <input title="Your password" type="password" name="pass_word"  class="form-control validate[required] text-input" placeholder="Password"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
             
                
               
              </div>
             
              <div id = "send">
               <button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Submit
           </button> &nbsp; &nbsp;
                <button class="btn btn-info" type="reset" >
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
              </div>
              <div class="col-md-offset-4 col-md-8" style="padding-top:30px;">
                    <a href="<?php echo base_url(); ?>translator/forgotpassword" data-target="#forgot-box" class="btn btn-primary ">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        I forgot my password
                    </a>
                </div>
           <?php echo form_close(); ?>
          </div>
        </div>
            
          </div>
        </div>
        </div>
      </div>
      <!-- /Content Center --> 
      
      <!-- Content Right -->
 <div class="content-right">
    <img src="<?php echo base_url();?>includes/images/loginImage.jpg" alt="Register Image" class="img-responsive">
            </div>
      <!-- /Content Right -->
      
      <div class="clear"></div>
      <!-- Clear Line --> 
      
    </div>
    <!-- /Content Inner --> 
    
  </div>
</div>

<?php /*?><div class="container">

        
        <?php 
    $attributes = array('class' => 'form-login', 'id'=>'artist-login'); 
    echo form_open('translator/login', $attributes); 
    ?>
        <div class="col-md-6">
        
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> 
Email (Username)* </label>
                <div class="col-sm-8">
                    <input name="user_name" id="user_name"  type="text" class="form-control col-xs-10 col-sm-5 validate[required],custom[email]" value="" />
                </div>
            </div>
            
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Password*</label>
                <div class="col-sm-8">
                    <input name="pass_word" id="pass_word"  type="password" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
            
            <div class="clearfix form-actions" style="padding-top:30px;">
                <div class="col-md-offset-4 col-md-8">
                    <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>

                    &nbsp; &nbsp; &nbsp;
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                </div>
                <div class="col-md-offset-4 col-md-8" style="padding-top:30px;">
                    <a href="<?php echo base_url(); ?>translator/forgotpass" data-target="#forgot-box" class="btn btn-primary ">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        I forgot my password
                    </a>
                </div>
            </div>
            
        </div>
        
        <div class="col-md-6">
        </div>
        
        <?php echo form_close(); ?>
        </div><?php */?>
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