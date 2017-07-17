<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery1x.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
        
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo HTTP_JS_PATH; ?>bootstrap.js"></script>

        <!-- page specific plugin scripts -->
		<!--<script src="<?php echo HTTP_JS_PATH; ?>dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>-->

		<!--[if lte IE 8]>
		  <script src="<?php echo HTTP_JS_PATH; ?>excanvas.js"></script>
		<![endif]-->
		<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.custom.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>jquery.ui.touch-punch.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>jquery.easypiechart.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>jquery.sparkline.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>flot/jquery.flot.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>flot/jquery.flot.pie.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>flot/jquery.flot.resize.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.scroller.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.colorpicker.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.fileinput.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.typeahead.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.wysiwyg.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.spinner.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.treeview.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.wizard.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.aside.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.ajax-content.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.touch-drag.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.sidebar.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.submenu-hover.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.widget-box.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.settings.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.settings-rtl.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.settings-skin.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.searchbox-autocomplete.js"></script>

		<!-- Bootstrap DateTime Picker -->
		<script src="<?php echo HTTP_JS_PATH; ?>date-time/bootstrap-datepicker.js"></script>


		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace.onpage-help.css" />
		<link rel="stylesheet" href="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.onpage-help.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.onpage-help.js"></script>
		<!--<script src="<?php echo HTTP_JS_PATH; ?>js/rainbow.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/generic.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/html.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/css.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/javascript.js"></script>-->
        
        
        <div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder"><?php echo SITE_NAME; ?></span>
							Application &copy; 2015-2016
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			PreCounter ();
			//NewCounter(OldCount=0);
			//alert("hello");
			get_fb();
			
		
		}); 
		
		function PreCounter() {		
			$.ajax({
				type: "POST",
				datatype: "html",
				async: true,
				cache: false,
				url: "<?php echo base_url(); ?>" + "admin_messages/count_message",
				success: function (data, textStatus){
					//alert("old counter = "+data);
					NewCounter(data);
				}
			});			
			
		}
			
		function NewCounter(OldCount){
			$.ajax({
				type: "POST",
				datatype: "html",
				async: true,
				cache: false,
				url: "<?php echo base_url(); ?>" + "admin_messages/count_message",
				success: function (data, textStatus){
					//alert("new counter = "+data);
						if (OldCount!=data) {
							get_fb();
							//alert('call fb');
						} else {
							//alert('no call fb');
						}	
						
						setTimeout(function(){NewCounter(data);}, 5000);				
					}
					
			});	
					
		}
			
			
			

		
		function get_fb() {
			//alert('call get fb function');
			
			
				
			//alert("hello");
				$.ajax({
					type: "POST",
					datatype: "json",
					url: "<?php echo base_url(); ?>" + "admin_messages/message",
					success: function (data, textStatus){ 
					var obj = jQuery.parseJSON(data);
					//alert(obj.length);
					
					var notify = '';
					var i = 0;
					$.each(obj, function(index, element) {
						
						i++;
						$('#blue').html(i);
						$('#blue1').html(i);
					
						
						notify = notify.concat('<li><a class="clearfix" href="<?php echo base_url(); ?>chat-box?bid_id='+element.bid_id+'&job_id='+element.job_id+'&trans_id='+element.trans_id+'&type=admin&ciadminId=<?php echo $this->session->userdata('admin_id');?>" >'+element.jobname+'</a></li>');
						$('.notificationMsg').html(notify);
						//setTimeout(function(){get_fb();}, 5000);
						
					});
					
				
					
					
					}
				});
			}
</script> 

<style>
.ace-nav > li > .dropdown-menu{	
	position:absolute;}
</style>
  </body>
</html>