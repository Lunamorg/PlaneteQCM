<?php
session_start();
include_once('fonction.php');
/**
 * Privileges:  0 -> User
 *              1 -> Administrateur
 */
if(estCorrect($_GET['type'])) {
  if($_GET['type'] == 'inscription') {
    if(estCorrect(array($_POST['pseudo'], $_POST['mdp'], $_POST['email']))) {
      connexion('projet');
      ajouter('planeteqcm', array($_POST['pseudo'], cryptage($_POST['mdp']), $_POST['email'], "true", "0", "0", "0"));
      deconnexion();
      $_SESSION['pseudo'] = $_POST['pseudo'];

      echo "enregistre";
    }
  } else if($_GET['type'] == 'suppression') {
    connexion('projet');
    supprimer("planeteqcm", array("pseudo" => $_SESSION['pseudo']));
    deconnexion();
    session_destroy();
    header('location: traitement.php?type=deconnexion');
  } else if($_GET['type'] == 'connexion') {
    connexion('projet');
    $resultat = selectionner('planeteqcm', array('mdp', 'privilege'), array("pseudo" => $_POST['pseudo']));
    deconnexion();
    if($resultat['mdp'] == cryptage($_POST['mdp'])) {
      $_SESSION['pseudo'] = $_POST['pseudo'];
      $_SESSION['privilege'] = $resultat['privilege'];
      connexion('projet');
      maj("planeteqcm", array("connecte" => "true"), array("pseudo" => $_POST['pseudo']));
      deconnexion();
    }
  } else if($_GET['type'] == 'deconnexion') {
    connexion('projet');
    maj("planeteqcm", array("connecte" => "false"), array("pseudo" => $_SESSION['pseudo']));
    deconnexion();
    session_destroy();
  } else if($_GET['type'] == 'admin') {
    connexion('projet');
    ajouter('planeteqcm', array($_GET['pseudo'], cryptage($_GET['mdp']), $_GET['email'], '0', "false", "1"));
    deconnexion();
  } else if(isset($_GET['type']) && $_GET['type'] == "modmdp")
  {
    connexion("projet");
    $var = selectionner("planeteqcm", array("mdp"), array("pseudo" => $_GET['pseudo']));
    if(cryptage($_POST['amdp']) == $var['mdp'])
      maj("planeteqcm", array("mdp" => cryptage($_POST['mdp'])), array("pseudo" => $_GET['pseudo']));
    deconnexion();
  }
} else {
  echo "page incorrect";
}
header('location: planete.php');
?>
