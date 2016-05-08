// JavaScript Document
	$(document).ready(function() {

		$('#paypal').click(function(){
			$.ajax({
				type: "GET",
				url: "d_order.php",
				data: "do=save",
				cache: false,
				async: false,
				success: function(result) {
                      
				},
				error: function(result) {
					alert("some error occured, please try again later");
				}
			});

		});

	});
