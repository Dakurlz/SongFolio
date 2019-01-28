<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta data="description" content="Ma description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Front</title>

    <!--Main css -->
    <link rel="stylesheet" href="<?php echo BASE_URL."public/css/style.css?v=".filemtime("public/css/style.css" ); ?>">
</head>
<body>
    <header>
        <div class="container">
            <div class="row no-margin middle between">
                <a href="#" id="logo-image" style="background-image:url('/public/img/logo_queen.png');"></a>
                <nav>
                    <ul>
                        <li>
                            <a href="#premium">Premium</a></li>
                        </li>
                        <li>
                            <a href="#aide">Aide</a>
                        </li>
                        <li>
                            <a href="#telecharger">Télécharger</a>
                        </li>
                        <li>
                            <a>|</a>
                        </li>
                        <li>
                            <a href="#inscrire">S'inscrire</a>
                        </li>
                        <li>
                            <a href="#connecter">Se connecter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
<main>
    <?php
    include $this->v;
    ?>
</main>
<footer>
    <div class="container">
        <div class="row middle all-height">
            <div class="col-3 left">
                Copyright Queens
            </div>
            <div class="col-6 center">
                <a href="" >Billeterie</a>
                <a href="" >Billeterie</a>
                <a href="" >Billeterie</a>
            </div>
            <div class="col-3 right">
                Site créé avec Songfolio
            </div>
        </div>
    </div>
</footer>
</body>
</html>