<div class="contents-index-page">

    <div class=" row" style="margin-bottom: 60px" >

        <div  style="margin: auto" class=" col-lg-4 col-md-6 col-sm-6 col-xs-6 col-12">
            <a style="margin-bottom: 20px" class="btn btn-success-outline" href="<?= \Songfolio\Core\Routing::getSlug('Contents','createContents') ?>">
                Ajouter une page ou un article ...
            </a>

            <a href="<?= \Songfolio\Core\Routing::getSlug('Contents','listesPages') ?>">

                <div style="background: #00A65A" class=" stats-block ">
                    <img src="<?= BASE_URL."public/img/contents.svg"; ?>"
                    />
                    <div>
                        <p> <?= $nb_pages?? '0' ?>  </p>
                        <p>Pages</p>
                    </div>
                </div>
            </a>
        </div>

        <div style="margin: auto" class=" col-lg-4 col-md-6 col-sm-6 col-xs-6 col-12">
            <a class="btn" style=" cursor: none; margin-bottom: 20px"></a>

            <a href="<?= \Songfolio\Core\Routing::getSlug('Contents','listesArticles') ?>">
                <div style="background: #02BBAB" class="stats-block ">
                    <img src="<?= BASE_URL."public/img/article.svg"; ?>"
                    />
                    <div>
                        <p> <?= $nb_articles ?? '0' ?>  </p>
                        <p>Article</p>
                    </div>
                </div>
            </a>
        </div>


    </div>
</div>