<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />

   <script src="https://cdn.ckeditor.com/4.11.3/full/ckeditor.js"></script>

   <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/style.css?v=" . filemtime("public/css/style.css"); ?>" />
   <title>Admin</title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>

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

            <a href="<?php echo Routing::getSlug("Admin", "loadAuth") ?>" class=" link col-lg-6 col-sm-6" onclick="">Déconnexion</a>
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
            <li>
               <a href="<?php echo Routing::getSlug("Admin", "default") ?>">
                  <div class="sidebar--item">
                     <img src="<?php echo BASE_URL . "public/img/Home_Icon.svg"; ?> " />
                     <p>Tableau de board</p>
                  </div>
               </a>
               <a href="<?php echo Routing::getSlug("Contents", "createContents") ?>">
                  <div class="sidebar--item">
                     <img src="<?php echo BASE_URL . "public/img/two-overlapped-web-pages.svg"; ?>" />
                     <p>Pages</p>
                  </div>
               </a>
               <a href="<?php echo Routing::getSlug("Admin", "loadUser") ?>">
                  <div class="sidebar--item">
                     <img src="<?php echo BASE_URL . "public/img/users-silhouettes.svg"; ?>" />
                     <p>Utilisateurs</p>
                  </div>
               </a>
               <a href="#">
                  <div class="sidebar--item">
                     <img src="<?php echo BASE_URL . "public/img/comments.svg"; ?>" />
                     <p>Commentaires</p>
                  </div>
               </a>
               <a href="<?php echo Routing::getSlug("Admin", "loadAlbum") ?>">
                  <div class="sidebar--item">
                     <img src="<?php echo BASE_URL . "public/img/music-album.svg"; ?>" />
                     <p>Albums</p>
                  </div>
               </a>
               <a href="#">
                  <div class="sidebar--item">
                     <img src="<?php echo BASE_URL . "public/img/galerie.svg"; ?>" />
                     <p>Galerie</p>
                  </div>
               </a>
            </li>
         </ul>
      </div>
      <div class="main-back__content">
         <div class="container-fluid">
            <?php if (isset($alert['danger'])) : ?>
               <div class="alert alert-danger">
                  <?php foreach ($alert['danger'] as $danger) : ?>
                     <li><?php echo $danger; ?></li>
                  <?php endforeach; ?>
               </div>
            <?php endif; ?>
            <?php if (isset($alert['success'])) : ?>
               <div class="alert alert-danger">
                  <?php foreach ($alert['success'] as $success) : ?>
                     <li><?php echo $success; ?></li>
                  <?php endforeach; ?>
               </div>
            <?php endif; ?>

            <?php
            include $this->view_path;
            ?>
         </div>
      </div>
   </main>



   <script src="<?php echo BASE_URL . "public/js/modal.js"; ?>"></script>
   <script src="<?php echo BASE_URL . "public/js/jquery-3.3.1.min.js"; ?>"></script>
   <script src="<?php echo BASE_URL . "public/js/jquery-ui.min.js?v=" . filemtime("public/js/front.js"); ?>"></script>
   <script src="<?php echo BASE_URL . "public/js/back.js?v=" . filemtime("public/js/back.js"); ?>"></script>
</body>

</html>