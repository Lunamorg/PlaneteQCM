<?php
/* Contient des fonctions pour simplifier le code */
 
/* Connexion a la base de donnee */
 
function connexion($nomBDD)
{
  mysql_connect("localhost", "root", "") or die ('ERREUR ' . mysql_error());
  mysql_select_db($nomBDD);
}

/* Deconnexion de la base de donnee */

function deconnexion()
{
  mysql_close();
}

/* Ajoute des donnees a la base de donnee */

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
 * Selectionne plusieurs resultat dans la base de donnee (plusieurs 'membres')
 */
function selectionnerPlusieurs($nomTable, $donnee, $where = null)
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
  $var = array();
  for($i = 0; $var[$i] = mysql_fetch_array($res); ++$i);
  return $var;
}

/*
 * fonction de comparaison pour la fonction usort contenu dans rangerParScore
 */
function cmp($a, $b)
{
  return ($a['score'] < $b['score']) - ($a['score'] > $b['score']);
}

/*
 * Range la table de donnee par ordre décroissant des scores
 */
function rangerParScore($nomTable, $donnee, $where = null)
{
  $resultat = selectionnerPlusieurs($nomTable, $donnee, $where);
  $tab = array();
  for($i = 0; $i < count($resultat)-1; ++$i)
  {
    $tab[$i] = array('score' =>  prcent($resultat[$i]['bonreponse'], $resultat[$i]['qcm']*10),
                     'pseudo' => $resultat[$i]['pseudo']);
  }
  usort($tab, "cmp");
  return $tab;
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
 *  Lit les QCM dans le fichier
 */
function lireQCM($fichier, $aleatoire)
{
  $f = fopen($fichier, "rb");
  $tab = array();
  $i = 0;
  $nbQcm = 0;
  while(!feof($f)) {
    $question = fgets($f);
    $reponse = fgets($f);
    $tab[$i] = $question;
    $tab[$i + 1] = $reponse;
    $i += 2;
    $nbQcm += 2;
  }
  fclose($f);
  while($i % 3 != 0) {
    array_pop($tab);
    --$i;
    --$nbQcm;
  }
  /*
   * Generation de 10 nombres aleatoires différents
   */
  if($aleatoire == true)
  {
    $index = array();
    for($var = 0; $var < 10; ++$var)
    {
      $continuer = true;
      while($continuer == true)
      {
        $continuer = false;
        $aleat = mt_rand(0, $nbQcm/3 - 1);

        for($var2 = 0; $var2 < $var; ++$var2)
        {
          if($aleat == $index[$var2])
          {
            $continuer = true;
            break;
          }
        }
        if($continuer == false)
          $index[$var] = $aleat;
      }
    }


    $tab2 = array();
    for($var = 0; $var < 10; ++$var)
    {
      for($var2 = 0; $var2 < 3; ++$var2)
        $tab2[$var*3+$var2] = $tab[$index[$var]*3+$var2];
    }
    return $tab2;
  }
  return $tab;
}

/*
  *Liste tous les fichiers d'un dossier
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

/*
 * Efface le contenu d'un fichier
 */
function effacerFichier($fichier)
{
  $f = fopen($fichier, "wb");
  fputs($f, "");
  fclose($f);
}

/*
 * Sauvegarde dans le fichier les donnees passees en parametre
 */
function sauvegarde($fichier, $question, $proposition, $reponse)
{
  $f = fopen($fichier, "ab");
  fputs($f, $question);
  $pr = "";
  foreach($proposition as $p) {
    $pr .= $p . "$";
  }
  $pr = substr($pr, 0, -1);
  fputs($f, $pr);
  fputs($f, $reponse);
  fclose($f);
}


/*
 * Remplace les espaces par l'encodage html
 */
function str_espace($donnee)
{
  return str_replace(' ', '&nbsp;', $donnee);
}

/*
 * Enregistre dans la base de donnee le nouveau score
 */
function score($score, $pseudo)
{
  connexion("projet");
  $res = selectionner("planeteqcm", array("qcm", "bonreponse"), array("pseudo" => $pseudo));
  maj("planeteqcm", array("qcm" => $res["qcm"] + 1, "bonreponse" => $score + $res["bonreponse"]), array("pseudo" => $pseudo));
  deconnexion();
}

/*
 * calcule le pourcentage de bonne reponse
 */
function prcent($num, $den)
{
  if($den == 0)
    return 0;
  return number_format($num * 100 / $den, 2);
}

/*********************************** Fonctions editeur.php ***************************************/
/*
 * Supprime un element du fichier
 */
function supprimerElement_editeur($fichier, $numQuestion)
{
  $tab = lireQCM($fichier, false);
  $f = fopen($fichier, "w");
  fputs($f,"");
  fclose($f);
  for($i=0; $i<count($tab); $i += 3)
  {
    if($i/3 != $numQuestion-1)
    {
      $t = explode("$", $tab[$i+1]);
      sauvegarde($fichier, $tab[$i], $t, $tab[$i+2]);
    }
  }
}


function supprimer_editeur($matiere)
{
  unlink("qcm/" . $matiere . "/qcm.txt");
  rmdir("qcm/" . $matiere);
  unlink("images/" . $matiere . ".png");
}

function ajouter_editeur($matiere)
{
  mkdir("qcm/" . $matiere);
  $fichier = fopen("qcm/" . $matiere . "/qcm.txt", "w");
  fclose($fichier);
  $chemin = 'images/';
  move_uploaded_file($_FILES['nom_image']['tmp_name'],$chemin.$matiere.".png");
}

function modifier_editeur($matiere)
{
  $i = 0;
  $j = 0;
  $reponse = array();

  foreach(lireQCM("qcm/" . $matiere . "/qcm.txt", false) as $valeur) {
    if($i % 3 == 2) {
      $reponse[$j] = $valeur;
      ++$j;
    }
    ++$i;
  }

  echo '<form method="post" action="editeur.php?type=sav&amp;matiere=' . $matiere . '"><div class="qr">';
  $i = 0;
  $k = 0;
  foreach(lireQCM("qcm/" . $matiere . "/qcm.txt", false) as $valeur) {

    if($i % 3 == 0) {
      echo '<div class="qr"><label>Question ' . (floor($i / 3)+1) . ' : </label> <input type="text" name="question' . (floor($i / 3)) . '" value=' . str_espace($valeur) . ' /><a class="a_qcm" href="editeur.php?type=supquestion&matiere=' . $matiere . '&question=' . (floor($i / 3)+1) . '">Supprimer</a><br/>';
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
  echo '<form method="post" action="editeur.php?type=savun&amp;matiere=' . $matiere . '">';
  echo '<div>';
  echo '<label>Question ' . (floor($i / 3)+1) . ' : </label><input type="text" name="question"/><br/>';
  echo '<input type="radio" name="n_choix" value="1"/><input type="text" name="pro1"/><br/>';
  echo '<input type="radio" name="n_choix" value="2"/><input type="text" name="pro2"/><br/>';
  echo '<input type="radio" name="n_choix" value="3"/><input type="text" name="pro3"/><br/>';
  echo '<input type="radio" name="n_choix" value="4"/><input type="text" name="pro4"/><br/>';
  echo '<input type="submit" value="Ajouter"/>';
  echo '</div></form>';
}

function sauvegarderPlusieurs_editeur($matiere, $post)
{
  $taille = count(lireQCM("qcm/" . $matiere . "/qcm.txt", false)) / 3;
  effacerFichier("qcm/" . $matiere . "/qcm.txt");
  for($j = 0; $j < $taille; ++$j) {
    $reponse = array();
    $i = 1;
    echo $post['question' . ($j)] . '<br/>';
    while(isset($post['pro' . $i . '-' . $j])) {
      $reponse[$i - 1] = $post['pro' . $i . '-' . $j];
      echo $reponse[$i - 1] . "<br/>";
      ++$i;
    }
    echo $post['rep' . ($j)] . '<br/>';
    sauvegarde("qcm/" . $matiere . "/qcm.txt", $post['question' . ($j)], $reponse, $post['rep' . ($j)]);
  }
}

function sauvegarderUn_editeur($matiere, $post)
{
  $reponse = array();
  $i = 1;
  echo $post['question'] . '<br/>';
  while(isset($post['pro' . $i])) {
    $reponse[$i - 1] = $post['pro' . $i];
    echo $reponse[$i - 1] . "<br/>";
    ++$i;
  }
  $reponse[$i-2] .= "\n";
  echo $post['n_choix'] . '<br/>';
  sauvegarde("qcm/" . $matiere . "/qcm.txt", $post['question'] . "\n", $reponse, $post['n_choix'] . "\n");
}


/***************************************** Fonctions qcm.php ******************************************/
function choixMatiere_qcm()
{
  $i = 0;
  echo "<table class='choix_matiere'>";
  foreach(listeMatiere("qcm") as $valeur) {
    ++$i;
    if($i % 2 != 0) {
      echo " <tr>
                     <td style='background-image: url(images/" . $valeur . ".png); background-repeat: no-repeat; background-size: 200px 200px;'>
                       <a href='qcm.php?matiere=" . $valeur . "&amp;cor=false'>Commencer</a>
                     </td>";
    } else {
      echo "   <td style='background-image: url(images/" . $valeur . ".png); background-repeat: no-repeat; background-size: 200px 200px;'>
                       <a href='qcm.php?matiere=" . $valeur . "&amp;cor=false'>Commencer</a>
                     </td>
                   </tr> ";
    }
  }
  echo "</table>";
}

function corrige_qcm($matiere, $post, $pseudo)
{
  $i = 0;
  $j = 0;
  $reponse = array();
  $score = 0;

  foreach(lireQCM("qcm/" . $matiere . "/qcm.txt", true) as $valeur) {
    if($i % 3 == 2) {
      $reponse[$j] = $valeur;
      ++$j;
    }
    ++$i;
  }
  $i = 0;
  $k = 0;
  foreach(lireQCM("qcm/" . $matiere . "/qcm.txt", true) as $valeur) {
    if($i % 3 == 0) {
      echo "<p>" . $valeur . "</p><br/>";
    }
    else if($i % 3 == 1) {
      $tab = explode("$", $valeur);
      $j = 0;
      foreach($tab as $val) {
        ++$j;
        if($post['rep' . (floor($i / 3))] == $j && $j == $reponse[$k] || $j == $reponse[$k]) {
          echo '<span class="rep_bon">' . $val . '</span><br/>';
          $score += ($post['rep' . (floor($i / 3))] == $j);
        }
        else if($post['rep' . (floor($i / 3))] == $j && $j != $reponse[$k])
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
  score($score, $pseudo);
}

function formulaire_qcm($matiere)
{
  echo '<form method="post" action="qcm.php?matiere=' . $matiere . '&amp;cor=true"><div>';
  $i = 0;
  foreach(lireQCM("qcm/" . $matiere . "/qcm.txt", true) as $valeur) {

    if($i % 3 == 0) {
      echo "<p>" . $valeur . "</p><br/>";
    }
    else if($i % 3 == 1) {
      $tab = explode("$", $valeur);
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
}

?>