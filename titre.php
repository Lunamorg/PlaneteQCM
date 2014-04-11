<div id="EN_TETE">
    <div id="menu_connexion">
        <ul>
            <li><a href="planete.php"     title="accueil">Accueil</a></li>
            <?php
            if(!isset($_SESSION['pseudo'])){
                echo '<li><a href="connection.php"  title="membre">Connexion</a></li>';
                echo '<li><a href="formulaire.php"  title="inscription">Inscription</a></li>';
            }
            else
            {
                echo '<li><a href="profil.php" title="profil">Profil</a></li>';
                echo '<li><a href="traitement.php?type=deconnexion"  title="D&eacute;connexion">D&eacute;connexion</a></li>';
            }
            ?>
        </ul>
    </div>
    <h2>PLANETE QCM</h2>
</div>
