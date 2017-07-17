<?php
$this->load->view('email/includes/vwHeader');
?>
<div class="container">
Hi, <?php echo $first_name; ?> <?php echo $last_name; ?><br />
	Your Password successfully changed.<br />
    Your Username : <?php echo $username; ?> and Password <?php echo $password; ?>
    <a href="http://www.demand-ingtalent.co.uk/user/login"> Click Here login</a>
</div>
<?php
$this->load->view('email/includes/vwFooter');
?>