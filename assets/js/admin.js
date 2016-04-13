(function($) {
	$('#admin_login').on('submit', function (e) {
		e.preventDefault();
		var usn = $('#usn').val();
		var pwd = $('#pwd').val();
		$.post("/LightwaveRF/admin/login", {usn: usn, pwd: pwd}, function(response) {
			response = JSON.parse(response);
			if (response.success) {
				$.post("/LightwaveRF/admin/list_users", function(page_content) {
					$('#content').html(page_content);
				});
			}
		});
	});
})(jQuery);