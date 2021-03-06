<?php

use Songfolio\Core\Helper;


?>

<section id="content-banner" style="background-image:url(<?=Helper::host()?>public/img/img_front/album.jpg);">

</section>


<section id="section-events">
    <div class="container">
        <div class="row center">
            <div style="margin-top: 20px" class="col-lg-12 col-sm-12 col-12 events">

                <div class="nav">
                    Les morceaux
                </div>

                <div class="search-front-bar col-12 col-lg-6 col-md-6 col-sm-6">
                    <input class="input-control input-control-danger input-search" placeholder="Chercher un événement" />
                </div>
                <div class="list-events" style="list-style: none;padding: 0;">

                    <table class="table col-12 ">

                        <tbody class="tbody">
                            <?php foreach ($songs as $song) : ?>
                                <tr>

                                    <td class="image">
                                        <img style="max-width: 150px;" src="<?=Helper::host() . $song['img_dir'] ?? '' ?>" alt="">
                                    </td>
                                    <td class="title">
                                        <a href="<?= $song['slug'] ?>">
                                            <?= $song['name'] ?> <br> <small><?= $song['category_name'] ?? '' ?></small>
                                        </a>
                                    </td>
                                    <td class="info">
                                        <?= Helper::getFormatedDate($song['date_published']) ?>
                                    </td>

                                    <td>

                                        <div class="likes">

                                            <span class="nbr_likes_span"><?php if ($song['nbLikesSongs'] != 0) echo $song['nbLikesSongs'];
                                                                            else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                                            <input type="hidden" class="nbr_likes" value="<?= $song['nbLikesSongs'] ?>">
                                            <img class="<?php if ($user->__get('id')) echo 'add_like connected' ?>" height="18" width="18" src=" <?php if ($song['checkUserLike']) echo 'public/img/heart-like-active.svg';
                                                                                                                                            else echo 'public/img/heart-like.svg' ?>" alt="">
                                            <input type="hidden" class="type" value="songs">
                                            <input type="hidden" class="type_id" value="<?= $song['id'] ?>">
                                            <input type="hidden" class="user_id" value="<?= $user->__get('id') ?>">


                                        </div>

                                    </td>
                                </tr>

                            <?php endforeach; ?>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>