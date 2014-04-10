<?php
  include_once('fonction.php');
  if(estCorrect(array($_POST['pseudo'], $_POST['mdp'], $_POST['email']))) {
    connexion('projet');
    selectionner('planeteqcm', array($_POST['pseudo'], $_POST['mdp'], $_POST['email']));
    deconnexion();
  }
  header('location: ajouter.php?id='.$_POST['pseudo']);
?>
