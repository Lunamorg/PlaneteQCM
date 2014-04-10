<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <title>Planete QCM</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.23.1" />
    <link rel="stylesheet" type="text/CSS" href="planete.css"/>
</head>

<body>
<?php include('titre.php'); ?>
<?php include('menu.php'); ?>

<div id ="CORPS">
    <h3>QCM par thème</h3>
    <form name="choix" method="post" action="./?id=sport">
        <input a href="sport.php" name="Sport">Sport</a>

    </form>
</div>

<?php include('pied.php'); ?>
</body>
</html>
