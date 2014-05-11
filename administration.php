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
      <h4>Panneau administrateur</h4>
      <?php
      include_once("fonction.php");
      if(isset($_GET['type']) && $_GET['type'] == "sup")
      {
        connexion("projet");
        supprimer($GLOBALS["$nom_table"], array("pseudo" => $_GET['pseudo']));
        deconnexion();
        header('Location: administration.php');
      }
      else if(isset($_GET['type']) && $_GET['type'] == "reset")
      {
        connexion("projet");
        maj($GLOBALS["$nom_table"], array("qcm" => "0", "bonreponse" => "0"), array("pseudo" => $_GET['pseudo']));
        deconnexion();
        header('Location: administration.php');
      }
      else
      {
        connexion("projet");
        $donnee = selectionnerPlusieurs($GLOBALS["nom_table"], array("*"));
        deconnexion();
        echo "<table>";
        echo "<thead>";
        echo "<td>Pseudo</td><td>Adresse E-Mail</td><td>Score</td><td>QCM réalisé</td><td>Droits</td>";
        echo "</thead>";
        for($i = 0; $i < count($donnee) - 1; ++$i)
        {
          echo "<tr>";
          echo "<td>" . $donnee[$i]['pseudo'] . "</td><td>". $donnee[$i]['email'] ."</td><td>" . prcent($donnee[$i]['bonreponse'], $donnee[$i]['qcm']*10) . "</td><td>". $donnee[$i]['qcm'] ."</td><td>" . $donnee[$i]['privilege'] . "</td><td>
          <a href='administration.php?type=reset&pseudo=" . $donnee[$i]['pseudo'] . "'><abbr title='Reset'><img src='images/reset.png' alt='Reset score'/></abbr></a>
          <a href='administration.php?type=sup&pseudo=" . $donnee[$i]['pseudo'] . "'><abbr title='Supprimer'><img src='images/sup.png' alt='Supprimer'/></abbr></a></td><br>";
          echo "</tr>";
        }
        echo "</table>";
      }
      ?>      
    </div>
  </div>
  <?php include('pied.php'); ?>
  </body>
</html>
