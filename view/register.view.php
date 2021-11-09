<div id="divRegister">

    <div id="containerRegister">

        <form action="/index.php?controller=user&action=register" method="POST">
            <div>
                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname" required>
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
                <label for="pass">Mot de passe
                    <i id="help" class="fas fa-question-circle">
                        <span id="text"></span>
                    </i>
                </label>
                <input type="password" name="pass" id="pass" required>
            </div>
            <div>
                <label for="passRepeat"> Repeat password :</label>
                <input type="password" name="passRepeat" id="passRepeat" required>
            </div>
            <div class ="homeBtn">
                <input type="submit" class="buttonSubmit" value="S'inscrire" name="submit">
                <a href="/index.php">Retour</a>
            </div>
        </form>
    </div>

</div>

<script>
    // Design link help for the registration user

    let span = document.querySelector('#help');

    span.addEventListener('click',visibilityText);
    span.addEventListener('dblclick',hiddenText);

    /* Visibility text */
    function visibilityText() {
        document.getElementById('text').innerHTML = ' il doit contenir plus de 5 caractères,des chiffres, des majuscules et des minuscules :';
        span.style.fontSize = "2rem";
    }

    /* Hidden text */
    function hiddenText(){
        document.getElementById('text').innerHTML = "";
    }


</script>