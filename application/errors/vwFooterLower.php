<div id="copyright">
  <div class="inner">
    <div class="row-fluid"> 
    <?php
    	$sql = "SELECT * FROM settings WHERE id = '1'";
        $val = $this->db->query($sql);
		$fetch= $val->row();
		
       
        
       ?>
        
      <!-- Copyright Text -->
      <div id="copyright-text">Copyright 2015 <a href="<?php echo base_url()?>">Translation</a> | All Rights Reserved | Design by <a href="<?php echo base_url()?>">Translation</a></div>
      <!-- /Copyright Text --> 
      <!-- Copyright Social Link -->
      <div id="copyright-link">
        <div class="buttons">
          <ul class="top_soical_icons pull-right	">
            <li> <a href="<?php echo $fetch->facebook; ?>" target="blank"> <i class="fa fa-facebook"></i> </a> </li>
            <li> <a href="<?php echo $fetch->googlep; ?>" target="blank"> <i class="fa fa-google-plus"></i> </a> </li>
            <li> <a href="<?php echo $fetch->twitter; ?>" target="blank"> <i class="fa fa-twitter"></i> </a> </li>
            <li> <a href="<?php echo $fetch->instagram; ?>" target="blank"> <i class="fa fa-instagram"></i> </a> </li>
            <li> <a href="<?php echo $fetch->printerus; ?>" target="blank"> <i class="fa fa-pinterest"></i> </a> </li>
            <li> <a href="<?php echo $fetch->youtube; ?>" target="blank"> <i class="fa fa-youtube"></i> </a> </li>
          </ul>
        </div>
      </div>
      <!-- /Copyright Social Link --> 
      
      <a class="scrollTop" href="#header" style="display: none;">
      <div id = "up_container"> <span></span> </div>
      </a> </div>
  </div>
</div>
<!-- /Copyright --> 

<!-- /Copyright -->
<link href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/switcher.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/switcher.js"></script>
</body>
</html>