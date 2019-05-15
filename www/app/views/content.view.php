<section id="content-banner" style="background-image:url(http://localhost/public/img/slider-1-1920w.jpg);">

</section>
<section id="content-core">
    <div class="container">
        <div class="row center">
            <div class="col-md-8 col-sm-10 col-12">
                <?php isset($content) ?  $content->content() : null?>
                <?php  isset($event) ? include 'event.view.php' : null?>
            </div>
        </div>
    </div>
</section>