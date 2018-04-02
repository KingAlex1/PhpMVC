<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Alex B.">
    <title>Starter Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="../../public/style/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../public/style/css/starter-template.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> Project MVC </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Авторизация</a></li>
                <li><a href="RegPageController">Регистрация</a></li>
                <li><a href="UserPageController">Список пользователей</a></li>
                <li><a href="FilePageController">Список файлов</a></li>
                <li class="nav_avatar" style="position: absolute; left: 76vw;">{% for
                    key , item in data %}
                    <img class="avatar" class="user_ava" src="../photos/{{ item.photo }} "
                         width="180"   height="180">
                    {% endfor %}
                </li>
                <li class="sign_out" style="position: absolute; left: 80vw;
                "><a href="PostController/signOut">Sign
                        Out</a></li>

            </ul>
        </div>
    </div>
</nav>

<?php
//echo 'line :' . $e->getLine() . "<br>";
//echo 'line :' . $e->getFile() . "<br>";
echo "<h3>" .$e->getMessage(). "</h3>" . "<br>";
//echo $e->getTraceAsString();

