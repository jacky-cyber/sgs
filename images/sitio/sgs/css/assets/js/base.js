
jQuery(document).ready(function($) {

	$('a[rel=external], a[rel=nofollow]').each(function() {
		$(this).attr('target', '_blank');
	});
	
	$('a').each(function() {
	    var href = $(this).attr('href');	    
	    href = (href.indexOf('http') >= 0) ? href : 'http://' + document.location.host + href;

	    if(href == document.location.href) {
	        $(this).addClass('active');
	    }
	});
    

    $('#links div.column').equalHeights();

	$('a img').each(function() {
	    $(this).parent().attr('title', $(this).attr('alt'));
	});
    
    $.featureList($("#news-buttons a"), $("#news-items li"), {transition_interval: 10 * 1000});
    
    $('.search-site input, .chileclic form input').placeHolder();
    
});

(function($) {
    $.fn.placeHolder = function() {
        
        var original = $(this).val();
        
        $(this).focus(function() {
            $(this).val('').addClass('active');
        }).blur(function() {
        
            if($(this).val() == '') $(this).val(original);
            $(this).removeClass('active');
        });
    
    }
})(jQuery);


/**
 * Equal Heights Plugin
 * Equalize the heights of elements. Great for columns or any elements
 * that need to be the same size (floats, etc).
 * 
 * Version 1.0
 * Updated 12/10/2008
 *
 * Copyright (c) 2008 Rob Glazebrook (cssnewbie.com) 
 *
 * Usage: $(object).equalHeights([minHeight], [maxHeight]);
 * 
 * Example 1: $(".cols").equalHeights(); Sets all columns to the same height.
 * Example 2: $(".cols").equalHeights(400); Sets all cols to at least 400px tall.
 * Example 3: $(".cols").equalHeights(100,300); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * 
 */

(function($) {
	$.fn.equalHeights = function(minHeight, maxHeight) {

		tallest = (minHeight) ? minHeight : 0;
		this.each(function() {
			if($(this).height() > tallest) {
				tallest = $(this).height();
			}
		});
		
		if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
		return this.each(function() {
			$(this).height(tallest);
		});
	}
})(jQuery);


var Utils = {

    getParams: function() {
    
        var qstring = document.location.search.substring(1).split('&');
	    var params  = {};
	    
	    for(var i in qstring) {
	        var pair = qstring[i].split('=');
	        params[pair[0]] = decodeURIComponent(pair[1].replace('+', ' '));
	    }
	    
	    return params;
    }

};
