'use strict';

(function ($) {
    var controller = new slidebars();
    controller.init();
    // Left Slidebar controls
    $('.open-left-slidebar').on('click', function (event) {
        event.stopPropagation();
        controller.toggle('slidebar-1');
    });

    $('#main').on('click', function (event) {
        event.stopPropagation();
        controller.close();
    });
    $('.icon-remove').on('click', function (event) {
        event.stopPropagation();
        controller.close();
    });
    var hash = location.hash;
    //location.hash = '';
    if(hash === '#good'){
        alert('Подтвердите свою почту!');
    }
    // else if(hash === 'error'){
    //     alert('Ошибочка');
    // }
    if($('div').hasClass('has-error')){
        var top = $('.full-screen4').position().top - 400;
        console.log(top);
        $('#main').animate({scrollTop: top}, 1000);
    }





})(jQuery);
