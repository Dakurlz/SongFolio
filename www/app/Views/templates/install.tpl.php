<?php
use Songfolio\Core\Helper;
?>

<!DOCTYPE html>
<html id="install-html">
<head>
    <meta charset="utf-8">
    <meta data="description" content="<?= $settings['config']['site_desc'] ?? 'Made with Songfolio' ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= $settings['config']['site_tags'] ?? '' ?>">
    <title>Songfolio - Installation</title>

    <!--Main css -->
    <link rel="stylesheet" href="<?php echo Helper::host()."public/css/style.css?v=".filemtime("public/css/style.css" ); ?>">
</head>
<body id="install-body">
    <header>
        <img id="logo" src="<?=Helper::host()?>public/img/logo_songfolio.png">
        <nav>
            <ul>
                <li class="active">
                    Présentation
                </li>
                <li>
                    Base de donnée
                </li>
                <li>
                    Configuration
                </li>
                <li>
                    Administrateur
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php $this->addModal("session_alert"); ?>

        <?php
        include $this->view_path;
        ?>
    </main>
    <footer id="front_footer">
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</body>
</html>