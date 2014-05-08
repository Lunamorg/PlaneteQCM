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
        if(!isset($_GET['type'])) {
          echo "<p>Editer / Supprimer un QCM<br/>";
          foreach(listeMatiere("qcm") as $matiere) {
            echo $matiere . "<a href='editeur.php?type=mod&matiere=" . $matiere . "'><img src='images/modif.png' alt='Modifier'/></a>
          <a href='editeur.php?type=sup&matiere=" . $matiere . "'><img src='images/sup.png' alt='Supprimer'/></a><br/>";
          }
          echo "</p>
          <form method='post' action='editeur.php?type=add'>
            <p>Creer un QCM</p>
            <p>Le nom du qcm doit commencer par une majuscule, ne pas contenir de caractères sp&eacute;ciaux (accents compris) et ne doit pas exister. </p>
            <input type='text' name='matiere' id='matiere'/>
            <input type='submit' value='Cr&eacute;er'/>            
          </form>";
        } else if($_GET['type'] == 'sup') {
          unlink("qcm/" . $_GET['matiere'] . "/qcm.txt");
          rmdir("qcm/" . $_GET['matiere']);
        } else if($_GET['type'] == 'add') {
          mkdir("qcm/" . $_POST['matiere']);
          $fichier = fopen("qcm/" . $_POST['matiere'] . "/qcm.txt", "w");
          fclose($fichier);
        } else if($_GET['type'] == 'mod') {

          $i = 0;
          $j = 0;
          $reponse = array();
          $score = 0;

          foreach(lireQCM("qcm/" . $_GET['matiere'] . "/qcm.txt", false) as $valeur) {
            if($i % 3 == 2) {
              $reponse[$j] = $valeur;
              ++$j;
            }
            ++$i;
          }

          echo '<form method="post" action="editeur.php?type=sav&amp;matiere=' . $_GET['matiere'] . '"><div class="qr">';
          $i = 0;
          $j = 0;
          $k = 0;
          foreach(lireQCM("qcm/" . $_GET['matiere'] . "/qcm.txt", false) as $valeur) {

            if($i % 3 == 0) {
              echo '<div class="qr"><label>Question ' . (floor($i / 3)+1) . ' : </label> <input type="text" name="question' . (floor($i / 3)) . '" value=' . str_espace($valeur) . ' /><a class="a_qcm" href="editeur.php?type=supquestion&matiere=' . $_GET['matiere'] . '&question=' . (floor($i / 3)+1) . '">Supprimer</a><br/>';
            } else if($i % 3 == 1) {
              $tab = explode("$", $valeur);
              $j = 0;
              foreach($tab as $val) {
                ++$j;
                $t = "";
                if($j == $reponse[$k])
                  $t = 'checked="checked"';
                echo '<input type="radio" name="rep' . (floor($i / 3)) . '" value="' . $j . '" ' . $t . '/>' . '<input type="text" name="pro' . (floor($j)) . '-' . (floor($i / 3)) . '" value=' . str_espace($val) . ' />' . '<br/>';
              }
              ++$k;
              echo '</div><hr/>';
            }
            ++$i;
          }
          echo '<input type="submit" value="Soumettre"/>';
          echo '</div></form>';
          echo '<form method="post" action="editeur.php?type=savun&amp;matiere=' . $_GET['matiere'] . '">';
          echo '<div>';
          echo '<label>Question ' . (floor($i / 3)+1) . ' : </label><input type="text" name="question"/><br/>';
          echo '<input type="radio" name="n_choix" value="1"/><input type="text" name="pro1"/><br/>';
          echo '<input type="radio" name="n_choix" value="2"/><input type="text" name="pro2"/><br/>';
          echo '<input type="radio" name="n_choix" value="3"/><input type="text" name="pro3"/><br/>';
          echo '<input type="radio" name="n_choix" value="4"/><input type="text" name="pro4"/><br/>';
          echo '<input type="submit" value="Ajouter"/>';
          echo '</div></form>';
        } else if($_GET['type'] == 'sav') {
          $taille = count(lireQCM("qcm/" . $_GET['matiere'] . "/qcm.txt", false)) / 3;
          effacerFichier("qcm/" . $_GET['matiere'] . "/qcm.txt");
          for($j = 0; $j < $taille; ++$j) {
            $reponse = array();
            $i = 1;
            echo $_POST['question' . ($j)] . '<br/>';
            while(isset($_POST['pro' . $i . '-' . $j])) {
              $reponse[$i - 1] = $_POST['pro' . $i . '-' . $j];
              echo $reponse[$i - 1] . "<br/>";
              ++$i;
            }
            echo $_POST['rep' . ($j)] . '<br/>';
            sauvegarde("qcm/" . $_GET['matiere'] . "/qcm.txt", $_POST['question' . ($j)], $reponse, $_POST['rep' . ($j)]);
          }
        } else if($_GET['type'] == 'savun') {
          $reponse = array();
          $i = 1;
          echo $_POST['question'] . '<br/>';
          while(isset($_POST['pro' . $i])) {
            $reponse[$i - 1] = $_POST['pro' . $i];
            echo $reponse[$i - 1] . "<br/>";
            ++$i;
          }
          $reponse[$i-2] .= "\n";
          echo $_POST['n_choix'] . '<br/>';
          sauvegarde("qcm/" . $_GET['matiere'] . "/qcm.txt", $_POST['question'] . "\n", $reponse, $_POST['n_choix'] . "\n");
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
