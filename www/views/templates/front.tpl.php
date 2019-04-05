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
<body id="front-body">
    <header>
        <div class="container">
            <div class="row no-margin header-top between middle">
                <a href="#" id="logo-image" style="background-image:url('<?php echo PUBLIC_DIR?>img/logo_queen.png');"></a>
                <a id="show-menu" href="#">&#9776;</a>
                <ul>
                    <li>
                        <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                    </li>
                    <li>
                        <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                    </li>
                    <li>
                        <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                    </li>
                    <li>
                        <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                    </li>
                </ul>
            </div>
            <nav class="row no-margin">
                <div class="mobile">
                    <ul>
                        <li>
                            <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                        </li>
                        <li>
                            <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                        </li>
                        <li>
                            <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                        </li>
                        <li>
                            <a href=""><img src="<?php echo PUBLIC_DIR?>img/fb.png"></a>
                        </li>
                    </ul>
                    <button type="button" id="hide-menu" />
                </div>

                <ul>
                    <?php foreach((new Menus(2))->__get('data') as $menu):?>
                    <li>
                        <a href="<?=$menu['link'] ?? '#'?>"><?=$menu['title']?></a>

                        <?php if(isset($menu['children'])):?>
                            <div class="menu-content">
                            <ul>
                                <?php foreach($menu['children'] as $child_menu):?>
                                <li>
                                    <a href="<?=$child_menu['link'] ?? '#'?>"><?=$child_menu['title']?></a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <?php endif;?>
                    </li>
                    <?php endforeach;?>
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
        <?php
        include $this->view_path;
        ?>
    </main>
    <footer id="front_footer">
        <div class="container">
            <nav class="row middle">
                <div class="col-md-3 col-6">
                    <ul>
                        <li>
                            <h2>
                                Notre groupe
                            </h2>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                </div>
                <div class="col-md-3 col-6">
                    <ul>
                        <li>
                            <h2>
                                Médias
                            </h2>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <ul>
                        <li>
                            <h2>
                                Liens utiles
                            </h2>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <ul>
                        <li>
                            <h2>
                                Suivez nous
                            </h2>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                        <li>
                            <a href="#">link 1</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="row between signature">
                <div class="col-5 tal">
                    Copyright QUEEN 1900-2019
                </div>
                <div class="col-5 tar">
                    Site créé avec Songfolio
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?php echo BASE_URL."public/js/front.js?v=".filemtime("public/js/front.js" ); ?>"></script>
</body>
</html>