$(document).ready(function () {

    $('.send-form').on('click', function (){
        var formData = new FormData;
        $(this).closest('form').find('input').each(function (i, el){
            formData.append(el.name,el.value);
        });

        $.ajax({
            data : formData,
            type : "POST",
            url : '/api/link/create/',
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.hasOwnProperty('errors')) {
                    message = '';
                    for (key in data['errors']) {
                        var message = message + data['errors'][key];
                    }
                   alert(message);
                } else {
                   alert(window.location.host + '/' + data['link']);
                }

            },
            error: function (error) {

            }
        });

    });

});
