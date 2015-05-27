$(document).ready(function() {

    // -- form validation
    $.validate({
        form: '#frmContact',
        language: nederlands,
        validateOnBlur: false,
        errorMessagePosition: 'top',
        scrollToTopOnError : true
    });
});
