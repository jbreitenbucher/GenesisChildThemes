jQuery( function($) {
 
    $( '#videos .video_thumbs li:first-child' ).addClass( 'active' );
 
    $( '#videos .video_thumbs a' ).on( 'click', function(e) {
        e.preventDefault();
 
        $( '#videos .video_thumbs li' ).removeClass( 'active' );
        $( this ).parentsUntil( 'ul' ).addClass( 'active' );
 
        var video = $( this ).attr( 'href' );
        $( '#videos .video_player iframe' ).attr( 'src', video );
    });
 
});