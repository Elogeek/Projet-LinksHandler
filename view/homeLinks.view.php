
<?php

use Elogeek\LinksHandler\Model\Manager\LinkManager;

$linkManager = new LinkManager();
$allLinks = $linkManager->getLinks($_SESSION['user']);

?>
<div class="homePage"><?php
foreach ($allLinks as $link)
{
    ?>
    <div class="linkImage">
        <div class="image"><img src="/assets/image/imgLinks.webp" alt="img par défault"></div>
        <div class="linkName"><a href="<?=$link->getHref()?>" target="<?=$link->getTarget()?>"><?=$link->getTitle()?></a></div>
    </div>
    <?php
}
?>
</div>