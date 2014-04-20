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

<div class="CORPS">
  <?php
  if(isset($_GET['cor']) && $_GET['cor'] == "false") {
    if(!isset($_SESSION['pseudo']))
      header("Location: connexion.php?err=con");
    echo '<form method="post" action="qcm.php?matiere=' . $_GET['matiere'] . '&amp;cor=true"><div>';
    $i = 0;
    foreach(lireQCM("qcm/" . $_GET['matiere'] . "/qcm.txt") as $valeur) {

      if($i % 3 == 0) {
        echo "<p>" . $valeur . "</p><br/>";
      } else if($i % 3 == 1) {
        $tab = explode("-", $valeur);
        $j = 0;
        foreach($tab as $val) {
          ++$j;
          echo '<input type="radio" name="rep' . (floor($i / 3)) . '" value="' . $j . '" />' . $val . '<br/>';
        }
        echo '<hr/>';
      }
      ++$i;
    }

    echo '<input type="submit" value="Soumettre"/>';
    echo '</div></form>';
  } else if(isset($_GET['cor']) && $_GET['cor'] == "true") {
    $i = 0;
    $j = 0;
    $reponse = array();
    $score = 0;

    foreach(lireQCM("qcm/" . $_GET['matiere'] . "/qcm.txt") as $valeur) {
      if($i % 3 == 2) {
        $reponse[$j] = $valeur;
        ++$j;
      }
      ++$i;
    }
    $i = 0;
    $k = 0;
    foreach(lireQCM("qcm/" . $_GET['matiere'] . "/qcm.txt") as $valeur) {

      if($i % 3 == 0) {
        echo "<p>" . $valeur . "</p><br/>";
      } else if($i % 3 == 1) {
        $tab = explode("-", $valeur);
        $j = 0;
        foreach($tab as $val) {
          ++$j;
          if($_POST['rep' . (floor($i / 3))] == $j && $j == $reponse[$k] || $j == $reponse[$k]) {
            echo '<span class="rep_bon">' . $val . '</span><br/>';
            $score += ($_POST['rep' . (floor($i / 3))] == $j);
          } else if($_POST['rep' . (floor($i / 3))] == $j && $j != $reponse[$k])
            echo '<span class="rep_faux">' . $val . '</span><br/>';
          else
            echo '<span>' . $val . '</span><br/>';

        }
        echo '<hr/>';
        ++$k;
      }
      ++$i;
    }

    echo "<h4>SCORE: " . $score . "/" . floor($i / 3) . "-" . number_format($score * 100 / floor($i / 3), 2) . "% </h4>";
  } else {
    $i = 0;
    echo "<table class='choix_matiere'>";
    foreach(listeMatiere("qcm") as $valeur) {
      ++$i;
      if($i % 2 != 0) {
        echo " <tr>
                 <td style='background-image: url(images/" . $valeur . ".jpg);'>
                   <a href='qcm.php?matiere=" . $valeur . "&amp;cor=false'>Commencer</a>
                 </td>";
      } else {
        echo "   <td style='background-image: url(images/" . $valeur . ".jpg);'>
                   <a href='qcm.php?matiere=" . $valeur . "&amp;cor=false'>Commencer</a>
                 </td>
               </tr> ";
      }
    }
    echo "</table>";
  }
  ?>
</div>

<?php include('pied.php'); ?>
</body>
</html>
