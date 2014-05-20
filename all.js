$(document).ready(function() {
    $(".loginbtn").click(function(e) {
		e.preventDefault();			//for when JS disabled.
		$("body").append('<div class="overlay"></div>');
		$(".loginpopup").show();
		$(".searchpopup").hide();	//hides the other popup if shown.
		});
	
	$(".close").click(function(e) {
		$(".loginpopup").hide();
		$(".searchpopup").hide();
		$(".overlay").remove();		//or hide.
	});
    
    $(".searchbtn").click(function(e) {
		e.preventDefault();
		$(".searchpopup").show();;
    });

// 	ALL CKEDITOR STUFF HERE:
// 	$( 'textarea#postdata' ).ckeditor();
// 	$( 'textarea#aboutdata' ).ckeditor();
}); 
