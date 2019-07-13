<?php

use Songfolio\Core\Helper;
use Songfolio\Models\Users;

$currentU = new Users();
?>

<section id="content-core">
    <div class="container">
        <div class="row center">
            <div class="col-md-8 col-sm-10 col-12">
                <div class="event-page">

                    <div class="row">

                        <div class="col-lg-5 col-md-5 col-12">

                            <?php if ($album->__get('cover_dir')) : ?>
                                <img height="150" width="100%" src="<?= $album->__get('cover_dir') ?>" alt="">
                            <?php endif; ?>

                            <div class="display-content">

                                <div class="display-content">

                                    <div class="display-like-title">
                                        <h3><?= $album->__get('title') ?></h3>
                                        <div class="likes">
                                            <span class="nbr_likes_span"><?php if ($nb_like != 0) echo $nb_like;
                                                                            else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                                            <input type="hidden" class="nbr_likes" value="<?= $nb_like ?>">
                                            <img class="<?php if ($currentU->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if ($checkUserLike) echo 'public/img/heart-like-active.svg';
                                                                                                                                            else echo 'public/img/heart-like.svg' ?>" alt="">
                                            <input type="hidden" class="type" value="albums">
                                            <input type="hidden" class="type_id" value="<?= $album->__get('id') ?>">
                                            <input type="hidden" class="user_id" value="<?= $currentU->__get('id') ?>">

                                        </div>
                                    </div>

                                    <?php if (isset($category_name)) : ?>
                                        <p>Categorie : <?= $category_name ?></p>
                                    <?php endif ?>


                                    <p>Publie le : <?= Helper::getFormatedDate($album->__get('date_published')) ?></p>
                                    <?php if ($album->__get('youtube') != '') : ?>
                                        <a href="<?= $album->__get('youtube') ?>">Lien YouTube</a>
                                    <?php endif ?>

                                    <?php if ($album->__get('deeser') != '') : ?>
                                        <a href="<?= $album->__get('deeser') ?>">Lien Dezzer</a>
                                    <?php endif ?>

                                    <?php if ($album->__get('spotify') != '') : ?>
                                        <a href="<?= $album->__get('spotify') ?>">Lien Spotify</a>
                                    <?php endif ?>

                                    <hr>
                                    <p><?=  $album->__get('description')?></p>
                                </div>
                            </div>

                        </div>

                        <div class="second-block col-lg-7 col-md-7 col-12">
                            <h3>Les singles</h3>

                            <table class="col-lg-10 col-12">
                                <?php $i = 0 ?>
                                <?php
                                foreach ($songs as $song) :; ?>
                                    <tr>
                                        <td class="rank">
                                            <?php echo ++$i; ?>.
                                        </td>
                                        <td class="image">
                                            <img src="<?= Helper::host() . $song['img_dir'] ?? '' ?>" alt="">
                                        </td>
                                        <td class="title">
                                            <a href="<?= $song['slug'] ?>">
                                                <?= $song['name'] ?> <br> <small><?= $song['album_name'] ?? '' ?></small>
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
                                                <img class="<?php if ($currentU->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if ($song['checkUserLike']) echo 'public/img/heart-like-active.svg';
                                                                                                                                                else echo 'public/img/heart-like.svg' ?>" alt="">
                                                <input type="hidden" class="type" value="songs">
                                                <input type="hidden" class="type_id" value="<?= $song['id'] ?>">
                                                <input type="hidden" class="user_id" value="<?= $currentU->__get('id') ?>">

                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>

<?php if (isset($comments)) $this->addModal('comment', [
    'type' => 'albums',
    'type_id' => $album->__get('id'),
    'redirect' => $album->__get('slug'),
    'comments' => $comments
]) ?>