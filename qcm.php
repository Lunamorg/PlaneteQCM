<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <title>Planete QCM</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.23.1" />
    <link rel="stylesheet" type="text/CSS" href="planete.css"/>
</head>

<body>
<?php include('titre.php'); ?>
<?php include('menu.php'); ?>
<?php include("fonction.php"); ?>

<div id ="CORPS">
    <?php
    if(isset($_GET['qcm']))
    {
        if(!isset($_GET['cor']))
        {
            echo '<form method="POST" action="qcm.php?matiere=maths&qcm=qcm1&cor=true">';
            $i = 0;
            foreach(lireQCM("qcm/sport/".$_GET["qcm"].".txt") as $valeur)
            {

                if($i % 3 == 0)
                {
                    echo "<p>".$valeur."</p><br/>";
                }
                else if($i % 3 == 1)
                {
                    $tab = explode("-", $valeur);
                    $j = 0;
                    foreach($tab as $val)
                    {
                        ++$j;
                        echo '<input type="radio" name="rep'.(floor($i/3)).'" value="'.$j.'" />'.$val.'<br/>';
                    }
                    echo '<hr/>';
                }
                ++$i;
            }

            echo '<input type="submit" value="Soumettre"/>';
            echo '</form>';
        }
        else
        {
            $i = 0;
            $j = 0;
            $reponse = array();
            $score = 0;

            foreach(lireQCM("qcm/sport/".$_GET["qcm"].".txt") as $valeur)
            {
                if($i%3 == 2)
                {
                    $reponse[$j] = $valeur;
                    ++$j;
                }
                ++$i;
            }
            $i = 0;
            $k = 0;
            foreach(lireQCM("qcm/sport/".$_GET["qcm"].".txt") as $valeur)
            {

                if($i % 3 == 0)
                {
                    echo "<p>".$valeur."</p><br/>";
                }
                else if($i % 3 == 1)
                {
                    $tab = explode("-", $valeur);
                    $j = 0;
                    foreach($tab as $val)
                    {
                        ++$j;
                        if($_POST['rep'.(floor($i/3))] == $j && $j == $reponse[$k] || $j == $reponse[$k]){
                            echo '<span class="rep_bon">'.$val.'</span><br/>';
                            $score +=  ($_POST['rep'.(floor($i/3))] == $j);
                        }
                        else if($_POST['rep'.(floor($i/3))] == $j && $j != $reponse[$k])
                            echo '<span class="rep_faux">'.$val.'</span><br/>';
                        else
                            echo '<span>'.$val.'</span><br/>';

                    }
                    echo '<hr/>';
                    ++$k;
                }
                ++$i;
            }

            echo "<h4>SCORE: ".$score."/".floor($i/3)."-".number_format($score*100/floor($i/3), 2)."% </h4>";
        }
    }
    else
    {

    }
    ?>
</div>

<?php include('pied.php'); ?>
</body>
</html>
