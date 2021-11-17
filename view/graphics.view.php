
<!-- Graphics here-->
    <h2>Les statistiques de mes liens</h2>
    <?php
    $totalClick = 0;
    $totalLink = 0;
    $userId = $_SESSION['id']; ?>
    <div class="containerGraphics">
        <h3>Vos statistiques</h3><?php
        if(count($data['link']) !== 0) {
            foreach($data['link'] as $link) {
                if($userId === $link->getUserFk()->getId()) {
                    $totalClick += $link->getClick();
                    $totalLink++;?>
                    <div class="statLink">Le lien <b><?= $link->getName() ?></b> a été visité <b><?= $link->getClick() ?></b> fois.</div> <?php
                }
            }

        } ?>
        <br>
        <div class="statLink total">Vous avez <b><?= $totalLink ?></b> liens en tous.</div>
        <div class="statLink total">Vous avez clické <b><?= $totalClick ?></b> fois sur <?= $link->getName() ?>.</div>
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
    <div class="homeBtn">
        <a href="index.php">Retour à mon profil</a>
    </div>


