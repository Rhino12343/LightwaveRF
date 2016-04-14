<h1>Users</h1>
<?php if (isset($user_details) && count($user_details) > 0){
	foreach ($user_details as $user) { ?>
		<div class="row">
			<?php var_dump($user); ?>
		</div>
	<?php }
} else { ?>
	<p>
		There are currently no users available to view.
	</p>
<?php } ?>