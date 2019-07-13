<?php

use Songfolio\Core\Helper;

?>

<section id="content-core">
    <div class="container">
        <div class="row center">
            <div class="col-md-8 col-sm-10 col-12">
                <div class="event-page">

                    <div class="row">

                        <div class="col-lg-5 col-md-5 col-12">

                            <?php if ($song->__get('img_dir')) : ?>
                                <img height="150" width="100%" src="<?= $song->__get('img_dir') ?>" alt="">
                            <?php endif; ?>

                            <div class="display-content">

                                <div class="display-like-title">
                                    <h3><?= $song->__get('name') ?></h3>
                                    <div  class="likes">
                                        <span class="nbr_likes_span"><?php if ($nb_like != 0) echo $nb_like;
                                                                        else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                                        <input type="hidden" class="nbr_likes" value="<?= $nb_like ?>">
                                        <img class="<?php if ($user->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if ($checkUserLike) echo 'public/img/heart-like-active.svg';
                                                                                                                                        else echo 'public/img/heart-like.svg' ?>" alt="">
                                        <input type="hidden" class="type" value="songs">
                                        <input type="hidden" class="type_id" value="<?= $song->__get('id') ?>">
                                        <input type="hidden" class="user_id" value="<?= $user->__get('id') ?>">

                                    </div>
                                </div>


                                <?php if (isset($album_name)) : ?>
                                    <p>Album : <?= $album_name ?></p>
                                <?php endif ?>


                                <p>Publie le : <?= Helper::getFormatedDate($song->__get('date_published')) ?></p>
                                <?php if ($song->__get('youtube') != '') : ?>
                                    <a href="<?= $song->__get('youtube') ?>">Lien YouTube</a>
                                <?php endif ?>

                                <?php if ($song->__get('deeser') != '') : ?>
                                    <a href="<?= $song->__get('deeser') ?>">Lien Dezzer</a>
                                <?php endif ?>

                                <?php if ($song->__get('spotify') != '') : ?>
                                    <a href="<?= $song->__get('spotify') ?>">Lien Spotify</a>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="second-block col-lg-7 col-md-7 col-12">
                            <!-- <div class="display-content"> -->
                            <h3>Parole</h3>

                            <div>
                                <b>
                                    <?= $song->__get('text') ?>
                                </b>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>