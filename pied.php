<div id ="PIED_PAGE">
    <table id="pied_tableau">
        <tr>
            <td><?php
                include_once("fonction.php");
                connexion("projet");
                echo nbConnecte("planeteqcm", array("connecte" => "true"))." connecte(s)";
                deconnexion();
                ?>
            </td>
        </tr>
        <tr>
            <td><a href="planteteqcm@noreply.com">Contact</a></td>
            <?php
            $date= date("D d F Y");
            echo "<td>".($date)."</td>";
            ?>
        </tr>
    </table>
</div>
