<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

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

<body>

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
            <a class="navbar-brand" href="#">MVC</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Авторизация</a></li>
                <li><a href="RegPageController">Регистрация</a></li>
                <li><a href="UserPageController">Список пользователей</a></li>
                <li><a href="FilePageController">Список файлов</a></li>                
                <li class="sign_out" style="position: absolute; right: 0;
                padding-right: 60px"><a href="PostController/signOut">Sign
                        Out</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
    <h2>Информация выводится из базы данных</h2>
    <table class="table table-bordered">
        <tr>
            <th>Пользователь(логин)</th>
            <th>Имя</th>
            <th>возраст</th>
            <th>описание</th>
            <th>Фотография</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($data as $key => $item) : ?>
        <tr>

            <td><?= $item['login'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['age'] ?></td>
            <td><?= $item['description'] ?></td>
            <td><img class="image" src="../photos/<?= $item['photo'] ?> " alt=" <?=
                $item['photo']
                ?>" width="100" height="100"> <img></td>
            <td>
                <form name="ddd" action="../../index.php" method="post">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="pic" value="<?= $item['photo'] ?>">
                    <input id="<?= $item['id'] ?>"
                           name="delete"
                           type="submit"
                           value="удалить пользователя">
                </form>

            </td>
            <?php endforeach; ?>
        </tr>
    </table>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../public/js/main.js"></script>
<script src="../../public/js/bootstrap.min.js"></script>

</body>
</html>
