(function($){
    var controller = new slidebars();
    controller.init();
    // Left Slidebar controls
    $( '.open-left-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.toggle( 'slidebar-1' );
    } );
    
    $( '#main' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.close();
    } );
    $( '.icon-remove' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.close();
    } );
})(jQuery);