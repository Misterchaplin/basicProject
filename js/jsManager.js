$( document ).ready(function() {
	
	// click sur moyImg
	$(document).on("click", "tr[data-href]", function(){
		alert($(this).data('href'));
		document.location = $(this).data('href');
	});
	
	 
	
});