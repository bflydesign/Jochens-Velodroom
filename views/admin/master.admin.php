<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php if (isset($title)) { ?>
        <title>Atelier VQ - <?php print $title; ?></title>
    <?php } ?>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <?php if (isset($stylesheet)) { ?>
        <link rel="stylesheet" href="/css/<?php print $stylesheet; ?>"/>
    <?php } ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loaded">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/welkom">Atelier VQ</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/welkom">Website</a></li>
                <li><a href="#" id="logout">Uitloggen</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Paginabeheer</a></li>
                <li><a href="/page/edit?p=welkom">Welkom</a></li>
                <li><a href="/page/edit?p=over-ons">Over ons</a></li>
                <li><a href="/page/edit?p=chef-aan-huis">Chef-aan-huis</a></li>
                <li><a href="/page/edit?p=links">Links</a></li>
                <li><a href="/page/edit?p=news">News (introtekst)</a></li>
                <li><a href="/page/edit?p=contact">Contact</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Winkel</a></li>
                <?php foreach (Page::getSubPages(3) as $subPage) { ?>
                    <li>
                        <a href="/page/edit?p=<?php print !isNullOrEmpty($subPage->getSlug()) ? $subPage->getSlug() : ''; ?>">
                            <?php print !isNullOrEmpty($subPage->getTitle()) ? $subPage->getTitle() : ''; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Nieuwsbeheer</a></li>
                <li><a href="/news/add">Toevoegen</a></li>
                <li><a href="/news/edit">Bewerken</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="active"><a href="/fileserver">Fileserver</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>

            <?php include $view; ?>
        </div>
    </div>
</div>

<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/js/ie10-viewport-bug-workaround.js"></script>
<script src="/components/ckeditor/ckeditor.js"></script>
<script src="/components/ckeditor/adapters/jquery.js"></script>

<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
<script src="/js/scripts.js"></script>

<script>
    // -- form input control
    $('#title').restrictLength($('#maxlength'));

    // -- ckeditor
    $('#content').ckeditor();
</script>

<script src="/js/savePage.js"></script>
<script src="/js/saveNews.js"></script>
<script src="/js/deleteNews.js"></script>
<script src="/js/login.js"></script>

</body>
</html>