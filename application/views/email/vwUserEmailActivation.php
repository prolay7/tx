<?php
$this->load->view('email/includes/vwHeader');
?>

<div class="container">
Hi, <?php echo $first_name; ?> <?php echo $last_name; ?>
	Please click on the link to active your account
    <a href="<?php echo base_url(); ?>user/verify/<?php echo $user_id; ?>/<?php echo $hash; ?>"> Click Here </a>
</div>

<?php
$this->load->view('email/includes/vwFooter');
?>