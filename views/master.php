<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow" />
    <title><?php print isset($title) ? $title : 'Mijn site'; ?></title>

    <link rel="stylesheet" href="/vendor/twitter/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/style/font-awesome.min.css"/>
    <link rel="stylesheet" href="/style/socicon.css"/>
    <link rel="stylesheet" href="/style/custom.css"/>
    <link rel="stylesheet" href="/components/slick/slick.css"/>
    <link rel="stylesheet" href="/components/slick/slick-theme.css"/>

    <script src="/js/modernizr.js"></script>
</head>
<body>

<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '679856442119345',
            xfbml      : true,
            version    : 'v2.3'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_BE/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<?php include_once 'partials/preheader.php'; ?>

<?php include_once 'partials/header.php'; ?>

<div id="main" class="container-fluid">
    <!-- LEFT -->
    <div class="col-lg-3 col-lg-offset-1 left text-left">
        <img src="/img/sitelogo.png" alt="Jochens Velodroom" id="sitelogo"/>

        <p><span class="green">Openingsuren</span> - gesloten op zondag en maandag <i class="fa fa-lock"></i><p>

        </p></i> dinsdag t.e.m. vrijdag van 8-12u & 14-18u30<br/>
        zaterdag van 9-12u & 14-18u30</p>

        <p><i class="fa fa-credit-card"></i> Wij aanvaarden ecocheques voor alle aankopen en herstellingen</p>
    </div>
    <!-- MID & RIGHT -->
    <row>
        <?php include_once isset($view) ? $view : ''; ?>
    </row>
</div>

<?php include 'partials/footer.php'; ?>

<a href="#0" class="cd-top">Top</a>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="/components/slick/slick.min.js"></script>
<script src="//assets.pinterest.com/js/pinit.js" async defer></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
<script src="/js/social.js"></script>
<script src="/js/cd-top.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/frmContact.js"></script>

</body>
</html>