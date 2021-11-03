
<h1 class="center">Contacter le support technique</h1>

    <form action="/assets/php/contact.php" method="post">
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
            <textarea id="message" name="message"></textarea>
        </div>
        <input type="submit" name="submit" value=" Nous contacter" class="button">
    </form>