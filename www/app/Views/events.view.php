<?php

use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
use Songfolio\Models\Likes;
use Songfolio\Models\Users;

?>


<section id="content-banner" style="background-image:url(<?=Helper::host()?>public/img/img_front/event2.jpg);">

</section>


<section id="section-events">
    <div class="container">
        <div class="row center">
            <div style="margin-top: 20px" class="col-lg-12 col-sm-12 col-12 events">

                <div class="nav">
                    Prochains évènements
                </div>

                <div class="search-front-bar col-12 col-lg-6 col-md-6 col-sm-6">
                    <input class="input-control input-control-danger input-search" placeholder="Chercher un événement" />
                </div>
                <div class="list-events" style="list-style: none;padding: 0;">

                    <table class="table col-12 ">

                        <tbody class="tbody">

                            <?php
                            if (isset($events)) :
                                $currentU = new Users();
                                foreach ($events as $event) :;
                                    if (strtotime($event['start_date']) >= strtotime(date('d-m-Y'))) :
                                        ?>

                                        <tr>
                                            <td>
                                                <img style="max-width: 150px;" src="<?=Helper::host() . $event['img_dir'] ?>" alt="">
                                            </td>
                                            <td>
                                                <h2 style="margin: 0;display: inline;"> <a class="link" href="<?=Helper::host() . $event['slug'] ?>"><?= ucfirst($event['type']) ?> - <?= $event['displayName'] ?></a> </h2>
                                            </td>
                                            <td>
                                                <p>de <?= Helper::getFormatedDateWithTime($event['start_date']) ?></p>
                                            </td>
                                            <td>
                                                <p>au <?= Helper::getFormatedDateWithTime($event['end_date']) ?></p>
                                            </td>

                                            <td>
                                                <p>Prix: <?= $event['rate'] ?>€</p>
                                            </td>
                                            <td>
                                                <p>Place: <?= $event['nbr_place'] ?></p>
                                            </td>
                                            <td>

                                                <div class="likes">
                                                    <span class="nbr_likes_span"><?php if ($event['nbLikesEvents'] != 0) echo $event['nbLikesEvents'];
                                                                                    else  echo '&nbsp;&nbsp;&nbsp;'; ?> </span>

                                                    <input type="hidden" class="nbr_likes" value="<?= $event['nbLikesEvents'] ?>">
                                                    <img class="<?php if ($currentU->__get('id')) echo 'add_like' ?>" height="18" width="18" src=" <?php if ($event['checkUserLike']) echo 'public/img/heart-like-active.svg';
                                                                                                                                                    else echo 'public/img/heart-like.svg' ?>" alt="">
                                                    <input type="hidden" class="type" value="events">
                                                    <input type="hidden" class="type_id" value="<?= $event['id'] ?>">
                                                    <input type="hidden" class="user_id" value="<?= $currentU->__get('id') ?>">
                                                </div>

                                            </td>
                                        </tr>
                                    <?php endif;
                                endforeach;
                            else : ?>
                                <td> Aucun événement prévu </td>

                            <?php endif ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</section>