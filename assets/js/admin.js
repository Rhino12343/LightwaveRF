(function($) {
	$('#admin_login').on('submit', function (e) {
		e.preventDefault();
		var usn = $('#usn').val();
		var pwd = $('#pwd').val();
		$.post("/LightwaveRF/admin/login", {usn: usn, pwd: pwd}, function(response) {
			console.log(response);
		});
	});
})(jQuery);