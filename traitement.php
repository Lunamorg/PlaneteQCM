<?php
session_start();
include_once('fonction.php');

if(estCorrect($_GET['type']))
{
    if($_GET['type'] == 'inscription')
    {
        if(estCorrect(array($_POST['pseudo'], $_POST['mdp'], $_POST['email']))) {
            connexion('projet');
            ajouter('planeteqcm', array($_POST['pseudo'], $_POST['mdp'], $_POST['email'], '0', "true"));
            deconnexion();
            $_SESSION['pseudo'] = $_POST['pseudo'];
            echo "enregistre";
        }
    }
    else if($_GET['type'] == 'connexion')
    {
        connexion('projet');
        $resultat = selectionner('planeteqcm', array('mdp'), array("pseudo" => $_POST['pseudo']));
        deconnexion();
        if($resultat['mdp'] == $_POST['mdp'])
        {
            $_SESSION['pseudo'] = $_POST['pseudo'];
            connexion('projet');
            maj("planeteqcm", array("connecte" => "true"), array("pseudo" => $_POST['pseudo']));
            deconnexion();
        }
    }
    else if($_GET['type'] == 'deconnexion')
    {
        connexion('projet');
        maj("planeteqcm", array("connecte" => "false"), array("pseudo" => $_SESSION['pseudo']));
        deconnexion();
        session_destroy();
    }
}
else
{
    connexion('projet');
    maj("planeteqcm", array("connecte" => "false"), array("pseudo" => "Lunamorg"));
    deconnexion();
    echo "page incorrect";
}
header('location: planete.php');
?>
