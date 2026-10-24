/**
 * Admin: media library picker for story video + clear.
 */
( function ( $ ) {
	'use strict';

	var frame;

	function openMedia() {
		if ( frame ) {
			frame.open();
			return;
		}

		frame = wp.media( {
			title: ( window.spadakStoriesAdmin && spadakStoriesAdmin.title ) || 'Select video',
			button: {
				text: ( window.spadakStoriesAdmin && spadakStoriesAdmin.button ) || 'Use this video',
			},
			library: {
				type: 'video',
			},
			multiple: false,
		} );

		frame.on( 'select', function () {
			var attachment = frame.state().get( 'selection' ).first().toJSON();
			if ( ! attachment || ! attachment.url ) {
				return;
			}
			$( '#spadak_story_video' ).val( attachment.url );
			$( '#spadak_story_video_id' ).val( attachment.id );
			$( '#spadak-clear-video' ).show();
		} );

		frame.open();
	}

	$( function () {
		$( '#spadak-select-video' ).on( 'click', function ( e ) {
			e.preventDefault();
			openMedia();
		} );

		$( '#spadak-clear-video' ).on( 'click', function ( e ) {
			e.preventDefault();
			$( '#spadak_story_video' ).val( '' );
			$( '#spadak_story_video_id' ).val( '' );
			$( this ).hide();
		} );
	} );
} )( jQuery );
