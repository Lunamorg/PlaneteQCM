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
    include("fonction.php");
    if(!isset($_SESSION['pseudo']) || $_SESSION['privilege'] != 1)
    {
      header("Location: planete.php");
      return;
    }
    ?>

    <div class="IMG_FOND">
      <div class="CORPS">
        <?php
        if(!isset($_GET['type'])) {
          echo "<p>Editer / Supprimer un QCM<br/>";
          foreach(listeMatiere("qcm") as $matiere) {
            echo $matiere . "<a href='editeur.php?type=mod&matiere=" . $matiere . "'><img src='images/modif.png' alt='Modifier'/></a>
          <a href='editeur.php?type=sup&matiere=" . $matiere . "'><img src='images/sup.png' alt='Supprimer'/></a><br/>";
          }
          echo "</p>
          <form method='post' action='editeur.php?type=add' enctype='multipart/form-data'>
            <p>Creer un QCM</p>
            <p>Le nom du qcm doit commencer par une majuscule, ne pas contenir de caractères sp&eacute;ciaux (accents compris) et ne doit pas exister. </p>
            <label>Nom de la matière</label><input type='text' name='matiere' id='matiere'/><br/>
            <label>Image à charger (.png)</label><input type='file' name='nom_image' id='nom_image'/><br/>
            <input type='submit' value='Cr&eacute;er'/>            
          </form>";
        } else if($_GET['type'] == 'sup') {
          supprimer_editeur($_GET['matiere']);
        } else if($_GET['type'] == 'add') {
          ajouter_editeur($_POST['matiere']);
        } else if($_GET['type'] == 'mod') {
          /**
           * Du html est ecrit dans cet fonction
           */
          modifier_editeur($_GET['matiere']);
        } else if($_GET['type'] == 'sav') {
          sauvegarderPlusieurs_editeur($_GET[matiere], $_POST);
        } else if($_GET['type'] == 'savun') {
          sauvegarderUn_editeur($_GET['matiere'], $_POST);
        }
        else if($_GET['type'] == 'supquestion')
        {
          supprimerElement("qcm/" . $_GET['matiere'] . "/qcm.txt", $_GET['question']);
        }
        ?>
      </div>
    </div>
    <?php include('pied.php'); ?>
  </body>
</html>
