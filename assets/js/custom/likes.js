jQuery( document ).ready( function( $ ) {

	"use strict";

	jQuery( 'body' ).on( 'click','.forte__likes-heart',function( event ) {

		event.preventDefault();

		var
		heart 		= jQuery(this),
		post_id 	= heart.data( 'post_id' ),
		string 		= $( '.forte__likes-count' ),
		wrapper 	= $( '.forte__likes' );

		jQuery.ajax({
			type: 'post',
			url: forte_localization.url,
			data: 'action=post_like&nonce='+forte_localization.nonce+'&post_like=&post_id='+post_id,

			success: function( count ) {

				if ( count.indexOf( 'already' ) !== -1 ) {

					var lecount = count.replace('already',"");

					if ( lecount === '0' ) {
						lecount = '0';
					}

					heart.prop( 'title', forte_localization.like );
					wrapper.removeClass( 'liked' );
					string.addClass('animate-out');
					wrapper.removeClass('trigger--like-animation');

					setTimeout(function() {
						string.removeClass('animate-out');
					}, 300);

					setTimeout(function() {
						string.html( lecount );
						string.addClass('animate-in');
					}, 300);

					setTimeout(function() {
						string.removeClass('animate-in');
					}, 600);

				} else {
					heart.prop( 'title', forte_localization.unlike );
					wrapper.addClass( 'liked' );
					wrapper.addClass('trigger--like-animation');

					string.addClass('animate-out');

					setTimeout(function() {
						string.removeClass('animate-out');
					}, 300);

					setTimeout(function() {
						string.html(count);
						string.addClass('animate-in');
					}, 300);

					setTimeout(function() {
						string.removeClass('animate-in');
					}, 600);
				}
			}
		});
	});
});