<?php

use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
use Songfolio\Models\Users;

$user = new Users();

?>

<section id="home-slider">
    <picture>
        <!-- Mobile 600x450 -->
        <source srcset="<?=(!empty($settings['header']['home_banner_mobile']) ? $settings['header']['home_banner_mobile'] : Helper::host().'public/img/slider-1-600w.jpg')?>" media="(max-width: <?php echo MOBILE_MAX_WIDTH ?>px)" />
        <!-- Desktop 1920x720-->
        <img src="<?=(!empty($settings['header']['home_banner_desktop']) ? $settings['header']['home_banner_desktop'] : Helper::host().'public/img/slider-1-1920w.jpg')?>" />
    </picture>
</section>

<section id="home-blog">
    <div class="container">
        <div class="row">
            <?php
            if (isset($articles)) :
                ?>
                <div class="col-lg-6 col-12">
                    <article class="event-full">
                        <a href="<?= $articles[0]['slug'] ?? '' ?>" class="event">
                            <h1><?= $articles[0]['title'] ?? 'Bientôt ...' ?></h1>
                            :!
                            <?php if (isset($articles[0])) : ?>
                                <p><?= Helper::getFormatedDateWithTime($articles[0]['date_create']) ?> <span class="muted">par <?= (new Users($articles[0]['author']))->getShowName() ?></span></p>
                                <?php if (isset($articles[0]['img_dir'])) : ?>
                                    <img src="<?= $articles[0]['img_dir'] ?>" />
                                <?php endif; ?>
                            <?php endif; ?>

                        </a>
                    </article>
                </div>
                <div class="col-lg-3 col-xs-6 col-12">
                    <article class="event-half">
                        <a href="<?= $articles[1]['slug'] ?? '' ?>" class="event">
                            <h1><?= $articles[1]['title'] ?? 'Bientôt ...' ?></h1>
                            <?php if (isset($articles[1])) : ?>
                                <p><?= Helper::getFormatedDateWithTime($articles[1]['date_create']) ?> <span class="muted">par <?= (new Users($articles[1]['author']))->__get('username') ?></span></p>
                                <?php if (isset($articles[1]['img_dir'])) : ?>
                                    <img src="<?= $articles[1]['img_dir'] ?>" />
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                        <a href="<?= $articles[2]['slug'] ?? '' ?>" class="event">
                            <h1><?= $articles[2]['title'] ?? 'Bientôt ...' ?></h1>
                            <?php if (isset($articles[2])) : ?>
                                <p><?= Helper::getFormatedDateWithTime($articles[2]['date_create']) ?> <span class="muted">par <?= (new Users($articles[2]['author']))->__get('username') ?></span></p>
                                <?php if (isset($articles[2]['img_dir'])) : ?>
                                    <img src="<?= $articles[2]['img_dir'] ?>" />
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </article>
                </div>
                <div class="col-lg-3 col-xs-6 col-12">
                    <article class="event-other">
                        <h1>Autres nouveautés</h1>
                        <ul>
                            <?php if (count($articles) > 3) : ?>
                                <?php for ($i = 3; $i < count($articles) && $i < 9; $i++) : ?>
                                    <li>
                                        <a href="<?= $articles[$i]['slug'] ?? '' ?>">
                                            <h2><?= $articles[$i]['title'] ?></h2>
                                            <p><?= $articles[$i]['date_create'] ?> par <?= $articles[$i]['author'] ?></p>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </ul>
                        <a href="<?= Routing::getSlug('pages', 'renderEventsPage') ?>" class="chevron lexical_br">Voir tous les articles</a>
                    </article>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<section id="section-top">
    <div class="container">
        <div class="row center">

            <div class="col-lg-10 col-12 nav">
                <h2>Top singles</h2>
                <a href="">Tout le temps</a>
                <a href="" class="active">Ce mois</a>
                <a href="">Aujourd'hui</a>
            </div>
            <table class="col-lg-10 col-12">
                <?php $i = 0 ?>
                <?php
                foreach ($songs as $song) : if ($i ==  5) break; ?>
                    <tr class="singles_list smart-top-select top-select-singles">
                        <td class="rank">
                            <?php echo ++$i; ?>.
                        </td>
                        <td class="image">
                            <img src="<?=Helper::host() . $song['img_dir'] ?? '' ?>" alt="">
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

                            <span class="nbr_likes_span"><?php if ($song['nbLikesSongs'] != 0) echo $song['nbLikesSongs'];
                                                            else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                            <input type="hidden" class="nbr_likes" value="<?= $song['nbLikesSongs'] ?>">
                            <img class="<?php if ($user->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if ($song['checkUserLike']) echo 'public/img/heart-like-active.svg';
                                                                                                                            else echo 'public/img/heart-like.svg' ?>" alt="">
                            <input type="hidden" class="type" value="songs">
                            <input type="hidden" class="type_id" value="<?= $song['id'] ?>">
                            <input type="hidden" class="user_id" value="<?= $user->__get('id') ?>">

                        </td>
                    </tr>

                <?php endforeach; ?>

            </table>
            <div class="col-12 tac">
                <a href="<?= Routing::getSlug('Pages', 'renderSongs') ?>" class="chevron">Tous nos singles</a>
            </div>
        </div>
    </div>
