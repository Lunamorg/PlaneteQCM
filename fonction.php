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
    mysql_connect("localhost", "root",  "") or die ('ERREUR '.mysql_error());
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
    $req = "INSERT INTO ".$nomTable." ";
    $req .= "VALUES(";
    foreach($donnees as $cle => $valeur)
    {
        if(gettype($valeur) == "string")
            $req .= "'";
        $req .= $valeur;
        if(gettype($valeur) == "string")
            $req .= "'";
        $req .= ",";
    }
    $req = substr($req, 0, -1);
    $req .= ")";
    mysql_query($req) or die ('ERREUR '.mysql_error());
}

/*
 * Met a jour les donnees dans la base de donnee
 * parametre: nom de la table, tableau associatif contenant les donnees, tableau associatif pour savoir où
 *              on modifie(UNE SEULE DONNEE AU TABLEAU!)
 * retourne: rien
 */
function maj($nomTable, $donnees, $where)
{
    $req = "UPDATE ".$nomTable." ";
    $req .= "SET ";
    foreach($donnees as $cle => $valeur)
    {
        $req .= $cle."=";
        if(gettype($valeur) == "string")
            $req .= "'";
        $req .= $valeur;
        if(gettype($valeur) == "string")
            $req .= "'";
        $req .= ",";
    }
    $req = substr($req, 0, -1);
    if($where != null)
    {
        foreach($where as $key => $value)
        {
            $req .= " WHERE ".$key."=";
            if(gettype($value) == "string")
                $req .= "'".$value."' ";
            else
                $req .= value." ";
        }
    }
    mysql_query($req) or die ('ERREUR '.mysql_error());
}


/*
 * Supprime les donnees dans la base de donnee
 * parametre: nom de la table, tableau associatif pour savoir où
 *              on modifie(UNE SEULE DONNEE AU TABLEAU!)
 * retourne: rien
 */
function supprimer($nomTable, $where)
{
    $req = "DELETE FROM ".$nomTable;
    if($where != null)
    {
        foreach($where as $key => $value)
        {
            $req .= " WHERE ".$key."=";
            if(gettype($value) == "string")
                $req .= "'".$value."' ";
            else
                $req .= value." ";
        }
    }
    mysql_query($req) or die ('ERREUR '.mysql_error());
}

/*
 * Selectionne les donnees dans la base de donnee
 * parametre: nom de la table, tableau associatif contenant les donnees a recuperer, tableau associatif pour savoir où
 *              on modifie(UNE SEULE DONNEE AU TABLEAU! Peut être égal a * pour obtenir tous les champs)
 * retourne: rien
 */
function selectionner($nomTable, $donnee, $where = null)
{
    $req = "SELECT ";
    foreach($donnee as $valeur)
    {
        $req .= $valeur.",";
    }
    $req = substr($req, 0, -1);

    $req .= " FROM ".$nomTable." ";
    if($where != null)
    {
        foreach($where as $key => $value)
        {
            $req .= "WHERE ".$key."=";
            if(gettype($value) == "string")
                $req .= "'".$value."' ";
            else
                $req .= value." ";
        }
    }
    $res = mysql_query($req) or die ('ERREUR '.mysql_error());
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
    if(gettype($par) != "array")
    {
        return !empty($par);
    }
    else
    {
        foreach($par as $valeur)
        {
            if(empty($par))
                return false;
        }
        return true;
    }
}

function nbConnecte($nomTable, $where)
{
    $req = "SELECT *";

    $req .= " FROM ".$nomTable." ";
    if($where != null)
    {
        foreach($where as $key => $value)
        {
            $req .= "WHERE ".$key."=";
            if(gettype($value) == "string")
                $req .= "'".$value."' ";
            else
                $req .= value." ";
        }
    }
    $res = mysql_query($req) or die ('ERREUR '.mysql_error());
    return  mysql_num_rows($res);
}

?>
