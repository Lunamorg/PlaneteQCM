<div id="fond_perdu_pied">
  <div id="PIED_PAGE">
    <table id="pied_tableau">
      <tr>
        <td><?php
          include_once("fonction.php");
          connexion("projet");
          $con = nbConnecte("planeteqcm", array("connecte" => "true"));
          echo  $con . " membre" . (($con > 1) ? "s" : "") ." connecté". (($con > 1) ? "s" : "");
          deconnexion();
          ?>
        </td>
      
        <td><a href="mailto:planteteqcm@noreply.com">Contact</a></td>
        <?php
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
        echo "<td>" . (strftime("%A %d %B %Y")) . "</td>";
        ?>
      </tr>
    </table>
  </div>
</div>
