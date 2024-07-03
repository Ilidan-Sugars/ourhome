import * as bootstrap from 'bootstrap';
import jQuery, { ajax } from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;
import "../scss/app.scss";
import 'magnific-popup'









// получаем все не занетые комнаты

//Переменная для сайта
const origin = 'http://ourhome/ourhome'

// получаем все элементы, с которыми будем работать 
const box = $('#box');
const popup = $('#popup')
const savebox = box.html();










//получаем все свободные комнаты в эту дату
function getRooms(date) {
    $.ajax({
        url: origin + '/api/index.php',
        method: 'POST',
        dataType: 'html',
        data: { action: 'getrooms', date: date },
        success: function (rooms) {
            box.html(rooms);
            console.log(rooms);
            $('.more-popup-link').magnificPopup({
                midClick: true
            });
            
        }
    });
};


// Получаем конкретную комнату
function getroom(room_id) {
    $.ajax({
        url: origin + '/api/index.php',
        method: 'POST',
        dataType: 'html',
        data: { action: 'getroom', room_id: room_id },
        success: function (room) {
            popup.html(room);
        }
    })
}

//отдаём комнату с заказом
function getApplication(room_id, date) {
    $.ajax({
        url: origin + '/api/index.php',
        method: 'POST',
        dataType: 'html',
        data: { action: 'application', room_id: room_id,  date:  date},
        success: function (application) {
            popup.html(application);
        }
    })
}


//отправка заказа, проверка, что комната не занята
function placeOrder(room_id, date, name, number, email, tel, coment) {
    $.ajax({
        url: origin + '/api/index.php',
        method: 'POST',
        dataType: 'html',
        data: { action: 'placeOrder', room_id: room_id,  name:  name,  number:  number,  email:  email,  tel:  tel,  coment:  coment,  date:  date,},
        success: function (answer) {
            popup.html(answer);
            getRooms(date);
        }
    })
}








// события на клик, если дата выбранна
$(document).on('click', '#btn-date', function () {
    const date = $('#date').val()
    if (date != '') {
        console.log('#box')
        getRooms(date);
    }
});

// Событие на клик, меняем всплывающее окно

$(document).on('click', '.more-popup-link', function () {
    const id = $(this).data('id');
    getroom(id);
});

//Возрат на начальную страницу
$(document).on('click', '#back', function () {
    box.html(savebox);
});


//смена попапа на заявку
$(document).on('click', '#new-order', function() {
    const id = $(this).data('id');
    const date = $('#date').data('date');
    getApplication(id, date);

})

// оформление заказа
$(document).on('click', '#do_application', function() {
    const room_id = $(this).data('id');

    const date = $('#date').data('date');
    const name = $('#name').val();
    const number = $('#number').val();
    const email = $('#email').val();
    const tel = $('#tel').val();
    const coment = $('#coment').val();
    placeOrder(room_id, date, name, number, email, tel, coment)

})







// Всплывающее окно 
/*
$('.more-popup-link').magnificPopup({
    midClick: true
});*/
