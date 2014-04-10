<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <head>
    <title>sans titre</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.23.1" />
    <link rel="stylesheet" type="text/CSS" href="planete.css"/>
  </head>

  <body>
    <?php include('titre.php'); ?>
    <?php include('menu.php'); ?>
    
    <div id ="CORPS">
            
      <?php
      echo "<h3>QCM Sport</h3>";
      if(file_exists("sport.txt")) {
        $fichier = fopen("sport.txt", "r");
        $nbre = 1;
          
        while($nbre < 5) {    
          $question = fgets($fichier);
          echo "<p>Question ".$nbre.":</p>";
          echo $question;
          ++$nbre;
        }
        fclose($fichier);
        }
      ?>
      
      
    </div>
    
    <?php include('pied.php'); ?>    
  </body>

</html>
