<?php
use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
?>

<section id="section-events">
    <div class="container">
        <div class="row center">
            <div style="margin-top: 20px" class="col-lg-12 col-sm-12 col-12 events">
                <div class="nav">
                    Prochains évènements
                </div>
                <div class="list-events row" style="list-style: none;padding: 0;">
                    <?php
                    if (isset($events)) :
                        foreach ($events as $event) :
                            ?>
                            <div class="item col-lg-3 col-md-4 col-sm-6 col-10">
                                <?php if (isset($event['img_dir'])) : ?>
                                    <img style="max-width: 100px;" src="<?= BASE_URL . $event['img_dir'] ?>" alt="">
                                <?php endif; ?>
                                <div class="info">
                                    <h2 style="margin: 0;display: inline;"> <a class="link" href="<?= BASE_URL . $event['slug'] ?>"><?= ucfirst($event['type']) ?> - <?= $event['displayName'] ?></a> </h2>
                                    <p>le <?= Helper::getFormatedDateWithTime($event['start_date']) ?></p>
                                    <p>Prix: <?= $event['rate'] ?>€</p>
                                    <p> <?= $event['details'] ?>€</p>
                                </div>

                            </div>

                        <?php endforeach;
                else : ?>
                        <li> Aucun événement prévu </li>

                    <?php endif ?>
                </div>
            </div>

        </div>
        <a class="btn btn-success-outline" style="margin-top: 50px" href="<?= Routing::getSlug('Pages', 'default') ?>">Revenir sur la page d'accueil</a>
    </div>
</section>