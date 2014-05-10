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
  <?php include('titre.php');
  include('menu.php');
  include("fonction.php"); ?>

  <div class="IMG_FOND">
    <div class="CORPS">
      <?php
      if(isset($_GET['cor']) && $_GET['cor'] == "false") {
        if(!isset($_SESSION['pseudo']))
          header("Location: connexion.php?err=con");
        formulaire_qcm($_GET['matiere']);
      } 
      else if(isset($_GET['cor']) && $_GET['cor'] == "true") {
        if(count($_POST) == 0)
          header("Location: qcm.php");
        corrige_qcm($_GET['matiere'], $_POST, $_SESSION['pseudo']);
        echo "<a style='text-align: center;' href='qcm.php' alt='Retour au choix du qcm'>Retour</a>";
      } 
      else {
        choixMatiere_qcm();
      }
      ?>
    </div>
  </div> 
  <?php include('pied.php'); ?>
  </body>
</html>
