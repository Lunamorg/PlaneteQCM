<div id="PIED_PAGE">
  <table id="pied_tableau">
    <tr>
      <td><?php
        include_once("fonction.php");
        connexion("projet");
        echo nbConnecte("planeteqcm", array("connecte" => "true")) . " connecte(s)";
        deconnexion();
        ?>
      </td>
    </tr>
    <tr>
      <td><a href="planteteqcm@noreply.com">Contact</a></td>
      <?php
      setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
      echo "<td>" . (strftime("%A %d %B %Y.")) . "</td>";
      ?>
    </tr>
  </table>
</div>
