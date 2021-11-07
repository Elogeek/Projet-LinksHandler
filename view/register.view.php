<div id="containerRegister">

    <form action="/index.php?controller=user&action=register" method="POST">
        <div>
            <label for="lastname">Prénom :</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div>
            <label for="name">Nom de famille :</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="mail">Adresse mail :</label>
            <input type="email" name="mail" id="mail" required>
        </div>
        <div>
            <label for="pass">Mot de passe :</label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <div>
            <label for="passRepeat"> Repeat password :</label>
            <input type="password" name="passRepeat" id="passRepeat" required>
        </div>

        <input type="submit" class="buttonSubmit" value="S'inscrire" name="login-submit">
        <div class ="homeBtn">
            <a href="/index.php">Retour</a>
        </div>
    </form>
</div>


