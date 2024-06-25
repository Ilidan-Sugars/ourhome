import * as bootstrap from 'bootstrap';
import jQuery, { ajax } from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;
import "../scss/app.scss";



function getRooms(date) {
    $.ajax({
        url: 'http://ourhome/ourhome/api/index.php',
        method: 'POST',
        dataType: 'html',
        data: { action: 'getrooms', date: date },
        success: function (rooms) {
            console.log(rooms);
            
            box.html(rooms);
        },
        error: function (jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect. Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found (404).');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error (500).');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error. ' + jqXHR.responseText);
            }
        }
    });
};

const box = $('#box');
const savebox = box.html();
console.log(savebox);


$(document).on('click', '#btn-date', function () {
    var date = document.getElementById("date").value
    if (date != '') {
        getRooms(date);
        console.log(date);
    }
});

$(document).on('click', '#back', function () {
    box.html(savebox);
    console.log(savebox);
});


