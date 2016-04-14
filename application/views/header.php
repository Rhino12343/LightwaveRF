<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
		<meta name="description" content="<?php echo $meta_description; ?>">
		<?php
			if (isset($styles) && is_array($styles)) {
				foreach ($styles as $href) { ?>
					<link rel="stylesheet" href="<?php echo $href; ?>">
				<?php }
			}
		?>

		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>
	<body>
		<div id="header">
			<nav>
				<a href='' id="view_users">View Users</a>
				<a href='' id="import_users">Import Users</a>
				<a href='' id="edit_user">Edit User</a>
				<a href='' id="logout">Logout</a>
			</nav>
		</div>
		<div id="content">
