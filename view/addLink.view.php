
<div id="addLinkDiv">

    <!-- Display message soit display succes if succes soit display errorMessage if error lors de l'ajout du lien-->
    <!-- <div class="successMessage">
        <span><?= $link->getValidated() === 1 ? "setSuccessMessage" : "setErrorMessage"; ?></span>
    </div>
    <div class="errorMessage">
        <span><?= $link->getValidated() === 1 ? "succes" : "error"; ?></span>
    </div>
    -->

    <div class="contLinkAdd">
        <form action="/index.php?controller=link&action=add" method="POST">
            <div>
                <label for="hrefLink">Lien :</label>
                <input type="text" name="hrefLink" id="hrefLink" required>
            </div>
            <div>
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" required>
            </div>
            <input type="submit"  value="Ajouter le lien">
            <div class="homeBtn">
                <a href="/index.php">Retour</a>
            </div>
        </form>
    </div>

</div>

