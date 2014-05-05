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
      <h3>Inscription facile et gratuite !</h3>
      <form method="POST" action="traitement.php?type=inscription">        
        <label>Pseudonyme</label>
        <input type="text" name="pseudo"/> <br/>
        <label>Mot de passe</label>
        <input type="password" name="mdp"/> <br/>
        <label>E-mail</label>
        <input type="text" name="email"/> <br/>
        <input type="submit" name="Valider"/> <br/>        
      </form>
    </div>
  </div>

  <?php include('pied.php'); ?>
  </body>
</html>
