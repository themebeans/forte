jQuery( document ).ready( function($) {


	//COLORPICKER
	$('.colorpicker').each(function(){
	  $(this).wpColorPicker();
	});


	//POST FORMAT METABOX SWITCH
	var	$linkSettings  = $('#post_format_link').hide(),
		$videoSettings = $('#post_format_video').hide(),
		$audioSettings = $('#post_format_audio').hide(),
		$gallerySettings = $('#bean-meta-box-gallery').hide(),
		$quoteSettings = $('#post_format_quote').hide(),
		$postFormat    = $('#post-formats-select input[name="post_format"]');
	$postFormat.each(function() {
		var $this = $(this);
		if( $this.is(':checked') )
			changePostFormat( $this.val() );
	});

	$postFormat.change(function() {
		changePostFormat( $(this).val() );
	});

	function changePostFormat( val ) {
		$linkSettings.hide();
		$videoSettings.hide();
		$audioSettings.hide();
		$gallerySettings.hide();
		$quoteSettings.hide();

		if( val === 'link' ) {
			$linkSettings.show();
		} else if( val === 'video' ) {
			$videoSettings.show();
		} else if( val === 'audio' ) {
			$audioSettings.show();
		} else if( val === 'image' ) {
			$gallerySettings.show();
		} else if( val === 'gallery' ) {
			$gallerySettings.show();
		} else if( val === 'quote' ) {
			$quoteSettings.show();
		}
	}
});