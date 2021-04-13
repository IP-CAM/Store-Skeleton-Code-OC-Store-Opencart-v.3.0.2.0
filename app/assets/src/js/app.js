import $ from 'jquery';

$(function() {
	$('.js-open-modal').on('click', function(){
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
	});
});
