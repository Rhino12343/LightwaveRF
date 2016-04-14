<?php include_once('user_header.php'); ?>

<?php if (!isset($show_users['show_users'])) { ?>

	<h1>LightwaveRF User View</h1>

	<h4>Please login to access the resources</h4>

	<form id="user_login">
		<p class="errors"></p>
		<input type="text" id="usn" placeholder="Username">
		<input type="password" id="pwd" placeholder="Password">
		<input type="submit" value="Login">
	</form>
<?php } else { ?>
	<script type="text/javascript">
		function loadJQuery(){
			var waitForLoad = function () {
				if (typeof jQuery != "undefined") {
					loader(true);
					window.setTimeout(list_users, 3000);
				} else {
					window.setTimeout(waitForLoad, 500);
				}
			};

			window.setTimeout(waitForLoad, 500);
		}

		window.onload = loadJQuery;
	</script>
<?php } ?>

<?php include_once('user_footer.php'); ?>