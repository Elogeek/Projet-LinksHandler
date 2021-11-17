<div id="containerContact">
    <h1>Contacter le support technique</h1>

    <div class="formContact">
        <form action="/index.php?controller=contact&action=contact" method="post">
            <div>
                <label for="mail">Email</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div>
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div>
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="8" cols="63"></textarea>
            </div>
            <div class="homeBtn">
                <input type="submit" name="submit" value=" Nous contacter" ">
                <a href="/index.php">Retour</a>
            </div>
        </form>
    </div>
</div>