
<div id="updateLink">

    <form action="/index.php?controller=link&action=update&id=<?= $data['link']->getId() ?>" method="POST">
        <div>
            <label for="hrefLink">Lien :</label>
            <input type="text" name="hrefLink" id="hrefLink" required value="<?= $data['link']->getHref() ?>">
        </div>

        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" required value="<?= $data['link']->getTitle() ?>">
        </div>

        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required value="<?= $data['link']->getName() ?>">
        </div>

        <input type="submit" id="buttonSubmit" value="Modifier le lien" name="submit">
    </form>
    <div class="deleteBtn">
        <a href="/index.php?controller=link&action=delete&id=<?= $data['link']->getId() ?>">Supprimer le lien</a>
    </div>
    <div class="homeBtn">
        <a href="/index.php">Retour</a>
    </div>

</div>
