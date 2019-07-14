<div class="container page-404">
    <div class="row">
        <div class="col-md-6 col-12">
            <h1>Oops ...</h1>
            <h2>Une erreur est survenue</h2>
            <p><?= $reason ?? 'Page introuvable' ?></p>
            <a href="javascript:history.go(-1)">Retourner en arrière</a>
        </div>
        <div class="col-md-6 col-12">
            <img width="300px" src="public/img/img_front/404.jpg" alt="">
        </div>
    </div>
</div>