<div id="EN_TETE">
    <div id="menu_connexion">
        <ul>
          <?php
          if(!isset($_SESSION['pseudo'])) {
            echo '<li><a href="connexion.php"  title="Connexion">Connexion</a></li>';
            echo '<li><a href="formulaire.php"  title="Inscription">Inscription</a></li>';
          } else {
            if(isset($_SESSION['privilege']) && $_SESSION['privilege'] == '1')
              echo '<li><a href="administration.php" title="Admin">Admin</a></li>';
            echo '<li><a href="profil.php" title="profil">Profil</a></li>';
            echo '<li><a href="traitement.php?type=deconnexion"  title="D&eacute;connexion">D&eacute;connexion</a></li>';
          }
          ?>
        </ul>
    </div>
    <h2>PLANETE QCM</h2>
</div>
