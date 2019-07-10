<?php

use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
use Songfolio\Models\Users;
use Songfolio\Models\Likes;


?>


<?php if ($album->__get('cover_dir')) : ?>
    <section id="content-banner" style="background-image:url(<?= $album->__get('cover_dir') ?>);">
    </section>
<?php endif; ?>


<section id="album-core">
    <div class="container">

        <h1><?= $album->__get('title') ?></h1>
        <br>

        <div class="row">
            <div class="col-md-5 col-12">
                sdfsddf
            </div>
            <div class="col-md-7 col-12">
                <table class="  col-12">
                    <?php $i = 0 ?>
                    <?php $currentU = new Users();
                    foreach ($songs as $song) : $nbLikesSongs  = Likes::displayLike($likesSongs, $song['id']); ?>
                        <tr class="singles_list smart-top-select top-select-singles">
                            <td class="rank">
                                <?php echo ++$i; ?>.
                            </td>
                            <td class="image">
                                <img src="<?= BASE_URL . $song['img_dir'] ?? '' ?>" alt="">
                            </td>
                            <td class="title">
                                <a href="<?= $song['slug'] ?>">
                                    <?= $song['name'] ?> <br> <small><?= $song['album_name'] ?? '' ?></small>
                                </a>
                            </td>
                            <td class="info">
                                <?= Helper::getFormatedDate($song['date_published']) ?>
                            </td>

                            <td class="info likes">

                                <span class="nbr_likes_span"><?php if ($nbLikesSongs != 0) echo $nbLikesSongs;
                                                                else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                                <input type="hidden" class="nbr_likes" value="<?= $nbLikesSongs ?>">
                                <img class="<?php if ($currentU->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if (Likes::checkIfUserLiked($likesSongs, $song['id'], $currentU->__get('id'))) echo 'public/img/heart-like-active.svg';
                                                                                                                                else echo 'public/img/heart-like.svg' ?>" alt="">
                                <input type="hidden" class="type" value="songs">
                                <input type="hidden" class="type_id" value="<?= $song['id'] ?>">
                                <input type="hidden" class="user_id" value="<?= $currentU->__get('id') ?>">

                            </td>
                        </tr>

                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>
</section>



<?php if (isset($comments)) $this->addModal('comment', [
    'type' => 'article',
    'type_id' => $album->__get('id'),
    'redirect' => $album->__get('slug'),
    'comments' => $comments
]) ?>