$(function() {
	//Once ALL images are loaded execute function
	$('*').imagesLoaded(function() {

		//Masonry grid effect
		$('#container').masonry({
    		itemSelector: '.item',
    		columnWidth: 240,
    		isFitWidth: true,
    		isAnimated: !Modernizr.csstransitions
  		});
	});
});