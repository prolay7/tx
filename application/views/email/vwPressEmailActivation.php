<?php
$this->load->view('email/includes/vwHeader');
?>
<div class="container">
Hi, <?php echo $first_name; ?> <?php echo $last_name; ?>
	Please click the below link for active your account
    <a href="<?php echo base_url(); ?>frontend_press/verify/<?php echo $press_id; ?>/<?php echo $hash; ?>"> Click Here </a>
</div>

<?php
$this->load->view('email/includes/vwFooter');
?>