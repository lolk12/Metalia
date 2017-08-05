$(document).ready(function () {

    var scroll_el;
    var page_1 = $('#page_1').height();
    var page_2 = $('#page_2').height();
    var page_3 = $('#page_3').height();
    $('.link-nav').click( function(){ // ловим клик по ссылке с классом go_to
        scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
        if (scroll_el === '#page_1') { // проверим существование элемента чтобы избежать ошибки
            $('#main').animate({ scrollTop: 0}, 500); // анимируем скроолинг к элементу scroll_el
        }
        if (scroll_el === '#page_2') { // проверим существование элемента чтобы избежать ошибки
            $('#main').animate({ scrollTop: page_1 - 80}, 500); // анимируем скроолинг к элементу scroll_el
        }
        if (scroll_el === '#page_3') { // проверим существование элемента чтобы избежать ошибки
            $('#main').animate({ scrollTop: page_1 + page_2 -80}, 500); // анимируем скроолинг к элементу scroll_el
        }
        if (scroll_el === '#page_4') { // проверим существование элемента чтобы избежать ошибки
            $('#main').animate({ scrollTop: page_1 + page_2 + page_3 - 80}, 500); // анимируем скроолинг к элементу scroll_el
        }

        return false; // выключаем стандартное действие
    });
});