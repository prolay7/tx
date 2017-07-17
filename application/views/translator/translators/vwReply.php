<?php
$this->load->view('vwHeader');
?>
<div id="content">
  <div id="title">
    <h1 class="inner title-2">Reply Message
    
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li> <a href="#">Reply Message</a></li>
      </ul>
    </h1>
  </div>
  <div class="inner"> 
    
    <!-- Content Inner -->
    <div class="content-inner"> 
      
      <!-- Content Center -->
         <div class="content-center">
         <div class="block field-container odd box-1 hide">
        <!--<div id="contacts" class="block post-box box-1 contact-address" style="width:80%">-->
          <div class="block-content">
            <div class="block background">
          <h2 class="title-1">Reply Message</h2>
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
		$attributes = array('class' => 'form-registration', 'id'=>'changeprofile','enctype' => 'multipart/form-data'); 
		echo form_open('translator/reply_message', $attributes); 
		?>
           
              <div id = "about">
               <input name="reply_id" id="reply_id"  type="hidden" value="<?php echo $reply_id; ?>">
             <input name="job_id" id="job_id"  type="hidden" value="<?php echo $job_id; ?>">
             <input name="trans_id" id="trans_id"  type="hidden" value="<?php echo $trans_id; ?>">
                
                
                
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Reply<span class="error-label">*</span> </label>
                        <textarea class="form-control text-input validate[required]" id="reply" name="reply" placeholder="Reply" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');"></textarea>
                        
     <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select file(pdf,doc,docx,xls,txt,jpg,jpeg,png,zip): </label>
                        <input class="" id="file" name="file" type="file">      
                        
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


	
        <!-- inline scripts related to this page -->
		
   <!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jqueryn.js"></script>
 <script>
				    $(document).ready(function() {
                    $("#file").change(function (){
					var filename = $('#file').val();
										
					var filename1 = filename.split('.');
					
					var filename2 = filename1.pop();
					
					var ext = filename2.toLowerCase();
					
					//var ext = $('#formID').val().split('.').pop().toLowerCase();
					if($.inArray(ext, ['pdf','doc','xls','docx','txt','jpg','jpeg','png','zip']) == -1) {
						alert('Invalid file format!. Please select pdf,doc,docx,xls,jpg,jpeg,png,zip or txt.');
						$('#file').val('');
					}
					});
				
					});
				
                
       </script>

      
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>
