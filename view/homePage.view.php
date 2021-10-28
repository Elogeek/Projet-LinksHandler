
<div id="homePage">
    <h1>Accueil</h1><?php
    foreach($data[0] as $link) {
        $a = '';
        if(isset($_SESSION['id'])) {
            $a = '<a href="index.php?controller=link&action=update&id=' . $link->getId() . '"><i class="far fa-edit"></i></a>';
        } ?>
        <div class="linkImage">
            <div class="image"><img src="/public/assets/image/imgLinks.webp" alt="Image"></div>
            <div class="linkName"><a href="<?= $link->getHref()?>" target="<?= $link->getTarget()?>"><?= $link->getName()?></a></div>
        </div> <?php
    } ?>
</div>