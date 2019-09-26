$(document).ready(function() {
	
	// show the dropdown when user-drop is clicked
	$('a.user-drop').on('click', function() {
		$('.user-dropdown').fadeIn(100);
	});

	// disapear when document is clicked

	$(document).on('click', function() {
		$('.user-dropdown').fadeOut(100);
	});

	$('a.user-drop').on('click', function(e) {
		e.stopPropagation();
	});
	$('.user-dropdown').on('click', function(e) {
		e.stopPropagation();
	});

	$("video").hover(function(){
	    $(this).attr('controls', '');
	  }, function(){
	  $(this).removeAttr('controls');
	});

});


