//sticky header
window.onscroll = function() {
	myFunction()
};

var navbar = document.getElementById("fixheader");
var sticky = navbar.offsetTop;

function myFunction() {
	if (window.pageYOffset > sticky) {
		navbar.classList.add("sticky")
	} else {
		navbar.classList.remove("sticky");
	}
}
//
//mobile menu
function openNav() {
	document.getElementById("mySidebar").style.width = "250px";
	$('.overlay').addClass('active');
}

function closeNav() {
	document.getElementById("mySidebar").style.width = "0";

	$('.overlay').removeClass('active');
}

function ipLookUp() {

	$.ajax('http://ip-api.com/json')
		.then(
			function success(response) {
				console.log('User\'s Location Data is ', response);
				console.log('User\'s Country', response.country);

				if (response.country === 'United Kingdom') {
					//console.log('can');
					$('.check_loc').attr('disabled', false);
				} else {
					//console.log('cant');
					if($('.check_loc').length){
						alert("Only locals can book.")
						$('.check_loc').attr('disabled', true);
					}

				}
			},
			function fail(data, status) {
				console.log('Request failed.  Returned status of',
					status);
			}
		);
}

jQuery(document).ready(function() {

	if($('.category_class').length){
		$("select.category_class").change(function(){
	        var selectedCat = $(this).children("option:selected").val();
	        if(selectedCat === "3" ){
						$('#uploadBtn').attr('multiple', 1);
					}else{
						$('#uploadBtn').removeAttr('multiple');
					}
	    });
	}

	if($('#carousel_ID').length){
		$(".carousel-inner div:first-child").addClass("active");
		$(".carousel-indicators li:first-child").addClass("active");

	}

	$('[data-toggle="tooltip"]').tooltip();

	if ($('#availableNumber').length) {
		var val1 = parseInt($("#availableNumber").text());

		var time1 = $("#time_start").text();
		var date1 = moment(time1);
		var date2 = moment();

		var resultText = $("#resultText").text();

		if (val1 == 0) {
			$('#bookBtn').prop('disabled', true);
			alert("No more seats.");
		} else if (resultText) {
			$('#bookBtn').prop('disabled', true);
			alert("Match is over.");
		}else if(date1.diff(date2, 'days') == 0){
			$('#bookBtn').prop('disabled', true);
			alert("You must book ahead of a day.");
		}else if(date1.diff(date2, 'days') <= 0){
			$('#bookBtn').prop('disabled', true);
			alert("The match is over.");
		}else {
			ipLookUp();
		}

		$("#seatNumber").change(function() {
			var val2 = $('#seatNumber').val();
			if (val1 < val2) {
				alert("Not enough seats.");
				$('#bookBtn').attr('disabled', true);
			} else if (val1 => val2) {
				$('#bookBtn').attr('disabled', false);
			}
		});
	}

	if($(".imgChg").length){
		$(".imgChg").each(function( index ) {
			var title = $(this).attr('data-original-title');
			if(title){
				$(this).find('img').addClass("filter-red");
			}

			var str = $(this).attr('href');
			var n = str.includes("medal");
	  	if(n){
				 $(this).find('img').attr("src","assets/images/icon_medal.svg");
			}
		});
	}


});
