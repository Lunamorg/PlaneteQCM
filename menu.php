<div id="MENU">
    <table id="menu_tableau">
        <thead>
        <tr>
            <td><a href="planete.php"     title="accueil">Accueil</a></td>
            <?php
                if(!isset($_SESSION['pseudo'])){
                    echo '<td><a href="formulaire.php"  title="inscription">Inscription</a></td>';
                    echo '<td><a href="connection.php"  title="membre">Connexion</a></td>';
                }
                else
                    echo '<td><a href="traitement.php?type=deconnexion"  title="deconnexion">deconnexion</a></td>';
            ?>

            <td><a href="profil.php" title="profil">Profil</a></td>
        </tr>
        </thead>
    </table>
</div>
