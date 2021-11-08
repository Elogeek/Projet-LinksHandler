<div class="userConnect">

    <div id="loginContainer">
        <form action="/index.php?controller=user&action=login" method="POST">
            <div>
                <label for="mail">Adresse mail :</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>

            <input type="submit" class="buttonSubmit" value="Se connecter" name="login-submit">
            <div class ="homeBtn">
                <a href="/index.php?controller=user&action=display-form-registration-user">Pas encore inscrit?</a>
                <a href="/index.php">Retour</a>
            </div>
        </form>
    </div>

</div>