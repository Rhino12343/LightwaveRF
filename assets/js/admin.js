(function($) {
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

	function list_users() {
		$.post("/LightwaveRF/admin/list_users", function(page_content) {
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

	var p = 0;
	var p_increment = 0.05;
	var r = 100;
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

			if (r <= -100) {
				r = 100;
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
})(jQuery);