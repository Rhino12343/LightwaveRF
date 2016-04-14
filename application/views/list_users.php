<h1>Users</h1>
<div class="row">
	<div class="name">
		Name
	</div>
	<div class="email">
		Email
	</div>
	<div class="address">
		Address
	</div>
	<div class="view_more">
		View More Details
	</div>
</div>
<?php if (isset($user_details) && count($user_details) > 0){
	foreach ($user_details as $user) { ?>
		<div class="row">
			<div class="name">
				<?php echo $user['name']; ?>
			</div>
			<div class="email">
				<?php echo $user['email']; ?>
			</div>
			<div class="address">
				<div class="suite"><?php echo $user['suite']; ?></div>
				<div class="street"><?php echo $user['street']; ?></div>
				<div class="city"><?php echo $user['city']; ?></div>
				<div class="zipcode"><?php echo $user['zipcode']; ?></div>
			</div>
			<div class="view_more">
				<a href="" class="view_more_btn" data-popup-class="popup<?php echo $user['user_id']; ?>">More Details</a>
				<div class="details popup<?php echo $user['user_id']; ?>" title="More Details">
					<div class="row">
						<div class="phone_no heading">
							Phone No
						</div>
						<div class="website heading">
							Website
						</div>
					</div>
					<div class="row">
						<div class="phone_no">
							<?php echo $user['phone']; ?>
						</div>
						<div class="website">
							<a href="<?php echo $user['website']; ?>"><?php echo $user['website']; ?></a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="catch_phrase heading">
							Catch Phrase
						</div>
						<div class="strap_line heading">
							Strap Line
						</div>
					</div>
					<div class="row">
						<div class="catch_phrase">
							<?php echo $user['catch_phrase']; ?>
						</div>
						<div class="strap_line">
							<?php echo $user['strap_line']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
} else { ?>
	<p>
		There are currently no users available to view.
	</p>
<?php } ?>
