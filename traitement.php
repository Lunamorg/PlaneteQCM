<?php
  include_once('fonction.php');
  if(id == inscription)
  if(estCorrect(array($_POST['pseudo'], $_POST['mdp'], $_POST['email']))) {
    connexion('projet');
    ajouter('planeteqcm', array($_POST['pseudo'], $_POST['mdp'], $_POST['email']));
    deconnexion();
  }
  header('location: ajouter.php?id='.$_POST['pseudo']);
?>
