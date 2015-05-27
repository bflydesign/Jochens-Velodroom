// -- SLIDER
$(document).ready(function(){
    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 1000,
        fade: true,
        cssEase: 'linear'
    });
});

// -- FORM VALIDATION TRANSLATIONS
var nederlands = {
    errorTitle : 'Het formulier werd niet goed ingevuld!',
    requiredFields : 'Niet alle verplichte velden werden ingevuld',
    badTime : 'U voerde een foutieve tijdsnotatie in',
    badEmail : 'U voerde een foutief e-mailadres in',
    badTelephone : 'U voerde een foutief telefoonnummer in',
    badSecurityAnswer : 'Het antwoord op de beveiligingsvraag is niet correct',
    badDate : 'U voerde een foutieve datum in',
    lengthBadStart : 'Het antwoord moet liggen tussen ',
    lengthBadEnd : ' tekens',
    lengthTooLongStart : 'De invoer bedraagt meer dan ',
    lengthTooShortStart : 'De invoer bedraagt minder dan ',
    notConfirmed : 'De waarden kunnen niet worden bevestigd',
    badDomain : 'U voerde een foutieve domeinnaam in',
    badUrl : 'U voerde een foutieve URL in',
    badCustomVal : 'U voerde een foutief antwoord in',
    badInt : 'U voerde een foutief nummer in',
    badSecurityNumber : 'Uw rijksregisternummer werd niet correct ingevuld',
    badUKVatAnswer : 'Het BTW-nummer is niet geldig',
    badStrength : 'Uw wachtwoord is niet veilig genoeg',
    badNumberOfSelectedOptionsStart : 'U moet tenminste ',
    badNumberOfSelectedOptionsEnd : ' antwoorden',
    badAlphaNumeric : 'Het antwoord mag enkel alfanumeriekte tekens bevatten ',
    badAlphaNumericExtra: ' en ',
    wrongFileSize : 'De bestandsgrootte overschrijdt de limiet',
    wrongFileType : 'Dit bestandstype is niet toegelaten',
    groupCheckedRangeStart : 'Gelieve te kiezen tussen ',
    groupCheckedTooFewStart : 'Kies minimaal ',
    groupCheckedTooManyStart : 'Kies maximaal ',
    groupCheckedEnd : ' item(s)'
};