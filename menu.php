<div id="MENU">
  <table id="menu_tableau">
    <tr>
      <!-- Les th sont la juste pour passer la validation -->
      <th></th>
      <td><a href="planete.php" title="accueil">Accueil</a></td>
      <td><a href="qcm.php" title="QCM">QCM</a></td>
      <td><a href="leaderboard.php" title="LeaderBoard">LeaderBoard</a></td>
      <?php
      if(isset($_SESSION['privilege']) && $_SESSION['privilege'] == '1')
        echo '<td><a href="editeur.php" title="Editeur">Editeur</a></td>';
      ?>
    </tr>
  </table>
</div>
