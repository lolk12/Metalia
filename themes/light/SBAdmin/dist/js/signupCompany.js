$(document).ready(function () {
    var hash = location.hash;
    if(hash === '#goodCompany'){
        location.hash = '';
        alert('Проверьте свою почту');
    }
    var i = 1;

    $('#add-unit').click(function () {
        $('#unit').append(`
            <div class="main-unit unit ${i}">
                <span class="close_block" id="${i}"> Закрыть</span>
                <h3>Обособленное подразделение #${i}</h3>
                <div class="form-group field-companyunitsignup-address-1 required">
                    <label class="control-label" for="companyunitsignup-address-1">Адресс</label>
                    <input type="text" id="companyunitsignup-address-1" class="form-control" name="CompanyUnitSignup[${i}][address]">
                    <div class="help-block"></div>
                </div>
                
                <div class="form-group field-companyunitsignup-name-1 required">
                    <label class="control-label" for="companyunitsignup-name-1">Название подразделения</label>
                    <input type="text" id="companyunitsignup-name-1" class="form-control" name="CompanyUnitSignup[${i}][name]">
                    <div class="help-block"></div>
                </div>
                
                <div class="form-group field-companyunitsignup-telephone-1 required">
                    <label class="control-label" for="companyunitsignup-telephone-1">Телефон</label>
                    <input type="text" id="companyunitsignup-telephone-1" class="form-control" name="CompanyUnitSignup[${i}][telephone]">
                    <div class="help-block"></div>
                </div>
                
                <div class="form-group field-companyunitsignup-description-1 required">
                    <label class="control-label" for="companyunitsignup-description-1">Описание компании</label>
                    <input type="text" id="companyunitsignup-description-1" class="form-control" name="CompanyUnitSignup[${i}][description]">
                    <div class="help-block"></div>
                </div>
            </div>
        `);
        i += 1;
        $('.unit').animate({
            opacity: 1
        },500)
    });
    $(document).on("click", '.close_block',function () {
        $('.'+$(this).attr('id')).fadeOut(function(){$(this).remove()})
        i -=1;
    });
    var scroll_el;
    $('.go_to').click( function(){ // ловим клик по ссылке с классом go_to
        scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
        if (scroll_el.length != 0) { // проверим существование элемента чтобы избежать ошибки
            $('html, body').animate({ scrollTop: $(scroll_el).offset().top -90 }, 500); // анимируем скроолинг к элементу scroll_el
        }
        return false; // выключаем стандартное действие
    });

    let page_1 = $('#page_1').position().top;
    let page_2 = $('#page_2').position().top - 100;
    let page_3 = $('#page_3').position().top - 100;
    let page_4 = $('#page_4').position().top - 100;

    window.onscroll = function () {

        if((window.pageYOffset > page_1) && (window.pageYOffset <page_2)){
            $('.tag ul li').css('background', '#fff');
            $('.tag ul li:eq(0)').css('background', '#F4F4F4');
        }else if((window.pageYOffset > page_2) &&(window.pageYOffset < page_3)){
            $('.tag ul li').css('background', '#fff');
            $('.tag ul li:eq(1)').css('background', '#F4F4F4');
        }else if((window.pageYOffset > page_3) &&(window.pageYOffset < page_4)){
            $('.tag ul li').css('background', '#fff');
            $('.tag ul li:eq(2)').css('background', '#F4F4F4');
        }else if((window.pageYOffset > page_4)){
            $('.tag ul li').css('background', '#fff');
            $('.tag ul li:eq(3)').css('background', '#F4F4F4');
        }

    }
});
