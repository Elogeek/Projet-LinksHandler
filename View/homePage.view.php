
<div id="menu"> <?php
    if(!isset($_SESSION['id'])) { ?>
        <div id="buttonProfile"><a href="../public/index.php?controller=user" title="Connexion"><i class="fas fa-user-circle"></i></a></div> <?php
    }
    else { ?>
        <header>
            <div id="newLink"><a href="../public/index.php?controller=link"><i class="fas fa-plus-square"></i> Ajouter un lien</a></div>
            <div id="account"><a href="../public/index.php?controller=user&action=logout" title="Déconnexion"><i class="fas fa-user-circle"></i></a></div>
        </header>
        <?php
    }?>
</div>
<div id="homePage">
    <?php if(count($data) !== 0) {
        foreach($data[0] as $link) {
            $a = '';
            if(isset($_SESSION['id'])) {
                $a = '<a href="index.php?controller=link&action=update&id=' . $link->getId() . '"><i class="far fa-edit"></i></a>';
            }?>
            <div class="linkImage">
                <div class="image"><?= $a ?></div>
                <div class="linkName"><a href="<?= $link->getHref()?>" target="<?= $link->getTarget()?>"><?= $link->getName()?></a></div>
            </div> <?php
        }
    } ?>
</div>