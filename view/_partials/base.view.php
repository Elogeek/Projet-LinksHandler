<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $tittle ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://kit.fontawesome.com/e3ddf954eb.js" crossorigin="anonymous"></script>

</head>
<body>
<div id="container">
    <!--if the user is connected then I display the disconnection button-->
     <?php
        if(isset($_SESSION['id']) && $_SESSION['id'] === TRUE) { ?>
            <header>
                <div class="newLink">
                    <a href="/index.php?controller=link&action=add">
                        <i class="fas fa-plus-square"></i>
                        Ajouter un lien
                    </a>
                </div>

                <div class="account" id="btnDisconnect">
                    <a href="/index.php?controller=user&action=logout" title="Déconnection">
                        <i class="fas fa-user-slash"></i>
                        Déconnexion
                    </a>
                </div>
            </header> <?php
        }
        else { ?>
            <header>
                <div id="newLink">
                    <a href="/index.php?controller=link&action=add">
                        <i class="fas fa-plus-square"></i>
                        Ajouter un lien
                    </a>
                </div>
                <div class="account" id="btnConnect">
                    <a href="/index.php?controller=user&action=login" title="Connexion">
                        <i class="fas fa-user-circle"></i>
                        Connexion
                    </a>
                </div>
            </header>
            <?php

        }
    ?>


    <!-- The html content from the ob_get_clean() -->
    <?= $html ?>

</div>

</body>
</html>
