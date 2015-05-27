// -- FACEBOOK
$(document).ready(function () {

    var $numItems = $('.newsitem').length;

    $('a.sharebutton-news').click(function (e) {
        e.preventDefault();

        var i = $(this).attr('id');
        var link = 'http://www.ateliervq.be/news#newsitem-' + i;
        var caption = $('#news-title-' + i).text();
        var description = $('#news-message-' + i).text();

        FB.ui({
            method: 'feed',
            name: 'AtelierVQ',
            link: link,
            picture: 'http://www.ateliervq.be/images/meat.jpg',
            caption: caption,
            description: description
        });
    });

    $('a.soc-facebook').click(function (e) {
        e.preventDefault();

        var link = 'http://www.jochensvelodroom.be';
        var caption = $('#pagename').text();
        var description = 'Jochen stapte 25 jaar geleden in de fietsen branche, in de loop der jaren mocht Jochen heel wat relevante ervaring opdoen als fietsmechanieker. In 2004 opende Jochen zijn eigen "Velodroom".';

        FB.ui({
            method: 'feed',
            name: 'Jochens Velodroom',
            link: link,
            picture: 'http://www.bflydesign.be/img/sitelogo.png',
            caption: caption,
            description: description
        });
    });
});

// -- TWITTER
window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));

// -- PINTEREST



// -- GOOGLE PLUS



// -- MAIL
