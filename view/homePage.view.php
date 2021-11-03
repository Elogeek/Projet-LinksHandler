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

<!-- Graphics here-->
<div class="containerGraphics">

    <!--Graphi here Le nombre de fois ou un lien a été visité (par lien et par utilisateur)-->
    <h2>Top 10 des liens les plus aimés</h2>
    <!--Graphic here Le nombre total cumulé de clics sur les liens pour l'utilisateur connecté-->
    <h2>Vos liens favoris</h2>
    <!--No graphic Le nombre de liens présents dans le système pour l'utilisateur connecté-->
    <h2>Tous les liens</h2>
    <!--No graphic Le nombre de lien en commun avec d'autres utilisateurs-->
    <h2>Tous les liens en commun avec les autres utilisateurs</h2>

</div>