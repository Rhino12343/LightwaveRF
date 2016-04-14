<?php include_once('header.php'); ?>

<?php if (!isset($user_details['user_details'])) { ?>

	<h1>LightwaveRF Admin</h1>

	<h4>Please login to access the resources</h4>

	<form id="admin_login">
		<p class="errors"></p>
		<input type="text" id="usn" placeholder="Username">
		<input type="password" id="pwd" placeholder="Password">
		<input type="submit" value="Login">
	</form>
<?php } else { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			loader(true);
			list_users();
		});
	</script>
<?php } ?>

<?php include_once('footer.php'); ?>