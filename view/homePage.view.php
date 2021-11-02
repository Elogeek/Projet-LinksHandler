<h1>Accueil</h1>
<div class="homePage">
    <?php
    foreach($data[0] as $link) {
        $a = '';
        if(isset($_SESSION['id'])) {
            $a = '<a href="index.php?controller=link&action=update&id=' . $link->getId() . '"><i class="far fa-edit"></i></a>';
        } ?>
        <div class="linkImage">
            <div class="optionLink">
                <a href="/index.php?controller=link&action=update&id"><i class="fas fa-edit"></i></a>
                <a href="/index.php?controller=link&action=delete&id"><i class="fas fa-trash-alt"></i></a>
            </div>
            <div class="image"><img src="/assets/image/imgLinks.webp" alt="Image"></div>
            <div class="linkName"><a href="<?= $link->getHref()?>" target="<?= $link->getTarget()?>"><?= $link->getName()?></a></div>
        </div> <?php
    } ?>
</div>