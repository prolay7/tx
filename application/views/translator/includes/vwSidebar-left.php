<div id="sidebar" class="sidebar responsive">
				<!--<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				<script type="text/javascript">
                jQuery(document).ready(function() { 
                jQuery(".a").click(function(){
                jQuery(".a").removeClass("active");
                jQuery(this).addClass("active");
                });
                });
                </script>-->
				<!--<div class="sidebar-shortcuts" id="sidebar-shortcuts">
                
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
                    
				</div>-->
                
                <!-- /.sidebar-shortcuts -->
                <script type="text/javascript">
 /*menu handler*/
 $(function(){
  var url = window.location.pathname;
  var activePage = stripTrailingSlash(url);
  $('.menuclass').parent().removeClass('active'); 
  $('.menuclass').each(function(){  
   var currentPage = stripTrailingSlash($(this).attr('href'));
   
   if (activePage == currentPage) {
    jQuery(this).parent().addClass('active'); 
   } 
  });
     function stripTrailingSlash(str) {
         if(str) {
             var resultArr = str.split('/');
             if (resultArr[resultArr.length - 1] == '') {
                 var str = resultArr[resultArr.length - 2];
             } else {
                 var str = resultArr[resultArr.length - 1];
             }
             return str;
         }
     }
 });
</script>
<!--  <script type="text/javascript">
		jQuery(document).ready(function(){
			get_not();
		
		});
		function get_not() {
				//alert("hello");
				$.ajax({
					type: "POST",
					url: "<?php// echo base_url(); ?>" + "translator/notification",
					success: function (data, textStatus){  
					//alert(data);
					setTimeout(function(){get_not();}, 5000);
					//jQuery('#university').html(data);
					$('#blue').html(data);
					//alert(data);
					}
				});
			}
</script> 
--> 
			<div class = "box-1">
				<div id = "inbox" style = "padding: 15px;">
					<h5 style = "padding-bottom: 10px; font-weight: bold; border-bottom: 1px solid #ccc; margin-bottom: 20px;">Inbox</h5>
					<ul>
						<li><a href = "<?php echo base_url(); ?>translator/chat">Messages <span class = "pull-right" id="total_messages">(<?php echo $totalUnreadMessages; ?>)</span></a></li>
						<li><a href = "<?php echo base_url(); ?>translator/notifications">Notifications <span class = "pull-right" id="total_notifications">(<?php echo $totalnotifications; ?>)</span></a></li>
						<li><a href = "<?php echo base_url(); ?>translator/privatejob">Invites <span class = "pull-right">()</span></a></li>
					</ul>
				</div>
			</div>
     
       <!--form action="" method="POST">
        <button class="btn btn-danger" style="width: 100%; margin-bottom: 20px;" id="del_acc" type="submit">Deactivate My Account</button>
        </form-->
				
                <div id="about-us-navigation" class="box-1">
          <div class="a">
            <ul>
            
              <li class="active"><a href="<?php echo base_url(); ?>translator/dashboard" class="menuclass">Dashboard</a></li>
              <li><a href="<?php echo base_url(); ?>translator/changeprofile" class="menuclass">Edit Profile</a></li>
              <li><a href="<?php echo base_url(); ?>translator/changeprofilepicture" class="menuclass"> Profile Picture</a></li>
              <li><a href="<?php echo base_url(); ?>translator/changepassword" class="menuclass">Change Password </a></li>
           <!--   <li><a href="<?php echo base_url(); ?>translator/message" class="menuclass"> Messages</a></li>-->
              
              <!--
              <li><a href="<?php echo base_url(); ?>translator/chat" class="menuclass">Messages</a></li>
              -->
               <li><a href="<?php echo base_url(); ?>translator/proposal" class="menuclass">Proposals</a></li>
              <!--
              <li><a href="<?php echo base_url(); ?>translator/award" class="menuclass">My Works</a></li>
              -->
           <!--   <li><a href="<?php echo base_url(); ?>translator/working" class="menuclass"> Working Jobs</a></li>-->
             <!-- <li><a href="<?php echo base_url(); ?>translator/earning" class="menuclass"> Earning</a></li>-->
               <li><a href="<?php echo base_url(); ?>translator/invoice" class="menuclass"> Invoice</a></li>
              <li><a href="<?php echo base_url(); ?>translator/paypal" class="menuclass">Paypal Info</a></li>
               <!--<li><a href="<?php echo base_url(); ?>translator/privatejob" class="menuclass">Invited Job</a></li>-->
               <li><a href="<?php echo base_url(); ?>translator/reviewlist" class="menuclass">Feedback List</a></li>
              <li><a href="<?php echo base_url(); ?>translator/logout" class="menuclass"> Logout</a></li>
            </ul>
          </div>
        </div>
                
                
			<!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize 
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>-->

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}

					$(document).ready(function () {
                        setInterval(function () {
                            $.ajax({
                                type:"POST",
                                url:"<?php echo base_url().'translator/update_inbox'?>",
                                dataType:'json',
                                success:function (data) {
                                    if(data.res === 1){
                                  $("#total_messages").html('(' + data.messages + ')');
                                  $("#total_notifications").html('(' + data.notifications + ')');
                                    }else{
                                        return false;
                                    }
                                },
                                error:function (data) {
                                    return false;
                                }
                            })
                        },1000);

                        $('#del_acc').click(function(){
                            var m=confirm('Do you want to deactivate your account?');
                            if(m==true){
                              $.ajax({
                                  type:'POST',
                                  url:'<?php echo base_url().'translator/block_me'?>',
                                  success:function(data){
                                    console.log(data);
                                    json=$.parseJSON(data);
                                    if(json.hasOwnProperty('redirect')){
                                      window.location.href=json.redirect;
                                    } else if(json.hasOwnProperty('error')){
                                        alert(json.error);
                                    } else if(json.hasOwnProperty('warning')){
                                        alert(json.warning);
                                    }
                                  }
                              });
                            } else{
                              return false;
                            }
                        });
                    });
				</script>
			</div>