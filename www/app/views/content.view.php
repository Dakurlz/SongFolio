<?php
    use \Songfolio\Models\Users;
    use \Songfolio\Core\Helper;
?>

<?php if($content->__get('img_dir')): ?>
    <section id="content-banner" style="background-image:url(<?=$content->__get('img_dir')?>);">
    </section>
<?php endif; ?>

<section id="content-core">
    <div class="container">
        <div class="row center">
            <div class="col-md-8 col-sm-10 col-12">
<<<<<<< HEAD
                <?php if ( $content->is('article') ): ?>
                    <h1><?= $content->__get('title') ?></h1>
                <?php endif; ?>

                <?php isset($content) ?  $content->content() : null?>

=======

                <?php if($content->is('article')): ?>
                    <article>
                    <h1><?=$content->__get('title')?></h1>
                <?php endif; ?>

                <?= isset($content) ? $content->content() : ''?>

                <?php if($content->is('article')): ?>
                        <p>
                            Ecrit par <?=(new Users($content->__get('author')))->__get('username')?> le <?=Helper::getFormatedDateWithTime($content->__get('date_create'))?>
                        </p>
                    </article>
                <?php endif; ?>
>>>>>>> kilian
            </div>
        </div>
    </div>
</section>