<?php
$this->load->view('vwHeader');
$page_alias= $this->uri->segment(2);
$sql="select * from `cms` where  `id` = '2' ";
$query=$this->db->query($sql);
$fetch=$query->row();
$title=$fetch->title;
?>  


<div id="content">
  <div id="title">
    <h1 class="inner title-2">Contact Us
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="#">Contact Us</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
      <div class="content-center" >
          <div class="block field-container odd box-1 hide">  
        <!--<div id="contacts" class="block post-box box-1 contact-address">-->
          <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Contact Us</h2>
          <div class = "block-content" >
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
        
        
        <?php if($this->session->flashdata('success_message')){ ?>
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
		echo form_open('page/contact', $attributes); 
		?>
           
              <div id="about">
                <?php /*?><input title="Your Title" type="text" name="title" class="textfield2" placeholder="Title" onclick="this.value='';" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                
                <input title="Your alias" type="text" name="alias" class="textfield2" placeholder="Alias" onclick="this.value='';" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/><?php */
				
				  $email= $this->session->userdata('email_name');
				
				
				?>
   <label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name<span class='error-label'>*</span></label>
                <input title="Your FirstName" type="text" name="first_name" class="form-control text-input validate[required]" placeholder="First Name"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name<span class='error-label'>*</span></label>
                   <input title="Your LastName" type="text" name="last_name" class="form-control text-inputvalidate[required]" placeholder="Last Name"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class='error-label'>*</span></label> 
                <input title="Your email address" type="text" name="email_address" class="form-control text-input validate[required],custom[email]" placeholder="Email Address" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone Number<span class='error-label'>*</span></label>
                <input title="Your phone" type="text" name="phone" class="form-control  validate[required]" placeholder="Phone Number"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address </label>
                        <textarea class="form-control text-input" id="editor" name="address" placeholder="Address" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"></textarea>
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Your Message<span class='error-label'>*</span></label>
                        <textarea class="form-control text-input validate[required]" id="editor" name="message" placeholder="Your Message" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"></textarea>
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
           <?php echo form_close(); ?>
          </div>
        </div>
            
          </div>
        </div>
      </div>
      <!-- /Content Center --> 
      
      <!-- Content Right -->
 		<div class="content-right" style="width:250px;">
         <div class="clear"></div>
        <div class="heading-l">
          <h2> Contact Us </h2>
        </div>
        <div class="clear"></div>
         <?php
        echo $fetch->content;        
        ?>  
      	</div>
      <!-- /Content Right -->
      
      <div class="clear"></div>
      <!-- Clear Line --> 
      
    </div>
    <!-- /Content Inner --> 
    
  </div>
</div>


    <!--<div id="title">
    <h1 class="inner title-2"><?php echo $title; ?>
    
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <!--<li> <a href="<?php echo base_url()?>translator/contactinfo">Title</a></li>
      </ul>
    </h1>
  </div>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
        <div class="perfect_title">Contact Us </div>
        
        <?php if (validation_errors()!="") { ?>
			 <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo validation_errors(); ?> </p>
            </div>
		<?php } ?>   
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
        
        <?php if($this->session->flashdata('error_message'))
        { ?>
        <div class="alert alert-block alert-danger">	
        <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
        </button>	
        
        <p><?php echo $this->session->flashdata('error_message'); ?></p>
        </div>
        
        <?php 
        } 
        ?>   
        <?php 
		$attributes = array('class' => 'form-registration', 'id'=>'contactus'); 
		echo form_open('page/contact', $attributes); 
		?>
        <div class="col-xs-6">
        
        	
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> First Name <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="first_name" id="first_name"  type="text" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
            
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Last Name <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="last_name" id="last_name"  type="text" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
            
            
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Email<span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="email_address" id="email_address"  type="text" class="form-control col-xs-10 col-sm-5 validate[required],custom[email]" value="" />
                </div>
            </div>
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Phone Number<span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="phone" id="phone"  type="text" class="form-control col-xs-10 col-sm-5 validate[required],custom[integer]" value="" />
                </div>
            </div>
            
            
        	<div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Address </label>
                <div class="col-sm-8">
          <input name="address" id="address"  type="text" class="form-control col-xs-10 col-sm-5 " value="" />
                </div>
            </div>
            
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Your Message<span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <textarea name="message" id="message"  class="form-control col-xs-10 col-sm-5 validate[required]" value=""rows="3"></textarea>
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
                </div>
                
            </div>
            
            
            
           
            
        </div>
        
        <div class="col-xs-6">
        <?php
        echo $fetch->content;        
        ?>    

        </div>
        
        <?php echo form_close(); ?>
        </div>
    </div> 
    </div>--><!-- /.container -->
   
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>

<script>
jQuery(document).ready(function(){
	jQuery("#contactus").validationEngine();
});
</script>

