import * as bootstrap from 'bootstrap';
import jQuery, { ajax } from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;
import "../scss/app.scss";



function getRooms(date) {
    $.ajax({
        url: 'api/index.php',
        method: 'post',
        dataType: 'html',
        data: {text: 'Текст'},
        success: function(data){
        alert(data);
        }
    });
};



$(document).on('click', '#btn-date', function () {
    var date = document.getElementById("date").value
    getRooms(date);
    console.log(date);
});


