<?php
$this->load->view('vwHeader');
?>
<style>
.transdrop{ width:100% !important;	
}
</style>
<script>
jQuery(document).ready(function(){
	jQuery("#artist-registration").validationEngine();
});
</script>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">Translator Registration
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
        <li> <a href="<?php echo base_url()?>translator/registration">Registration</a></li>
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
          <h2 class="title-1">Please fill out this form</h2>
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
                <p> If you not get any activation email please click on resend button <a href="<?php echo base_url(); ?>translator/resendactivation/<?php echo $translator_id; ?>/<?php echo $hash; ?>" class="btn btn-success"> Resend Activation Mail </a> </p>
            </div>
		<?php } ?>
        
        
        <?php if($this->session->flashdata('message_success')){ ?>
        	<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $this->session->flashdata('message_success'); ?> </p>
                <p> If you not get any activation email please click on resend button <a href="<?php echo base_url(); ?>translator/resendactivation/<?php echo $translator_id; ?>/<?php echo $hash; ?>" class="btn btn-success"> Resend Activation Mail </a> </p>
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
        	<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
                <p> <?php echo $this->session->flashdata('message_error'); ?> </p>
            </div>
        <?php } ?>
          <?php 
		$attributes = array('class' => 'form-registration', 'id'=>'artist-registration'); 
		//echo form_open('translator/registration', $attributes); 
		echo form_open('translator/new_registration'); 
		?>
           
              <div id="about">
              
                <?php /*?><input title="Your Title" type="text" name="title" class="textfield2" placeholder="Title"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                
                <input title="Your alias" type="text" name="alias" class="textfield2" placeholder="Alias"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/><?php */
				
				  $email= $this->session->userdata('email_name');
				$first_name= $this->session->userdata('first_name');
				$last_name= $this->session->userdata('last_name');
				?>
                 <?php if($this->session->userdata('is_invited_translator')){?>
                 <label>First Name*</label>
                <input title="Your FirstName" type="text" name="first_name" id="first_name" class="form-control text-input" placeholder="FirstName" value="<?php echo $first_name;?>"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" readonly/>
                <?php }else {?> 
                <label>First Name*</label>
               <input title="Your FirstName" type="text" name="first_name" id="first_name" class=" form-control text-input validate[required]" placeholder="FirstName"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" readonly/><?php } ?>
                
                
                 
                 <?php if($this->session->userdata('is_invited_translator')){?>
                 <label>Last Name*</label>
                 <input title="Your LastName" type="text" name="last_name" id="last_name" class="form-control text-input" placeholder="LastName" value="<?php echo $last_name;?>"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" readonly/>
                 <?php }else {?>    
                 <label>Last Name*</label> 
                 <input title="Your LastName" type="text" name="last_name" id="last_name" class="form-control text-input validate[required]" placeholder="LastName"   onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" readonly/><?php } ?>
                   
                    
                 <?php if($this->session->userdata('is_invited_translator')){?>
                 <label>Email Address*</label>
			     <input title="Your email address" type="text" name="email_address" id="email_address" class="form-control text-input" placeholder="Email address" value="<?php echo $email;?>" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" readonly/>
			<?php }else {?>  
            
                <label>Email Address*</label>
         <input title="Your email address" type="text" name="email_address" id="email_address" class="form-control text-input validate[required],custom[email]" placeholder="Email address"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active'); " readonly/><?php } ?>
                <label>Choose Password*</label>
                <input title="Your password" type="password" name="pass_word" id="pass_word" class=" form-control text-input validate[required]" placeholder="Password"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" />
                
                
                <label>Confirm Password*</label>
         <input title="Your Confirm password" type="password" name="con_pass_word" id="con_pass_word" class=" form-control text-input validate[required,equals[pass_word]]" placeholder="Confirm password"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                <label>Location: </label>
                <input title="Your Location" type="text" value="<?php echo $location;?>" name="location" id="location" class="form-control text-input" placeholder="Location"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"/>
                
                <input  type="hidden" name="id" value="<?php echo $id; ?>"/>
               
               <?php
$language1=$language;
//echo $id1;exit;
$language2 = explode(",", $language1);
//print_r($language2 );exit;
$language3=explode("/",$language2[1]);
$language4=$language3[0];
//echo $language4;exit;
if($language4!="P")
{
?>

<label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Select Language(Maximum 6)* </label>
             					 <?php 
										/* $sql=" SELECT * FROM `languages` ORDER BY name asc ";
							  			$val=$this->db->query($sql);
							 			 $lang=$val->result_array();
										 //$sub[]=array;
										for($k = 0; $k < count($lang); $k++){
										 $element = $lang[$k];
										 $myArr[$element[id]] = $element[name];
										}
										//echo "<pre>";print_r($myArr);
									
											$newArray = array();
											foreach($myArr as $key1 => $value1){
											 foreach($myArr as $key2 => $value2){
											  if($value1 != $value2){
											   $newkey = $key1.'/'.$key2;
											   $newvalue = $value1.' To '.$value2;
											   $newArray[$newkey] = $newvalue;
											  }
											 }
											}
											//echo '<pre>';
											//print_r($newArray);*/
										 
										?> 
						<!--<select name="language[]" id="language"  multiple="multiple" class="transdrop validate[required,minListOptions[1],maxListOptions[6]]">
							<option value="">Select language</option>
							<?php 
							foreach ($newArray as $key=>$lang1) {
								$inIds = "'".str_replace("/", "','", $lang1)."'";
											$sql_lan="SELECT name FROM `languages` WHERE `name` IN(".$inIds.") ORDER BY name asc";
											$val_lan=$this->db->query($sql_lan);
											$lang=$val_lan->result_array();
											 $lang2=$lang[0]['name'].' to '.$lang[1]['name']; ?>
							<option value="<?php echo $key; ?>" ><?php echo $lang1; ?></option>
						<?php } ?>
						</select>-->
                          <?php 
                        $sql=" SELECT * FROM `languages` ORDER BY `name` ";
                        $val=$this->db->query($sql);
                        $lang=$val->result();
                        ?>
                         <?php for($i = 0; $i < 6; $i++) { $j = $i + 1; ?>
                         
                         
                         
                         
                        <div class="col-sm-6">
                        <div class="form-group">
                        <label class="control-label no-padding-right" for="form-field-1">Translate From <?php echo $j; ?>* </label>                       
                        <select name="language_from<?php echo $j; ?>" id="language_from<?php echo $j; ?>" class="form-control validate[groupRequired[language_from],condRequired[language<?php echo $j; ?>]] " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                        <label class="control-label no-padding-right" for="form-field-1">Translate To <?php echo $j; ?>* </label>
                        <select name="language<?php echo $j; ?>" id="language<?php echo $j; ?>" class="form-control validate[groupRequired[language_to],condRequired[language_from<?php echo $j; ?>]] " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        
                        
                       
                        <?php } ?>  
                         
                       <!-- <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From 2* </label>
                     
                        <div class="col-sm-9">
                        <select name="language_from2" id="language_from2" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To 2* </label>
                       
                        <div class="col-sm-9">
                        <select name="language2" id="language2" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        
                        
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From 3* </label>
                      
                        <div class="col-sm-9">
                        <select name="language_from3" id="language_from3" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To 3* </label>
                     
                        <div class="col-sm-9">
                        <select name="language3" id="language3" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From 4* </label>
                      
                        <div class="col-sm-9">
                        <select name="language_from4" id="language_from4" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To 4* </label>
                    
                        <div class="col-sm-9">
                        <select name="language4" id="language4" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From 5* </label>
                     
                        <div class="col-sm-9">
                        <select name="language_from5" id="language_from5" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To 5* </label>
                     
                        <div class="col-sm-9">
                        <select name="language5" id="language5" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate From 6* </label>
                      
                        <div class="col-sm-9">
                        <select name="language_from6" id="language_from6" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translate To 6* </label>
                       
                        <div class="col-sm-9">
                        <select name="language6" id="language6" class="col-xs-10 col-sm-5 " >
                        <option value=""> Select Language </option>
                        <?php foreach ($lang as $lang1) {
                        ?>
                        <option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                        </div>    --> 
<?php }else{?>



<?php }?>
                
                
                                    
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
 <div class="content-right">
 		<img src="<?php echo base_url();?>includes/images/registration-2015-16.jpg" alt="Register Image" class="img-responsive">
            </div>
      <!-- /Content Right -->
      
      <div class="clear"></div>
      <!-- Clear Line --> 
      
    </div>
    <!-- /Content Inner --> 
    
  </div>
</div>
<div class="main_content">
<div class="b_slider" id="pb">
<?php /*?><div class="container">

    <div class="row">
        <div class="col-md-12">
        

        
         
        
        <?php 
		$attributes = array('class' => 'form-registration', 'id'=>'artist-registration'); 
		echo form_open('translator/registration', $attributes); 
		?>
        <div class="col-md-6">
        
        
        
        
        
       
        	<div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Stage Name <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="title" id="title"  type="text" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
        <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Alias <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="alias" id="alias"  type="text" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
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
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Email (Username)<span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="email_address" id="email_address"  type="text" class="form-control col-xs-10 col-sm-5 validate[required],custom[email]" value="" />
                </div>
            </div>
            
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Password <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="pass_word" id="pass_word"  type="password" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
            
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Confirm Password <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="con_pass_word" id="con_pass_word"  type="password" class="form-control col-xs-10 col-sm-5 validate[required,equals[pass_word]]" value="" />
                </div>
            </div>
            
            
           
            
        </div>
        
        <div class="col-md-6">
        
        	<div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Location <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    <input name="location" id="location"  type="text" class="form-control col-xs-10 col-sm-5 validate[required]" value="" />
                </div>
            </div>
            
           
            <div class="form-group" style="padding-top:30px;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Select Language <span class="rq-fld">*</span> </label>
                <div class="col-sm-8">
                    
						<?php 
                        $sql=" SELECT * FROM `languages` ";
                        $val=$this->db->query($sql);
                        $lang=$val->result();
                        ?>
						<select name="language[]" id="language" class="form-control col-xs-10 col-sm-5 validate[required]" multiple="multiple" size="11">
							<option value="">Select language</option>
							<?php 
							
							foreach ($lang as $lang1) { ?>
							<option value="<?php echo $lang1->id; ?>" ><?php echo $lang1->name; ?></option>
						<?php } ?>
						</select>
                </div>
            </div>

        </div>
     <div class="col-md-6"><div class="clearfix form-actions" style="padding-top:30px;">
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
            </div></div>
        
        <?php echo form_close(); ?>
        </div>
    </div>

</div><?php */?>
</div>
<div class="clearfix"></div>
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