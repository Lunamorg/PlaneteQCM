<div id="MENU">
    <table id="menu_tableau">
        <tr>
            <!-- Les th sont la juste pour passer la validation -->
            <th></th>
            <td><a <?php if($_SERVER['REQUEST_URI'] == "/PlaneteQCM/planete.php") echo "class='est_select'" ?> href="planete.php" title="accueil">Accueil</a></td>
            <td><a <?php if($_SERVER['REQUEST_URI'] == "/PlaneteQCM/qcm.php") echo "class='est_select'" ?>  href="qcm.php" title="QCM">QCM</a></td>
            <td><a <?php if($_SERVER['REQUEST_URI'] == "/PlaneteQCM/leaderboard.php") echo "class='est_select'" ?>  href="leaderboard.php" title="LeaderBoard">LeaderBoard</a></td>
          <?php
          if(isset($_SESSION['privilege']) && $_SESSION['privilege'] == '1')
          {
            $var = "";
            if($_SERVER['REQUEST_URI'] == '/PlaneteQCM/editeur.php')
              $var = 'class="est_select"';
            echo '<td><a '. $var .'href="editeur.php" title="Editeur">Editeur</a></td>';
          }
          ?>
        </tr>
    </table>
</div>
