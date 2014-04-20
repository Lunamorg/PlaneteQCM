<?php
/*
 *  Contient des fonctions pour simplifier le code
 */


/*
 * Connexion a la base de donnee
 * parametre: aucun
 * retourne: rien
 */
function connexion($nomBDD)
{
  mysql_connect("localhost", "root", "") or die ('ERREUR ' . mysql_error());
  mysql_select_db($nomBDD);
}

/*
 * Deconnexion de la base de donnee
 * parametre: aucun
 * retourne: rien
 */
function deconnexion()
{
  mysql_close();
}

/*
 * Ajoute des donnees a la base de donnee
 * parametre: nom de la table, tableau associatif contenant les donnees
 * retourne: rien
 */
function ajouter($nomTable, $donnees)
{
  $req = "INSERT INTO " . $nomTable . " ";
  $req .= "VALUES(";
  foreach($donnees as $cle => $valeur) {
    if(gettype($valeur) == "string")
      $req .= "'";
    $req .= $valeur;
    if(gettype($valeur) == "string")
      $req .= "'";
    $req .= ",";
  }
  $req = substr($req, 0, -1);
  $req .= ")";
  mysql_query($req) or die ('ERREUR ' . mysql_error());
}

/*
 * Met a jour les donnees dans la base de donnee
 * parametre: nom de la table, tableau associatif contenant les donnees, tableau associatif pour savoir où
 *              on modifie(UNE SEULE DONNEE AU TABLEAU!)
 * retourne: rien
 */
function maj($nomTable, $donnees, $where)
{
  $req = "UPDATE " . $nomTable . " ";
  $req .= "SET ";
  foreach($donnees as $cle => $valeur) {
    $req .= $cle . "=";
    if(gettype($valeur) == "string")
      $req .= "'";
    $req .= $valeur;
    if(gettype($valeur) == "string")
      $req .= "'";
    $req .= ",";
  }
  $req = substr($req, 0, -1);
  if($where != null) {
    foreach($where as $key => $value) {
      $req .= " WHERE " . $key . "=";
      if(gettype($value) == "string")
        $req .= "'" . $value . "' ";
      else
        $req .= $value . " ";
    }
  }
  mysql_query($req) or die ('ERREUR ' . mysql_error());
}


/*
 * Supprime les donnees dans la base de donnee
 * parametre: nom de la table, tableau associatif pour savoir où
 *              on modifie(UNE SEULE DONNEE AU TABLEAU!)
 * retourne: rien
 */
function supprimer($nomTable, $where)
{
  $req = "DELETE FROM " . $nomTable;
  if($where != null) {
    foreach($where as $key => $value) {
      $req .= " WHERE " . $key . "=";
      if(gettype($value) == "string")
        $req .= "'" . $value . "' ";
      else
        $req .= $value . " ";
    }
  }
  mysql_query($req) or die ('ERREUR ' . mysql_error());
}

/*
 * Selectionne les donnees dans la base de donnee
 * parametre: nom de la table, tableau associatif contenant les donnees a recuperer, tableau associatif pour savoir où
 *              on modifie(UNE SEULE DONNEE AU TABLEAU! Peut être égal a * pour obtenir tous les champs)
 * retourne: un tableau associatif contenant les reponses
 */
function selectionner($nomTable, $donnee, $where = null)
{
  $req = "SELECT ";
  foreach($donnee as $valeur) {
    $req .= $valeur . ",";
  }
  $req = substr($req, 0, -1);

  $req .= " FROM " . $nomTable . " ";
  if($where != null) {
    foreach($where as $key => $value) {
      $req .= "WHERE " . $key . "=";
      if(gettype($value) == "string")
        $req .= "'" . $value . "' ";
      else
        $req .= $value . " ";
    }
  }
  $res = mysql_query($req) or die ('ERREUR ' . mysql_error());
  return mysql_fetch_assoc($res);
}

/*
 * Crypte la chaine de caracteres passée en argument
 * parametre: chaine de caracteres a crypter
 * retourne: rien
 */
function cryptage($str)
{
  return md5($str);
}

/*
 * Retourne vrai si la variable ou le tableau passee en parametre est non vide et existe sinon retourne faux
 * parametre: une variable ou un tableau
 * retourne: true ou false (voir description)
 */
function estCorrect($par)
{
  if(!isset($par) || empty($par))
    return false;
  if(gettype($par) != "array") {
    return !empty($par);
  } else {
    foreach($par as $valeur) {
      if(empty($valeur))
        return false;
    }
    return true;
  }
}

/*
 * Retourne le nombre de personnes connectes lu dans la base de donnee
 * parametre: le nom de la table, tableau associatif pour savoir où on lit
 * retourne: le nombre de connecte
 */
function nbConnecte($nomTable, $where)
{
  $req = "SELECT *";

  $req .= " FROM " . $nomTable . " ";
  if($where != null) {
    foreach($where as $key => $value) {
      $req .= "WHERE " . $key . "=";
      if(gettype($value) == "string")
        $req .= "'" . $value . "' ";
      else
        $req .= $value . " ";
    }
  }
  $res = mysql_query($req) or die ('ERREUR ' . mysql_error());
  return mysql_num_rows($res);
}

/*
 * Lit les QCM dans le fichier
 * parametre: le nom du fichier
 * retourne: un tableau dont les indices pairs sont les questions et impairs les reponses
 */
function lireQCM($fichier)
{
  $f = fopen($fichier, "rb");
  $tab = array();
  $i = 0;
  while(!feof($f)) {
    $question = fgets($f);
    $reponse = fgets($f);
    $tab[$i] = $question;
    $tab[$i + 1] = $reponse;
    $i += 2;
  }
  fclose($f);
  while($i % 3 != 0) {
    array_pop($tab);
    --$i;
  }
  return $tab;
}

/*
 * Liste tous les fichiers d'un dossier
 * parametre: le dossier
 * retourne: un tableau contenant les nom des fichiers lu
 */
function listeMatiere($dossier)
{
  $dir = opendir($dossier);
  $liste = array();
  $i = 0;
  while($fichier = readdir($dir)) {
    $tab = explode(".", $fichier);
    if(count($tab) == 1) {
      $liste[$i] = $fichier;
      ++$i;
    }
  }
  return $liste;
}

function effacerFichier($fichier)
{
  $f = fopen($fichier, "wb");
  fputs($f, "");
  fclose($f);
}

function sauvegarde($fichier, $question, $proposition, $reponse)
{
  $f = fopen($fichier, "ab");
  fputs($f, $question);
  $pr = "";
  foreach($proposition as $p) {
    $pr .= $p . "-";
  }
  $pr = substr($pr, 0, -1);
  fputs($f, $pr);
  fputs($f, $reponse);
  fclose($f);
}

function supprimerElement($fichier, $numQuestion)
{
  echo "supprimer question";
  $tab = lireQCM($fichier);
  $f = fopen($fichier, "w");
  fputs($f,"");
  fclose($f);
  for($i=0; $i<count($tab); $i += 3)
  {
    if($i/3 != $numQuestion-1)
    {
      $t = explode("-", $tab[$i+1]);
      sauvegarde($fichier, $tab[$i], $t, $tab[$i+2]);
    }
  }
  echo "question supprim&eacute;";
}

function str_espace($donnee)
{
  return str_replace(' ', '&nbsp;', $donnee);
}

?>
