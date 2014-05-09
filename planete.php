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

    <div class="IMG_FOND">
      <div class="CORPS">
        <h1>Bienvenue sur Planète QCM</h1>
        <p>Envie d'un moment de détente autour de questions de culture générale ? Pourquoi ne pas essayer un de nos nombreux QCM !
        <p>Inscrivez-vous gratuitement et venez tester vos connaissances sur l'un de nos QCM.</p>
        <p>De nombreux QCM seront ajouté dans les jours à venir.</p>
        <p>Amusez-vous bien !</p> <br/>
        <h2>Présentation</h2>
        <br/>
        <br/>
        <img src="images/pres_choix.png" style="width:150px; height:150px"/>
        <p class="float_right">Choissisez la matière que vous voulez traiter</p>

        <p class="float_left">Répondez à 10 questions proposées aléatoirement</p>
        <img src="images/pres_qcm.png" style="width:150px; height:150px"/>

        <p style="text-align: center;">Amusez-vous bien !</p>
        <br/>
        <p style="text-align: right;" id="signature"><em>L'équipe Planète QCM.</em></p>

      </div>
    </div>

    <?php include('pied.php'); ?>
  </body>
</html>
