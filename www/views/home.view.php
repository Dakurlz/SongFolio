<section id="home-slider">
    <picture>
        <!-- Mobile 600x450 -->
        <source srcset="<?php echo PUBLIC_DIR?>img/slider-1-600w.jpg" media="(max-width: <?php echo MOBILE_MAX_WIDTH ?>px)"/>
        <!-- Desktop 1920x720-->
        <img src="<?php echo PUBLIC_DIR?>img/slider-1-1920w.jpg" />
    </picture>
</section>

<section id="home-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <article class="event-full">
                    <a href="" class="event">
                        <h1>Fin de tournée, nos impressions !</h1>
                        <p>Mardi 2 Janvier 2019 <span class="muted">par Kilian</span></p>
                        <img src="<?php echo PUBLIC_DIR?>img/slider-1-1920w.jpg" />
                    </a>
                </article>
            </div>
            <div class="col-lg-3 col-xs-6 col-12">
                <article class="event-half">
                    <a href="" class="event">
                        <h1>Sortie du nouvel album coming soon</h1>
                        <p>Mardi 2 Janvier 2019 <span class="muted">par Kilian</span></p>
                        <img src="<?php echo PUBLIC_DIR?>img/slider-1-1920w.jpg" />
                    </a>
                    <a href="" class="event">
                        <h1>nouvelle compilation 22 titres</h1>
                        <p>Mardi 2 Janvier 2019 <span class="muted">par Kilian</span></p>
                        <img src="<?php echo PUBLIC_DIR?>img/slider-1-1920w.jpg" />
                    </a>
                </article>
            </div>
            <div class="col-lg-3 col-xs-6 col-12">
                <article class="event-other">
                <h1>Autres nouveautés</h1>
                <ul>
                    <li>
                        <a href="#">
                            <h2>Titre 1</h2>
                            <p>Mercredi 12 janvier par Freddie</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h2>Titre 1</h2>
                            <p>text text text</p>
                        </a>
                    </li>
                </ul>
                </article>
            </div>
        </div>
    </div>
</section>

<section id="section-top">
    <div class="container">
        <div class="row center">

            <div class="col-lg-10 col-12 nav">
                <select id="top-select">
                    <option value="singles">Top singles</option>
                    <option value="albums">Top albums</option>
                </select>
                <a href="">Tout le temps</a>
                <a href="" class="active">Ce mois</a>
                <a href="">Aujourd'hui</a>
            </div>
            <table class="col-lg-10 col-12">
                <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td class="rank">
                      <?php echo $i+1; ?>.
                    </td>
                    <td class="image">
                        <img src="public/img/cover_br.png" />
                    </td>
                    <td class="title">
                        Bohemian Rhapsody <br> <small>Queen</small>
                    </td>
                    <td class="info">
                        31 Octobre 1975
                    </td>
                    <td class="info">
                        1.2M
                    </td>
                    <td class="info">
                        3.8M
                    </td>
                </tr>
                <?php endfor; ?>
            </table>
            <div class="col-12 tac">
                <a href="#" class="chevron">Tous nos singles</a>
            </div>
        </div>
    </div>
</section>

<section id="section-info">
    <div class="container">
        <div class="row center">
            <div class="col-lg-5 col-sm-6 col-12 events">
                <div class="nav">
                    Prochains évènements
                </div>
                <ul style="list-style: none;padding: 0;">
                    <li>
                        <img src="https://i.pinimg.com/originals/74/72/2e/74722e84d049b7eb3d2139b719099679.jpg">
                        <div class="infos">
                            <h2 style="margin: 0;display: inline;">Concert 27 Juillet 1982</h2>
                            <p>Madison Square Garden - New York City</p>
                        </div>
                    </li>
                    <li>
                        <img src="https://i.pinimg.com/originals/74/72/2e/74722e84d049b7eb3d2139b719099679.jpg">
                        <div class="infos">
                            <h2 style="margin: 0;display: inline;">Concert 27 Juillet 1982</h2>
                            <p>Madison Square Garden - New York City</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-sm-offset-1 col-lg-4 col-sm-5 col-12 group-info">
                    <img src="<?php echo PUBLIC_DIR?>img/photo_fm.jpg" />
                    <h1>Freddie Mercury</h1>
                    <p>Chanteur</p>
                    <a href="#">Biographie de Freddie</a>
                    <a href="#" class="chevron lexical">Tous les membres du groupe</a>
            </div>
        </div>
    </div>
</section>
