$( document ).ready(function() {
	
	// click sur moyImg
	$(document).on("click", "tr[data-href]", function(){
		document.location = $(this).data('href');
	});
	
	 
	
});