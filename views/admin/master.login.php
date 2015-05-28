<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jochens Velodroom - <?php print isset($title) ? $title : 'Dashboard'; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/vendor/twitter/bootstrap/dist/css/bootstrap.min.css"/>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/style/dashboard.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="loaded">
<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Log in om verder te gaan</strong>
                </div>
                <div class="panel-body">
                    <div class="alert alert-danger text-center" id="alert-error" hidden>Verkeerde login-combinatie</div>
                    <form id="frmLogin" role="form" action="#" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="center-block">
                                    <a href="/">
                                        <img class="profile-img"
                                             src="/img/sitelogo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span>
                                            <input class="form-control" placeholder="Gebruikersnaam" name="username"
                                                   type="text" autofocus data-validation="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
                                            <input class="form-control" placeholder="Wachtwoord" name="password"
                                                   type="password" value="" data-validation="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="hfAction" value="hfLogin"/>
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Inloggen">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer ">
                    Wachtwoord vergeten? <a href="#" onClick=""> Klik hier</a>
                </div>
            </div>
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
<script src="/js/login.js"></script>

</body>
</html>