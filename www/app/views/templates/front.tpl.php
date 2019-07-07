<?php

use \Songfolio\Models\Menus;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta data="description" content="<?= $settings['config']['site_desc'] ?? 'Made with Songfolio' ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= $settings['config']['site_tags'] ?? '' ?>">
    <title><?= $settings['config']['site_name'] ?? 'Songfolio' ?></title>

    <!--Main css -->
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/style.css?v=" . filemtime("public/css/style.css"); ?>">
    <?php if (file_exists('public/css/generated.css')) : ?>
        <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/generated.css?v=" . filemtime("public/css/generated.css"); ?>">
    <?php endif; ?>
</head>

<body id="front-body">
    <header>
        <div class="container">
            <div class="row no-margin header-top between middle">
                <a href="/" id="logo-image" style="background-image:url(<?= $settings['header']['header_logo'] ?? PUBLIC_DIR . 'img/logo_songfolio.png' ?>)"></a>
                <a id="show-menu" href="#">&#9776;</a>
                <ul>
                    <?php if (isset($settings['config']['fb_url'])) : ?>
                        <li>
                            <a href="<?= $settings['config']['fb_url'] ?>"><img src="<?php echo PUBLIC_DIR ?>img/fb.jpg"></a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($settings['config']['twitter_url'])) : ?>
                        <li>
                            <a href="<?= $settings['config']['twitter_url'] ?>"><img src="<?php echo PUBLIC_DIR ?>img/twitter.jpg"></a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($settings['config']['insta_url'])) : ?>
                        <li>
                            <a href="<?= $settings['config']['insta_url'] ?>"><img src="<?php echo PUBLIC_DIR ?>img/instagram.jpg"></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <nav class="row no-margin">
                <div class="mobile">
                    <ul>
                        <?php if (isset($settings['config']['fb_url'])) : ?>
                            <li>
                                <a href="<?= $settings['config']['fb_url'] ?>"><img src="<?php echo PUBLIC_DIR ?>img/fb.jpg"></a>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($settings['config']['twitter_url'])) : ?>
                            <li>
                                <a href="<?= $settings['config']['twitter_url'] ?>"><img src="<?php echo PUBLIC_DIR ?>img/twitter.jpg"></a>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($settings['config']['insta_url'])) : ?>
                            <li>
                                <a href="<?= $settings['config']['insta_url'] ?>"><img src="<?php echo PUBLIC_DIR ?>img/instagram.jpg"></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <button type="button" id="hide-menu"> </button>
                </div>

                <ul>
                    <?php foreach ((new \Songfolio\Models\Menus($settings['header']['header_menu']))->__get('data') as $menu) : ?>
                        <li>
                            <a href="<?= $menu['link'] ?? '#' ?>"><?= $menu['title'] ?></a>

                            <?php if (isset($menu['children'])) : ?>
                                <div class="menu-content">
                                    <ul>
                                        <?php foreach ($menu['children'] as $child_menu) : ?>
                                            <li>
                                                <a href="<?= $child_menu['link'] ?? '#' ?>"><?= $child_menu['title'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <li>
                        <a href="#connecter">Mon compte</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div id="menu-mask"></div>
    <button type="button" id="gototop" class="hide"></button>

    <main>
        <?php $this->addModal("session_alert"); ?>

        <?php
        include $this->view_path;
        ?>
    </main>
    <footer id="front_footer">
        <div class="container">
            <nav class="row">
                <?php
                $col_nb = 12 / $settings['footer']['footer_menu_nb'];
                ?>

                <?php foreach ($settings['footer']['footer_menu'] as $menu_id) : ?>
                    <?php $menu = new Menus($menu_id); ?>
                    <div class="col-md-<?= $col_nb ?> col-6">
                        <ul>
                            <li>
                                <h2>
                                    <?= $menu->__get('title') ?>
                                </h2>
                            </li>
                            <?php foreach ($menu->__get('data') as $link) : ?>
                                <li>
                                    <a href="<?= $link['link'] ?? '#' ?>"><?= $link['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </nav>
            <div class="row between signature">
                <div class="col-5 tal">
                    <?= $settings['footer']['copyright'] ?>
                </div>
                <div class="col-5 tar">
                    Site créé avec Songfolio
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?= BASE_URL . "public/js/front.js?v=" . filemtime("public/js/front.js"); ?>"></script>
</body>

</html>