var masonryHidden = false;

$(window).load(function() {
	layout();
	$('body').fadeIn(500);
}).resize(function() {
	layout();
});

function layout() {
	$windowHeight = $(window).height();
	$windowWidth = $(window).width();
	
	$('#slider').height($windowHeight).width($windowWidth * 2);

	if(masonryHidden) {
		$('#slider').css({'margin-left':'-' + $windowWidth + 'px'});
	}

	$('.panel').height($windowHeight).width($windowWidth);
	$('#cover').height($windowHeight);
	$('#back').height($windowHeight);

	$('#content_holder').height($windowHeight).width($windowWidth - 50);
	$('#content_holder').children('object').height($windowHeight).width($windowWidth - 50);
}

$(document).ready(function() {
	$('.item').click(function() {
		var clicked = $(this);

		$('#slider').animate({'margin-left':'-' + $windowWidth + 'px'},
			function() {
		    	masonryHidden = true;

		    	if(clicked.is('.image')) {
		    		$('#content_holder').html('<img id="image" src="' + clicked.attr('data-url') + '" alt="" />');
		    		//alert($('#image').height());
		    		$('#image').css({'margin':-$('#image').height() / 2 +'px 0 0 ' + -$('#image').width() / 2 + 'px'});
		    	}
		    	else if(clicked.is('.video')) {
		    		$('#cover').css({'display':'block'});
		    		$('#content_holder').html('<iframe id="video" width="640" height="360" src="http://www.youtube.com/embed/' + clicked.attr('data-url') + '?&autoplay=1" frameborder="0" allowfullscreen></iframe>');
		    	}
		    	else {
		    		$('#content_holder').html('<object data="' + clicked.attr('data-url') + '"></object>');
		    	}

		    	layout();
  		});
	});
});

$(document).ready(function() {
	$('#back').click(function() {
		$('#slider').animate({'margin-left':'0'},
			function() {
		    	masonryHidden = false;
				$('#content_holder').html('');
				$('#cover').css({'display':'none'});
  		});
	});
});

$(function() {
	$('article').each(function() {
		var found = false;
		var t = $(this).children('p').text();

		for(var x = 0; x < t.length; x++) {
			if(t[x] == '@' && (x == 0 || t[x-1] == ' ')) {
				var c = 0;
				var n = "";
				found = true;

				while(t[x + c] != ' ' && (x + c) != t.length) {
					n += t[x + c];
					c++;
				}
			}

			if(found) {
		    	$(this).children('p').highlight_name(n);
		    } 
		}  	
	});
});

$(function() {
	$('article').each(function() {
		var found = false;
		var t = $(this).children('p').text();

		for(var x = 0; x < t.length; x++) {
			if(t[x] == 'h' && t[x+1] == 't' && t[x+2] == 't' && t[x+3] == 'p' && (x == 0 || t[x-1] == ' ')) {
				var c = 0;
				var n = "";
				found = true;

				while(t[x + c] != ' ' && (x + c) != t.length) {
					n += t[x + c];
					c++;
				}
			}

			if(found) {
		    	$(this).children('p').highlight_link(n);
		    }  	
		}
	});
});

$(document).ready(function() {
	$('#filters li').click(function() {
		$type = $(this).attr('data-type');

		$('.hide').removeClass('hide');
		$('.masonry-brick').addClass('item');

		$('#filters li.selected').removeClass('selected');
		$(this).addClass('selected');

		if($type != "all") {
			$('.item').not("." + $type).removeClass('item').addClass('hide');
		}

        $('#container').masonry({
    		itemSelector: '.item',
    		columnWidth: 240,
    		isFitWidth: true,
    		isAnimated: !Modernizr.csstransitions
		});
	});
});

$(document).ready(function() {
	$('#video').click(function() {
		alert("hi");
		return false;
	});
});