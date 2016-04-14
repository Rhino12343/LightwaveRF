<h1>Edit User</h1>
<?php if (isset($user_details) && count($user_details) > 0) { ?>
	<select id="user_select">
		<option value="-1">-- Please Select --</option>
		<?php foreach ($user_details as $user) { ?>
			<option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
		<?php }?>
	</select>

	<?php foreach ($user_details as $user) { ?>
		<form class="row user_update" id="user_id_<?php echo $user['user_id']; ?>" data-user-id="<?php echo $user['user_id']; ?>">
			<div class="row" >
				Name: <input type="text" id="name_<?php echo $user['user_id']; ?>" value="<?php echo $user['name']; ?>">
			</div>
			<div class="row" >
				Username: <input type="text" id="usn_<?php echo $user['user_id']; ?>" value="<?php echo $user['usn']; ?>">
			</div>
			<div class="row" >
				Email Address:<input type="text" id="email_<?php echo $user['user_id']; ?>" value="<?php echo $user['email']; ?>">
			</div>
			<div class="row" >
				Suite: <input type="text" id="suite_<?php echo $user['user_id']; ?>" value="<?php echo $user['suite']; ?>">
			</div>
			<div class="row" >
				Street: <input type="text" id="street_<?php echo $user['user_id']; ?>" value="<?php echo $user['street']; ?>">
			</div>
			<div class="row" >
				City: <input type="text" id="city_<?php echo $user['user_id']; ?>" value="<?php echo $user['city']; ?>">
			</div>
			<div class="row" >
				Zip Code:<input type="text" id="zipcode_<?php echo $user['user_id']; ?>" value="<?php echo $user['zipcode']; ?>">
			</div>
			<div class="row" >
				Phone No: <input type="text" id="phone_<?php echo $user['user_id']; ?>" value="<?php echo $user['phone']; ?>">
			</div>
			<div class="row" >
				Website: <input type="text" id="website_<?php echo $user['user_id']; ?>" value="<?php echo $user['website']; ?>">
			</div>
			<div class="row" >
				Company Name: <input type="text" id="company_name_<?php echo $user['user_id']; ?>" value="<?php echo $user['company_name']; ?>">
			</div>
			<div class="row" >
				Catch Phrase: <input type="text" id="catch_phrase_<?php echo $user['user_id']; ?>" value="<?php echo $user['catch_phrase']; ?>">
			</div>
			<div class="row" >
				Strap Line: <input type="text" id="strap_line_<?php echo $user['user_id']; ?>" value="<?php echo $user['strap_line']; ?>">
			</div>
			<div class="row">
				<input type="submit" class="save_btn" value="Save">
			</div>
		</form>
	<?php }
} else { ?>
	<p>
		There are currently no users available to view.
	</p>
<?php } ?>
