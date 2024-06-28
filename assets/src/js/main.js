import * as bootstrap from 'bootstrap';
import jQuery, { ajax } from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;
import "../scss/app.scss";
import 'magnific-popup'

// получаем все не занетые комнаты

//Переменная для сайта
const origin = 'http://aaaaaaaaaaaaaaa.ru'


function getRooms(date) {
    $.ajax({
        url: origin + '/api/index.php',
        method: 'POST',
        dataType: 'html',
        data: { action: 'getrooms', date: date },
        success: function (rooms) {
            box.html(rooms);
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
            console.log(room);
        }
    })
}

// получаем все элементы, с которыми будем работать 
const box = $('#box');
const popup = $('#popup')
const savebox = box.html();
console.log(savebox);

// события на клик, если дата выбранна
$(document).on('click', '#btn-date', function () {
    var date = document.getElementById("date").value
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

//Возрат
$(document).on('click', '#back', function () {
    box.html(savebox);
});

// Всплывающее окно 
/*
$('.more-popup-link').magnificPopup({
    midClick: true
});*/
