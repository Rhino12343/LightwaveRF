$ = jQuery;

$('#user_login').on('submit', function (e) {
	loader(true);
	e.preventDefault();
	var usn = $('#usn').val();
	var pwd = $('#pwd').val();

	$.post("/LightwaveRF/show_users/login", {usn: usn, pwd: pwd}, function(response) {
		response = JSON.parse(response);
		if (response.success) {
			list_users();
		} else {
			$('.errors').html(response.errors);
			loader(false);
		}
	});
});

$('body').on('click', '#logout', function(e) {
	e.preventDefault();
	loader(true);
	window.setTimeout(logout, 2000);
});

$('body').on('click', '.view_more_btn', function(e) {
	e.preventDefault();
	$('.' + $(this).data('popup-class')).dialog({
		closeText: 'X',
		width: $(window).width() * 0.5,
		height: $(window).height() * 0.5,
	});
});

function list_users() {
	$.post("/LightwaveRF/show_users/list_users", function(page_content) {
		$('#content').html(JSON.parse(page_content));
		loader(false);
	});
}

function logout() {
	$.post("/LightwaveRF/show_users/logout", function(page_content) {
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
			loader(running)
		});

		$('#orbital2').animate({
			top: newTop1,
			left: newLeft1,
		},10, function() {
			loader(running);
		});
	} else {
		p = 0;
		p_increment = 0.05;
		r = 50;
		$('.spinner').css('display', 'none');
		return;
	}
}