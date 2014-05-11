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
      <h4>Résultats</h4>
      <?php
      include_once("fonction.php");
      connexion("projet");
      $donnee = selectionner($GLOBALS["nom_table"], array("qcm", "bonreponse"), array("pseudo" => $_SESSION['pseudo']));
      deconnexion();
      ?>
      <table>
        <thead>
          <th>Mon Score</th>
          <th>QCM faits</th>
        </thead>
          <tr>
            <td><?php echo prcent($donnee['bonreponse'], $donnee['qcm']*10)?></td>
            <td><?php echo $donnee['qcm']?></td>
          </tr>
      </table>
      <?php echo "<form method='post' action='traitement.php?type=modmdp&pseudo=". $_SESSION['pseudo'] ."'>"; ?>
      <h4>Changement de mot de passe</h4>
      <label>Actuel</label><input type="password" name="amdp" id="amdp"/><br/>
      <label>Nouveau</label><input type="password" name="mdp" id="mdp"/><br/>
      <input type='submit' value='Modifier'/> <br/>
      </form>
      <form method='post' action='traitement.php?type=suppression'>
        <h4>Suppression de mon compte.</h4> 
      <input type='submit' value='Supprimer compte'/>      
      <p>Attention: La suppression de votre compte est irr&eacute;versible !</p>
      </form>
    </div>
  </div>

  <?php include('pied.php'); ?>
  </body>

</html>
