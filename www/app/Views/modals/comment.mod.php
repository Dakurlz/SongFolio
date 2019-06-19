<?php
use \Songfolio\Core\Routing;
use Songfolio\Models\Users;
use Songfolio\Core\Helper;
use Songfolio\Core\Alert;

$user = new Users;

$config += [
    "config" => [
        "action" => Routing::getSlug("Comments", "createComments"),
        "method" => "POST",
    ]
];

$nb_comments = count($config['comments']);
$is_user = !empty($user->__get('id'));

?>

<section id="comment-section" class="comment-section">
    <div class="container">
        <div class="row center">
            <div class="comments-content col-md-8 col-sm-10 col-12">
                <h2><?= $nb_comments  ?> commentaires</h2>
                <span class="comment-separetor"></span>

                <form method="<?= $config['config']['method']; ?>" action="<?= $config['config']['action'] ?>" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="<?= $config['type']  ?>">
                    <input type="hidden" name="type_id" value="<?= $config['type_id'] ?>">
                    <input type="hidden" name="redirect" value="<?= $config['redirect'] ?>">
                    <?php if ($is_user) :  ?>
                        <textarea rows="4" cols="50" placeholder="Ajouter un commentaire" name="message" id="" class="textarea-control" required></textarea>
                    <?php endif; ?>
                    <div style="<?= !$is_user ? 'padding: 15px 0 '  : '' ?>" class="validate">
                        <p class="name"> <?= $is_user ? $user->getShowName() : 'Veuillez se connecter pour laisser des commentaires'; ?> </p>
                        <input style="<?= !$is_user ? 'display: none'  : '' ?>" type="submit" class=" <?= empty($user->__get('id')) ? 'disabled' : null ?> btn btn-success-outline" style="margin-top: 50px" value="Ajouter">
                    </div>
                </form>

                <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] === 'success') $this->addModal('alert', Alert::setAlertInfo('Votre commentaire sera afficher après la verification du moderateur')); ?>

                <?php if ($nb_comments !== 0) : ?>
                    <div class="comments-data">
                        <?php foreach ($config['comments'] as $key => $comment) : ?>
                            <div class="comments-data__item">
                                <img src="<?= BASE_URL ?>/public/img/comment-default.png" alt="">
                                <div class="comments-data__item__content">
                                    <p><span><?= $comment['user_name'] ?></span> - <?= Helper::getTimeAgo($comment['date_created']) ?></p>
                                    <p><?= $comment['message'] ?></p>
                                </div>
                                <?php if($user->__get('id') === $comment['user_id'] ): ?>
                                    <a class="cross" href='<?= Routing::getSlug("Comments", "refuse") . "?id=".$comment['id'].'&redirect_to='.$config['redirect']?>'></a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <h3>Aucun commentair...</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>