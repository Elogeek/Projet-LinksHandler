
<div id="addLinkDiv">

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


            <div>
                <input class="homeBtn" type="submit"  value="Ajouter le lien" name="submit">
                <a class="homeBtn" href="/index.php">Retour</a>
            </div>

        </form>

    </div>


</div>
