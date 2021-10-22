<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$tittle?></title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <script src="https://kit.fontawesome.com/e3ddf954eb.js" crossorigin="anonymous"></script>

</head>
<body>
<div id="container">
    <header>
        <div id="newLink"><a href="/public/index.php?controller=link"><i class="fas fa-plus-square"></i> Ajouter un lien</a></div>
        <div id="account"><a href="/public/index.php?controller=user&action=logout" title="Déconnexion"><i class="fas fa-user-circle"></i></a></div>
    </header>
    <?=$html?>
</div>
</body>
</html>
