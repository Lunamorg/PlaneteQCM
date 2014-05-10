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
        <h1 style="text-align: center;">Bienvenue sur Planète QCM</h1>
        <br/>
        <h2 style="text-align: center;">Présentation</h2>
        <br/>
        <br/>

        <div style="text-align: center">
          <div style="text-align: center; width: 250px; text-align: center; display: inline-block;">
            <img src="images/pres_choix.png" style="width:200px; height:200px;" alt="Présentation matières"/>
            <p style="text-align: center;">Choissisez votre matière préférée.</p>
          </div>

          <div style="width: 250px; text-align: center; display: inline-block;">
            <img src="images/pres_qcm.png" style="width:200px; height:200px;  display: inline-block;" alt="Présentation qcm"/>
            <p >Répondez à 10 questions proposées aléatoirement.</p>
          </div>

          <div style="width: 250px; text-align: center; display: inline-block;">
            <img src="images/pres_leaderboard.png" style="width:200px; height:200px;  display: inline-block;" alt="Présentation leaderboard"/>
            <p >Regardez votre classement par rapport aux autres.</p>
          </div>
        </div>

        <p style="text-align: center; padding-top: 100px;">Amusez-vous bien !</p>
        <br/>
        <p style="text-align: right;" id="signature"><em>L'équipe Planète QCM.</em></p>

      </div>
    </div>

    <?php include('pied.php'); ?>
  </body>
</html>
