<?php
$this->load->view('email/includes/vwHeader');
?>

<div class="container">
Hi, <?php echo $first_name; ?> <?php echo $last_name; ?><br />
    <?php echo $content; ?> 
</div>


<?php
$this->load->view('email/includes/vwFooter');
?>
