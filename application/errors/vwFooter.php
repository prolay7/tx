<?php

 		$sql1 = "SELECT * FROM cms WHERE id = '2'";
        $val1 = $this->db->query($sql1);
		$fetch1= $val1->row();
		
		
		$sql2 = "SELECT * FROM cms WHERE id = '3'";
        $val2 = $this->db->query($sql2);
		$fetch2= $val2->row();
		
		
		$sql3 = "SELECT * FROM cms WHERE id = '4'";
        $val3 = $this->db->query($sql3);
		$fetch3= $val3->row();
		
		
		$sql4 = "SELECT * FROM cms WHERE id = '5'";
        $val4 = $this->db->query($sql4);
		$fetch4= $val4->row();
		
		 $sql5 = "SELECT * FROM cms WHERE id = '6'";
        $val5 = $this->db->query($sql5);
		$fetch5= $val5->row();
		
		
    	$sql6 = "SELECT * FROM settings WHERE id = '1'";
        $val6 = $this->db->query($sql6);
		$fetch6= $val6->row();
		
       
     
		
 ?>
<div id="footer">
  <section class="footer-wrapper">
    <section class="row-fluid">
      <section class="inner">
        <div id="site-description">
          <h3><img src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>images/Logo.png" width="205" height="50"  alt=""/></h3>
          <p><?php echo $fetch6->tag_line; ?></p>
        </div>
        <div id="footer-menu">
          <div id="nav-menu" class="footer-menu span3">
            
            <div class="left">
            <h2>Company</h2>
              <ul>
                <li><a href="<?php echo base_url()?>">Home</a></li>
                <li><a href="<?php echo base_url()?>page/<?php echo $fetch1->alias;?>">About</a></li>
                <li><a href="<?php echo base_url()?>page/<?php echo $fetch2->alias;?>">Contact</a></li>         		
              </ul>
            </div>
            
            <div class="right">
            <h2>Informations</h2>
              <ul>                
                <li><a href="<?php echo base_url()?>page/<?php echo $fetch3->alias;?>">Terms and Conditions</a></li>
                <li><a href="<?php echo base_url()?>page/<?php echo $fetch4->alias;?>">Privacy Policy </a></li>
                <li><a href="<?php echo base_url()?>page/<?php echo $fetch5->alias;?>">How It Works </a></li>
              </ul>
            </div>
          </div>
          <div id="fol-menu" class="footer-menu">
              <h2>Follow Us</h2>
              <ul>                
                <li><a href="<?php echo $fetch6->twitter; ?>" target="blank">Twitter</a></li>
                <li><a href="<?php echo $fetch6->facebook; ?>" target="blank">Facebook</a></li>
                <li><a href="<?php echo $fetch6->youtube; ?>" target="blank">Youtube</a></li>
              </ul>
            </div>
         <?php /*?> <div id="fol-menu" class="footer-menu span3">
            <h2>Follow Us</h2>
            <ul>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Youtube</a></li>
            </ul>
          </div>
          <div id="job-menu" class="footer-menu span3">
            <h2>Popular Jobs</h2>
            <ul>
              <li><a href="#">Web Developer</a></li>
              <li><a href="#">Web Designer</a></li>
              <li><a href="#">UX Engineer</a></li>
              <li><a href="#">Account Manager</a></li>
            </ul>
          </div><?php */
		  ?>
        </div>
        <div id="site-descriptionr">
            <h3 class="we_offered">Address</h3>
            <p><?php echo $fetch6->address; ?></p>
            <!--<p>Translation building 2nd floor</p>-->
            <p>Call: <?php echo $fetch6->phone; ?></p>
            <p> Email: <a href="mailto:<?php echo $fetch6->email; ?>"><?php echo $fetch6->email; ?></a></p>
          </div>
      </section>
    </section>
  </section>
</div>
<!-- /Footer -->
<div class="clearfix"></div>
<!-- Copyright -->
