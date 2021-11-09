
<div id="designDeleteLink">

    <form action="/index.php?controller=link&action=delete&id=<?= $data['link']->getId() ?>" method="POST">
        <div>
            <span>Voulez-vous supprimer le lien?</span>
        </div>
        <div class="homeBtn">
            <input class="deleteBtn" type="submit" id="buttonSubmit" value="supprimer le lien" name="submit">
            <a href="/index.php">Retour</a>
        </div>
    </form>

</div>

