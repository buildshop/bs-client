/**
 * Requires compatibility with application.js
 *
 * @author Andrew (panix) Semenov <andrew.panix@gmail.com>
 * @copyright (c) CORNER CMS
 * 
 * 
 * @param boolean cart.spinnerRecount Статичный пересчет и/или с ajax
 * @function recountTotalPrice Пересчет общей стоимости
 * @function renderBlockCart Перезагрузка блока корзины (ajax response)
 * @function remove Удаление обэекта с корзины (ajax response)
 * @function add Добавление обэекта в корзину (ajax response)
 * @function recount Пересчет корзины (ajax response)
 * @function notifier Сообщить о появление (ajax response)
 * @function init Инициализация jquery spinner
 */

var cart = window.cart || {};
cart = {
    /**
     * @return boolean
     */
    spinnerRecount: false,
    selectorTotal: '#total',
    /**
     * @param that
     */
    recountTotalPrice: function (that) {
        var total = parseFloat(orderTotalPrice);
        var delivery_price = parseFloat($(that).attr('data-price'));
        var free_from = parseFloat($(that).attr('data-free-from'));
        if (delivery_price > 0) {
            if (free_from > 0 && total > free_from) {
                // free delivery
            } else {
                total = total + delivery_price;
            }
        }
        $(cart.selectorTotal).html(getPrice(total.toFixed(2)));
    },
    renderBlockCart: function () {
        $("#cart").load('/cart/renderSmallCart');
    },
    /**
     * @param product_id ИД обэекта
     */
    remove: function (product_id) {
        app.setText('loadingText', 'пересчет...');
        app.ajax('/cart/remove/' + product_id, {}, function () {
            cart.renderBlockCart();
            app.report('Товар успешно удален!');
        }, 'html', 'GET');
    },
    /**
     * @param formid Id формиы
     */
    add: function (formid) {
        var form = $(formid);


         app.ajax(form.attr('action'),form.serialize(),function(data, textStatus, xhr){
         
         if(data.errors){
         app.report(data.errors);
         }else{
         cart.renderBlockCart();
         app.report(data.message);
         $('body,html').animate({
         scrollTop: 0
         }, 500,function(){
         $("#cart").fadeOut().fadeIn();
         });
         
         }
         },'json');
    },
    /**
     * @param product_id ИД обэекта
     * @param quantities Количество
     */
    recount: function (quantities, product_id) {
        app.report('Подождите идет пересчет...');
        app.ajax('/cart/recount', {
            product_id: product_id,
            quantities: quantities
        }, function (data, textStatus, xhr) {
            app.closeReport();
            $('#row-total-price' + product_id).html(data.rowTotal);
            //$('#orderTotalPrice').html(data.totalPrice);
            $(cart.selectorTotal).text(data.totalPrice);
        }, 'json');
    },
    /**
     * @param product_id ИД обэекта
     */
    notifier: function (product_id) {
        $('body').append($('<div/>', {
            'id': 'dialog'
        }));
        $('#dialog').dialog({
            title: 'Сообщить о появлении',
            modal: true,
            resizable: false,
            open: function () {
                var that = this;
                app.ajax('/notify', {
                    product_id: product_id
                }, function (data, textStatus, xhr) {
                    $(that).html(data.data);
                }, 'json');
            },
            buttons: [{
                    'text': 'Отмена',
                    'class': 'btn btn-link',
                    'click': function () {
                        $(this).remove();
                    }
                }, {
                    'text': 'Отправить',
                    'class': 'btn btn-primary',
                    'click': function () {
                        app.ajax('/notify', $('#notify-form').serialize(), function (data, textStatus, xhr) {
                            if (data.status == 'OK') {
                                $('#dialog').remove();
                                app.report(data.message);
                            } else {
                                $('#dialog').html(data.data);
                            }
                        }, 'json');
                    }
                }]
        });
    },
    init: function () {
        console.log('load: cart.init()');
        $(function () {
            // see manual http://www.virtuosoft.eu/code/bootstrap-touchspin/
            $(".spinner").TouchSpin({
                min: 1,
                buttondown_txt: '-',
                buttonup_txt: '+'
            });
            $(".spinner").on("touchspin.on.startspin", function (e) {
                var product_id = $(this).attr('product_id');
                if (cart.spinnerRecount) {
                    cart.recount($(this).val(), product_id);
                }
            });
            $(".spinner").on("change", function (e) {
                var product_id = $(this).attr('product_id');
                if (cart.spinnerRecount) {
                    cart.recount($(this).val(), product_id);
                }
            });
        });

        /* $(function(){
         $('.spinner').spinner({
         max: 999,
         min: 1,
         icons: {
         down: "spinner-icon spinner-down btn btn-default",
         up: "spinner-icon spinner-up btn btn-default"
         },
         //клик по стрелочкам spinner
         spin: function( event, ui ) {
         var product_id = $(this).attr('product_id');
         if(ui.value >= 1 && cart.spinnerRecount){
         cart.recount(ui.value,product_id);
         }
         },
         stop:function(event, ui ){
         //запрещаем ввод числа больше 999;
         if($(this).val() > 999) $(this).val(999);
         },
         change: function (event, ui) {
         var product_id = $(this).attr('product_id');
         if($(this).val() < 1){
         $(this).val(1);
         }
         if(cart.spinnerRecount){
         cart.recount($(this).val(),product_id);
         }
         }
         });
         });*/
    }
}
cart.init();

