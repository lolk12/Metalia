$(document).ready(function () {
    let i = 1;
    let dataCatalog;

    ///Код Каталога
    let viewCatalog = function (data,classCatalog, i) {
        let dataToJSON = JSON.parse(data);
        for(let key of dataToJSON){
            if(!key.parent){ //Проверка есть ли родитель
                $(classCatalog).append(`<li data-id="${key.id}"><a href="/menu/view?id=${key.id}">${key.name}</a></li>`)
            }else {
                $(classCatalog + ` li[data-id="${key.parent}"]`) // Поиск элемента родителя, если есть добавляет Элемент в нутрь блока
                    .append(`<ul class=""><li data-id="${key.id}"><a href="/menu/view?id=${key.id}">${key.name}</a></li></ul>`);
                $(`li[data-id="${key.parent}"]`).attr('parent', true); // Если появляются дочерние элементы добавляет свойство Parrent: true
            }
        }
    };

   let getCatalog = function (classCatalog) {
       $.ajax({
           'url': '/menu/get-data',
           'success': function (data,textStatus,jqXHR) { // Получение данных по средством AJAX для отображения каталога
               viewCatalog(data,classCatalog,i); // Отображение каталога для редактирования

               $(classCatalog + ' li[parent="true"]>a').append('<i class="glyphicon glyphicon-menu-right"></i>');

               $(classCatalog + ' li[parent="true"]>a').on('click',function () {
                   if($(this.firstElementChild).hasClass('rotate-90')){
                       $(this.firstElementChild).removeClass('rotate-90')
                   }else {
                       $(this.firstElementChild).addClass('rotate-90');
                   }
                   let siblings = $(this).siblings(); // получение  всех элементов на ступень выше по иерархии
                   let display = $(siblings).css('display');
                   if(display === 'none'){
                       $(siblings).css('display', 'block');
                   }else{
                       $(siblings).css('display', 'none');
                   }
                   return false;
               });

               //Редактирвание каталога

               let activElement; // Сохранение позиции активного елемента
               let activeAttr = function () {
                   $(classCatalog +' a').on('click', function () {
                       if(activElement){ // если есть активные элементы
                           $(activElement).attr('active',false); // удаляем активный елемент
                           let parent = $(this).parent(); // Берем родителей
                           $(parent).attr('active', true); // Устанавливаем метку Active родительскому элементу li
                           activElement = parent; // Сохраняем новую метку
                       }else {
                           let parent = $(this).parent();
                           activElement = parent;
                           $(parent).attr('active', true);
                       }

                       let parent_top = $(this).closest('.catalog');   /// Получаем ближайшего родителя по данному, который соответсвует селектору
                       let catalog_id = $(parent_top).attr('id').substr(11);  // Получаем ID отсекаем лишние получаем чистое число
                       let product_id = $(`#catalog_id_${catalog_id} li[active="true"]`).attr('data-id'); /// Получаем ID выбранного продукта
                       $(`#product_id_${catalog_id} input`).val(product_id); // заносим в скрытый инпут что бы неболо проблем с AJAX валидацией.

                       return false;
                   });
               };
               activeAttr();
               // $('body').click(function () {  // Снятие метки при клике на body (Нуждается в даработки )
               //     $(activElement).attr('active','false');
               //     activElement = null;
               // });

                /// Редактирование каталога
               $('.sendCatalog').on('click',function () { ///Добавление нового элемента в каталог
                   let nameCatalog = $('input[name="nameCatalog"]').val(); // Берем данные с формы
                   let id_parent = $(activElement).attr('data-id'); // Сохраняем Id родителя
                   $.ajax({  // Отправляем данные каталога
                       'type': 'POST',
                       'url': '/menu/update',
                       'data': {
                           'name': nameCatalog,
                           'parent': id_parent
                       },
                       'success': function (data,textStatus,jqXHR) {
                           if(data){
                               if(!id_parent){
                                   $(classCatalog).append(`<li data-id="${data}"><a href="/menu/view?id=${data}">${nameCatalog}</a></li>`)
                               }else {
                                   $(`li[data-id="${id_parent}"]`)
                                       .append(`<ul><li data-id="${data}"><a href="/menu/view?id=${data}">${nameCatalog}</a></li></ul>`);
                                   $(`li[data-id="${id_parent}"]`).attr('parent', true);
                               }
                               $($(`li[data-id="${data}"]`).parent()).css('display', 'block');
                               $($(`li[data-id="${data}"]`).parent()).on('click',function () {
                                   return false;
                               });
                               activeAttr(); // данная функция вызывается дважды что бы исключить стандартное действие на элементе.

                           }
                       }
                   })
               });
               /// END редактирование каталога

               /// Удаление элемента редактирования каталога
               $('.deleteCatalog').on('click', function () {
                    $.ajax({
                        'type' : 'POST',
                        'url' : '/menu/delete',
                        'data' : {
                            'id' : $(activElement).attr('data-id')
                        },
                        'success': function (data,textStatus,jqXHR) {
                            if(data){
                                $(activElement).remove();
                            }else{
                                console.log('Ошибочка');
                            }
                        }
                    })
               })

               // End Удаление элемента редактирования каталога
           }
       });
   };
    getCatalog(`#catalog_id_0`);

    // End код каталого ///
    $('#add-block').click(function () {
        $('#unit').append(`
            <div class="unit ${i}">
                <div class="width_max"><span class="close_block" id="${i}"> Закрыть</span></div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="product_id" id="product_id_${i}">
                            <input name="TenderProductSignup[${i}][product_id]" type="text">
                        </div>
                        <ul class="catalog" id="catalog_id_${i}"></ul>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="tenderproductsignup-budget">Количество</label>
                        <input type="text" id="tenderproductsignup-budget" class="form-control" name="TenderProductSignup[${i}][budget]" aria-required="true" aria-invalid="true">
                    </div>
                </div>
            </div>
        `);
        getCatalog(`#catalog_id_${i}`);
        i += 1;
        $('.unit').animate({
            opacity: 1
        },500)
    });

    $(document).on("click", '.close_block',function () {
        $('.'+$(this).attr('id')).fadeOut(function(){$(this).remove()});
        i -=1;
    });





});