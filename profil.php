<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <title>Planete QCM</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="generator" content="Geany 1.23.1"/>
    <link rel="stylesheet" type="text/CSS" href="planete.css"/>
</head>

<body>

<?php include('titre.php'); ?>
<?php include('menu.php'); ?>

<div class="CORPS">
    <form method='post' action='traitement.php?type=suppression'>
        <fieldset>
            <legend>Modifier mon mot de passe</legend>
            <label>Mot de passe actuel</label><input type="password"/><br/>
            <label>Nouveau mot de passe</label><input type="password"/><br/>
            <input type='submit' value='Modifier'/>
        </fieldset>
    </form>
    <form method='post' action='traitement.php?type=suppression'>
        <fieldset>
            <legend>Supprimer mon compte</legend>
            <p>
                Attention: La suppression de compte est irr&eacute;versible !
            </p>
            <input type='submit' value='Supprimer compte'/>
        </fieldset>
    </form>
</div>

<?php include('pied.php'); ?>
</body>

</html>
