
<div id="addLinkDiv">
    <form action="../public/index.php?controller=link&action=add" method="POST">
        <div>
            <label for="hrefLink">Lien:</label>
            <input type="text" name="hrefLink" id="hrefLink" required>
        </div>
        <div>
            <label for="title">Titre:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <input type="submit" id="buttonSubmit" value="Ajouter le lien">
    </form>
    <div class="backButton"><a href="../public/index.php">Retour</a></div>
</div>