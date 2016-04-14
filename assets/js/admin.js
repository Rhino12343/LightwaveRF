$ = jQuery;

$('#admin_login').on('submit', function (e) {
	loader(true);
	e.preventDefault();
	var usn = $('#usn').val();
	var pwd = $('#pwd').val();

	$.post("/LightwaveRF/admin/login", {usn: usn, pwd: pwd}, function(response) {
		response = JSON.parse(response);
		if (response.success) {
			list_users();
		} else {
			$('.errors').html(response.errors);
			loader(false);
		}
	});
});

$('#view_users').on('click', function(e) {
	loader(true);
	e.preventDefault();
	list_users();
});

$('#import_users').on('click', function(e) {
	loader(true);
	e.preventDefault();
	import_users();
});

$('#edit_user').on('click', function(e) {
	loader(true);
	e.preventDefault();
	edit_user();
});

$('body').on('click', '#import_continue', function(e) {
	e.preventDefault();
	$.post("/LightwaveRF/admin/import_users", {execute: true}, function(response) {
		data = JSON.parse(response)

		if (data['success']) {
			window.alert("User records have been successfully imported, please click OK to continue");
			list_users();
		} else {
			window.alert("An error occurred please try again. \r\n If this problem persists please contact your system administrator");
		}

		loader(false);
	});
});

$('body').on('click', '#import_cancel', function(e) {
	e.preventDefault();
	loader(true);
	list_users();
});

$('body').on('click', '#logout', function(e) {
	e.preventDefault();
	loader(true);
	logout();
});

$('body').on('click', '.view_more_btn', function(e) {
	e.preventDefault();
	$('.' + $(this).data('popup-class')).dialog({
		closeText: 'X',
		width: $(window).width() * 0.5,
		height: $(window).height() * 0.5,
	});
});

$('body').on('change', '#user_select', function(e) {
	$('.user_update').css('display', 'none');
	$('#user_id_' + $(this).val()).css('display', 'inline-block');
});

$('body').on('submit', '.user_update', function(e) {
	e.preventDefault();
	user_id = $(this).data('user-id');
	$.post("/LightwaveRF/admin/edit_user",
		{
			update: true,
			user_id : user_id,
			name : $('#name_' + user_id).val(),
			username : $('#usn_' + user_id).val(),
			email : $('#email_' + user_id).val(),
			suite : $('#suite_' + user_id).val(),
			street : $('#street_' + user_id).val(),
			city : $('#city_' + user_id).val(),
			zipcode : $('#zipcode_' + user_id).val(),
			phone : $('#phone_' + user_id).val(),
			website : $('#website_' + user_id).val(),
			company_name : $('#company_name_' + user_id).val(),
			catch_phrase : $('#catch_phrase_' + user_id).val(),
			strap_line : $('#strap_line_' + user_id).val()
		},
		function(response) {
			response = JSON.parse(response);
			if (response.success) {
				list_users();
			} else {
				window.alert("An error occurred please try again. \r\n If this problem persists please contact your system administrator");
				loader(false);
			}
		});
});

function list_users() {
	$.post("/LightwaveRF/admin/list_users", function(page_content) {
		$('#content').html(JSON.parse(page_content));
		loader(false);
	});
}

function edit_user() {
	$.post("/LightwaveRF/admin/edit_user", function(page_content) {
		$('#content').html(JSON.parse(page_content));
		loader(false);
	});
}

function import_users() {
	$.post("/LightwaveRF/admin/import_users", function(page_content) {
		$('#content').html(JSON.parse(page_content));
		loader(false);
	});
}

function logout() {
	$.post("/LightwaveRF/admin/logout", function(page_content) {
		loader(false);
		location.reload();
	});
}

var p = 0;
var p_increment = 0.05;
var r = 50;
var running = false;

function loader(_running) {
	running = _running;

	if (running) {
		$('.spinner').css('display', 'block');
		if (r >= 0) {
			p += (p_increment += 0.0001);
		} else {
			p += (p_increment -= 0.0001);
		}

		if (r <= -50) {
			r = 50;
		}

		r -= 0.2;

		var xcenter = $(window).width() / 2;
		var ycenter = $(window).height() / 2;

		var newLeft  = Math.floor(xcenter + (r* Math.cos(p)));
		var newTop   = Math.floor(ycenter + (r * Math.sin(p)));
		var newLeft1 = Math.floor(xcenter + -(r * Math.cos(p)));
		var newTop1  = Math.floor(ycenter + -(r * Math.sin(p)));

		$('#orbital').animate({
			top: newTop,
			left: newLeft,
		}, 10, function() {
			loader()
		});

		$('#orbital2').animate({
			top: newTop1,
			left: newLeft1,
		},10, function() {
			loader();
		});
	} else {
		p = 0;
		p_increment = 0.05;
		r = 100;
		$('.spinner').css('display', 'none');
		return;
	}
}