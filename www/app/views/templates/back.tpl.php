<?php
$backConfigs = yaml_parse_file(__DIR__ . '/../../config/back.global.yml');
$sectionName = explode('/', $_SERVER['REQUEST_URI'])[2] ?? 'dashboard';

use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
use Songfolio\Models\Users;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />

   <link rel="stylesheet" href="<?= BASE_URL . "public/css/style.css?v=" . filemtime("public/css/style.css"); ?>" />
   <link rel="stylesheet" href="<?= BASE_URL . "public/css/datetimepicker.css?v=" . filemtime("public/css/datetimepicker.css"); ?>" />

   <title>Admin</title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
   <script src="https://cdn.ckeditor.com/4.11.3/full/ckeditor.js"></script>
</head>

<body>

   <header class="header-back">
      <div class="row">
         <div class="row__logo col-lg-6 col-sm-6">
            <div class="toggle-nav">
               <span></span>
            </div>
            <h1>SongFolio</h1>
            <h2>Admin 1.0</h2>
         </div>
         <div class="row__logout col-lg-6 col-sm-6">

            <a href="<?= Routing::getSlug('users', 'logout') ?>>" class=" link col-lg-6 col-sm-6" onclick="">Déconnexion</a>
         </div>
      </div>
   </header>


   <main class="main-back">
      <div class="sidebar">
         <div class="sidebar__admin-name">
            <img class="logo" src="<?php echo BASE_URL . "public/img/user-image.svg"; ?>" />
            <div>
               <b>
                  <p>Ivan</p>
               </b>
               <b>
                  <p>Naluzhnyi</p>
               </b>
            </div>
         </div>
         <ul class="sidebar__property">

            <?php foreach ($backConfigs['sidebar_items'] as $key => $item) : ?>
               <li>

                  <div class="sidebar--item <?= $key === $sectionName ? 'item-active' : '' ?>">
                     <button class="button_href" onclick="location.href='<?= Routing::getSlug(
                                                                              $item['slug']['controller'],
                                                                              $item['slug']['action']
                                                                           ) ?>'">
                        <img src="<?= BASE_URL . "public/img/$key.svg"; ?> " />
                        <p><?= $item['name'] ?></p>
                     </button>
                     <?php if (isset($item['dropdown'])) : ?>
                        <?php foreach ($item['dropdown']['slugs'] as $keyDropdown => $slug) : ?>
                           <?php if (Users::hasPermission($keyDropdown)) : ?>
                              <span class="pages-options slide-dropbtn "></span>
                           <?php endif; ?>
                           <?php break;
                        endforeach ?>
                     <?php endif; ?>
                  </div>
                  <?php if (isset($item['dropdown'])) : ?>
                     <div class="slide-dropdown-content  ">
                        <?php foreach ($item['dropdown']['slugs'] as $keyDropdown => $slug) : ?>
                           <?php if (Users::hasPermission($keyDropdown)) : ?>
                              <a id='<?= $keyDropdown ?>' href="<?= Routing::getSlug($slug['controller'], $slug['action']) ?>">
                                 <?= $slug['label'] ?>
                              </a>
                           <?php endif; ?>
                        <?php endforeach ?>
                     </div>
                  <?php endif ?>

               </li>
            <?php endforeach ?>

         </ul>
      </div>

      <div class="main-back__content">
         <div class="container-fluid">

            <div class="header">
               <img src="<?= BASE_URL . 'public/img/' . $sectionName . '.svg' ?? 'default.svg'; ?>" />
               <p><?= Helper::getLabelFromMapping($sectionName ?? 'admin') ?></p>
            </div>


             <?php $this->addModal("session_alert"); ?>

            <?php
            include $this->view_path;
            ?>
         </div>
      </div>
   </main>

   <script src="<?php echo BASE_URL . "public/js/jquery-3.3.1.min.js"; ?>"></script>
   <script src="<?= BASE_URL . "public/js/datetimepicker.js"; ?>"></script>
   <script src="<?php echo BASE_URL . "public/js/jquery-ui.min.js" ?>"></script>
   <script src="<?php echo BASE_URL . "public/js/modal.js?v=" . filemtime("public/js/modal.js"); ?>"></script>
   <script src="<?php echo BASE_URL . "public/js/back.js?v=" . filemtime("public/js/back.js"); ?>"></script>
   <?php if (isset($js) && is_array($js)) : ?>
      <?php foreach ($js as $js_name) : ?>
         <script src="<?php echo BASE_URL . "public/js/" . $js_name . ".js?v=" . filemtime("public/js/" . $js_name . ".js"); ?>"></script>
      <?php endforeach; ?>
   <?php endif; ?>
</body>

</html>