/**
 * File stache.js.
 *
 * Contains shit to make the theme do awesome stuff. (enqueue to min file genius)
 *
 */

/*==============================
=            LOADER            =
==============================*/

(function(){

	function id(v){ return document.getElementById(v); }
	function loadbar() {
		var ovrl = id("loader"),
			prog = id("progress"),
			stat = id("progstat"),
			img = document.images,
			c = 0,
			tot = img.length;
		if(tot == 0) return doneLoading();

		function imgLoaded(){
			c += 1;
			var perc = ((100/tot*c) << 0) +"%";
			prog.style.width = perc;
			stat.innerHTML = "Loading "+ perc;
			if(c===tot) return doneLoading();
		}
		function doneLoading(){
			ovrl.style.opacity = 0;
			setTimeout(function(){ 
				ovrl.style.display = "none";
			}, 1200);
		}
		for(var i=0; i<tot; i++) {
			var tImg     = new Image();
			tImg.onload  = imgLoaded;
			tImg.onerror = imgLoaded;
			tImg.src     = img[i].src;
		}
	}
	document.addEventListener('DOMContentLoaded', loadbar, false);

})(jQuery);

/*===============================
=            HEADER             =
===============================*/

(function($) {

	var $document = $(document),
	$element = $('#masthead'),
	className = 'scrolled';

	$document.scroll(function() {
		$element.toggleClass(className, $document.scrollTop() >= 10);
	});

})(jQuery);


/*===================================
=            ORIENTATION            =
===================================*/

jQuery(window).on("orientationchange",function($){
	if(window.orientation == 0) // Portrait
	{
		$('#turnme').removeClass('show');
		$('body').removeClass('disablescroll');
	}
	else // Landscape
	{
		$('#turnme').addClass('show');
		$('body').addClass('disablescroll');
	}
});

/*==============================
=            SLIDER            =
==============================*/

(function($) {

	$('.brandicons').slick({
		infinite: 		true,
		slidesToShow: 	8,
		speed: 			300,
		dots: 			false,
		arrows: 		false,
		slidesToScroll: 1,
		autoplay: 		true,
		autoplaySpeed: 	3000,

		responsive: [
			{
				breakpoint: 		1024,
				settings: {
					slidesToShow: 	8,
					slidesToScroll: 8,
					infinite: 		true,
					dots: 			true
				}
			},
			{
				breakpoint: 		600,
				settings: {
					slidesToShow: 	4,
					slidesToScroll: 4
				}
			},
			{
				breakpoint: 		480,
				settings: {
					unslick: 		true,
				}
			}
		]
		// You can unslick at a given breakpoint now by adding:
		// settings: "unslick"
		// instead of a settings object
	});

})(jQuery);

/*===============================
=            MASONRY            =
===============================*/

(function($) {

	var $grid = $('.grid').imagesLoaded( function() {
		// init Masonry after all images have loaded
		$grid.masonry({
			columnWidth: 		'.grid-sizer',
			itemSelector: 		'.grid-item',
			gutter: 			2,
			percentPosition: 	true
		});
	});

})(jQuery);

/*===========================
=            MAP            =
===========================*/

(function($) {

	function new_map( $el ) {
		
		// var
		var $markers = $el.find('.marker');
		
		// vars
		var args = {
			zoom		: 13,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
		
		// create map	        	
		var map = new google.maps.Map( $el[0], args);
		
		
		// add a markers reference
		map.markers = [];
		
		// add markers
		$markers.each(function(){
			
	    	add_marker( $(this), map );
			
		});
		
		// center map
		center_map( map );
		
		// return
		return map;
		
	}

	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function add_marker( $marker, map ) {

		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		var icon = {
			url: $marker.attr('data-icon'), // url
			size: new google.maps.Size(64, 64),     // original size you defined in the SVG file
			scaledSize: new google.maps.Size(64, 64), // scaled size
			//origin: new google.maps.Point(0,0), // origin
			//anchor: new google.maps.Point(0, 0) // anchor
		}

		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon 		: icon
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				infowindow.open( map, marker );

			});
		}

	}

	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 13 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}

	}

	/*
	*  document ready
	*
	*  This function will render each map when the document is ready (page has loaded)
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	// global var
	var map = null;

	$(document).ready(function(){

		$('#map').each(function(){

			// create map
			map = new_map( $(this) );

		});

	});

})(jQuery);