</section>



<section id="section-top">
    <div class="container">
        <div class="row center">

            <div class="col-lg-10 col-12 nav">
                <h2>Top albums</h2>
                <a href="">Tout le temps</a>
                <a href="" class="active">Ce mois</a>
                <a href="">Aujourd'hui</a>
            </div>
            <table class="col-lg-10 col-12">
                <?php $j = 0 ?>
                <?php foreach ($albums as $album) :  if ($j == 5) break; ?>
                    <tr class="albums_list smart-toggle smart-top-select top-select-albums">
                        <td class="rank">
                            <?php echo ++$j; ?>.
                        </td>
                        <td class="image">
                            <img src="<?=Helper::host() . $album['cover_dir'] ?? '' ?>" alt="">
                        </td>
                        <td class="title">
                            <a href="<?= $album['slug'] ?>">
                                <?= $album['title'] ?> <br> <small><?= $album['category_name'] ?? '' ?></small>
                            </a>
                        </td>
                        <td class="info">
                            <?= Helper::getFormatedDate($album['date_published']) ?>
                        </td>

                        <td class="info likes">

                            <span class="nbr_likes_span"><?php if ($album['nbLikesAlbums'] != 0) echo $album['nbLikesAlbums'];
                                                            else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                            <input type="hidden" class="nbr_likes" value="<?= $album['nbLikesAlbums'] ?>">
                            <img class="<?php if ($user->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if ($album['checkUserLike']) echo 'public/img/heart-like-active.svg';
                                                                                                                            else echo 'public/img/heart-like.svg' ?>" alt="">
                            <input type="hidden" class="type" value="albums">
                            <input type="hidden" class="type_id" value="<?= $album['id'] ?>">
                            <input type="hidden" class="user_id" value="<?= $user->__get('id') ?>">

                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
            <div class="col-12 tac">
                <a href="<?= Routing::getSlug('Pages', 'renderAlbums') ?>" class="chevron">Tous nos albums</a>
            </div>
        </div>
    </div>
</section>

<section id="section-info">
    <div class="container">
        <div class="row center">
            <div class="col-lg-10 col-sm-10 col-12 events">
                <div class="nav">
                    <a href="<?= Routing::getSlug('Pages', 'renderEventsPage') ?>">
                        Prochains évènements
                    </a>
                </div>
                <ul style="list-style: none;padding: 0;">
                    <?php

                    if (isset($events)) :
                        $i = 0;
                        foreach ($events as $event) :
                            if (strtotime($event['start_date']) >= strtotime(date('d-m-Y'))) :
                                $i++;
                                ?>
                                <li>
                                    <?php if (isset($event['img_dir'])) : ?>
                                        <img src="<?=Helper::host() . $event['img_dir'] ?>" alt="">
                                    <?php endif ?>
                                    <div class="info">
                                        <h2 style="margin: 0;display: inline;"> <a class="link" href="<?=Helper::host() . $event['slug'] ?>"><?= ucfirst($event['type']) ?> - <?= $event['displayName'] ?></a> </h2>
                                        <p>le <?= Helper::getFormatedDateWithTime($event['start_date']) ?></p>
                                    </div>
                                </li>

                            <?php endif;
                            if ($i == 3) break;
                        endforeach;
                    else : ?>
                        <li> Aucun événement prévu </li>

                    <?php endif ?>
                </ul>
                <a href="<?= Routing::getSlug('pages', 'renderEventsPage') ?>" class="chevron">Voir tous les évènements</a>
            </div>
        </div>
    </div>
</section>