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
    <table>
      <thead>
        <th>Classement</th><th>Pseudo</th><th>Score</th>
        <?php
        include_once("fonction.php");
        connexion("projet");
        $tab = rangerParScore($GLOBALS["nom_table"], array('pseudo', 'bonreponse', 'qcm'));
        deconnexion();
        $classement = 1;
        foreach($tab as $valeur)
        {
          echo "<tr>
                  <td>".$classement."</td>
                  <td>".$valeur['pseudo']."</td>
                  <td>".$valeur['score']."</td>
                </tr>";
          ++$classement;
        }
        ?>
      </thead>
    </table>
  </div>
</div>
<?php include('pied.php'); ?>
</body>
</html>
