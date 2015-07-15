// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

$(document).ready(function() {
    $('#sendContact').on('click', function() {
        // grab form field data
        var formFirstName    = $('#firstName').val();
        var formLastName    = $('#lastName').val();
        var formEmail   = $('#emailAddress').val();
        var formMessage = $('#message').val();
        var formdata    = 'firstname=' + formFirstName + '&lastname=' + formLastName + '&email=' + formEmail + '&message=' + formMessage;
        $('#content-thank-you').foundation('reveal', 'open', {
            url: '/foundation/php/app.php?script=message',
            type: 'POST',
            data: formdata,
            success: function(data) {
                //$('#messageName').val('');
                //$('#messageEmail').val('');
                //$('#messageMessage').val('');
            },
            error: function(data) {

                var html = '<img src="img/logo_black.svg" /><h4 class="clickit-section-centered-text">We\'re sorry. Something funky happened.  Please try again.</h4><a class="close-reveal-modal">&#215;</a>';
                $('#content-thank-you').html(html);
                $('#content-thank-you').foundation('reveal', 'open');
            }
        });
        return false;
    });
});

$(document).foundation();