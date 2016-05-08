// JavaScript Document
	$(document).ready(function() {
		var p = document.querySelector(".fb");					   
		p.textContent = p.textContent.replace(/^\s+/mg,"");					   
		// get current rating
		getRating();
		getVotes();
		
		// get rating function
		function getRating(){
			$.ajax({
				type: "GET",
				url: "update.php",
				data: "do=getrate&pid="+id,
				cache: false,
				async: false,
				success: function(result) {
					// apply star rating to element
					$("#current-rating").css({ width: "" + result + "%" });
				},
				
				error: function(result) {
					alert("some error occured, please try again later");
				}
			});
		}
		function getVotes(){
			$.ajax({
				type: "GET",
				url: "update.php",
				data: "do=getvote&pid="+id,
				cache: false,
				async: false,
				success: function(result) {
					// apply vote to element
					$("#votes").html("<br/>"+result+" vote(s)<br/>");
				},
				
				error: function(result) {
					alert("votes error");
				}
			});
		}
		
		
		
			
		
		// link handler
		$('#ratelinks li a').click(function(){
			$.ajax({
				type: "GET",
				url: "update.php",
				data: "rating="+$(this).text()+"&do=rate&pid="+id,
				cache: false,
				async: false,
				success: function(result) {
					// remove #ratelinks element to prevent another rate
					$("#ratelinks").remove();
					// get rating after click
					getRating();
					getVotes();
					
				},
				error: function(result) {
					alert("some error occured, please try again later");
				}
			});
			
		});
	
	});
	