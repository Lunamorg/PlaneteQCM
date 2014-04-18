<?php
session_start();
include_once('fonction.php');
/**
 * Privileges:  0 -> User
 *              1 -> Administrateur
 */
if (estCorrect($_GET['type'])) {
  if ($_GET['type'] == 'inscription') {
    if (estCorrect(array($_POST['pseudo'], $_POST['mdp'], $_POST['email']))) {
      connexion('projet');
      ajouter('planeteqcm', array($_POST['pseudo'], cryptage($_POST['mdp']), $_POST['email'], '0', "true", "1"));
      deconnexion();
      $_SESSION['pseudo'] = $_POST['pseudo'];

      echo "enregistre";
    }
  } else if ($_GET['type'] == 'suppression') {
    connexion('projet');
    supprimer("planeteqcm", array("pseudo" => $_SESSION['pseudo']));
    deconnexion();
    header('location: traitement.php?type=deconnexion');
  } else if ($_GET['type'] == 'connexion') {
    connexion('projet');
    $resultat = selectionner('planeteqcm', array('mdp', 'privilege'), array("pseudo" => $_POST['pseudo']));
    deconnexion();
    if ($resultat['mdp'] == cryptage($_POST['mdp'])) {
      $_SESSION['pseudo'] = $_POST['pseudo'];
      $_SESSION['privilege'] = $resultat['privilege'];
      connexion('projet');
      maj("planeteqcm", array("connecte" => "true"), array("pseudo" => $_POST['pseudo']));
      deconnexion();
    }
  } else if ($_GET['type'] == 'deconnexion') {
    connexion('projet');
    maj("planeteqcm", array("connecte" => "false"), array("pseudo" => $_SESSION['pseudo']));
    deconnexion();
    session_destroy();
  }
} else {
  echo "page incorrect";
}
header('location: planete.php');
?>
