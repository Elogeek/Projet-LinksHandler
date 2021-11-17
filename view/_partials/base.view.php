<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Links Handler</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/menu.css">
    <script src="https://kit.fontawesome.com/e3ddf954eb.js" crossorigin="anonymous"></script>

</head>
<body>
<div id="containerLinks">
    <!--Display your error div with the message contained in $error-->
    <?php
    if(isset($error)) { ?>
        <div class="errorMessage"><?= $error ?></div> <?php
    }
    if(isset($success)){ ?>
        <!--Display your success div with the message contained in $success-->
        <div class="successMessage"><?= $success ?></div> <?php
    }
    ?>

    <!-- If the user is connected then I display the disconnection button-->
     <?php
        if(isset($_SESSION['id']) && $_SESSION['id'] === TRUE) { ?>
            <header>
                <div class="flex-item">
                    <a href="/index.php?controller=link&action=display-add-link-form">
                        <i class="fas fa-plus-square"></i>
                        Ajouter un lien
                    </a>
                </div>
                <div class="flex-item">
                    <a href="/index.php?controller=user&action=display-contact-form">
                        <i class="fas fa-envelope"></i>
                        Nous contacter
                    </a>
                </div>
                <div class="flex-item">
                    <a href="/index.php?controller=user&action=get-graph-stat-link">
                        <i class="fas fa-chart-line"></i>
                        Mes statistiques
                    </a>
                </div>
                <div class="flex-item" id="btnDisconnect">
                    <a href="/index.php?controller=user&action=logout" title="Déconnection">
                        <i class="fas fa-user-slash"></i>
                        Déconnexion
                    </a>
                </div>
            </header> <?php
            // If the user is not logged in then I display the login page
        }
        else { ?>
            <header>
                <div id="flex-item">
                    <a href="/index.php?controller=link">
                        <i class="fas fa-plus-square"></i>
                        Ajouter un lien
                    </a>
                </div>
                <div class="flex-item" id="btnConnect">
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



<script src="/node_modules/chart.js/dist/chart.js"></script>
<script src="public/assets/js/graphics.js" type="javascript"></script>
</body>
</html>