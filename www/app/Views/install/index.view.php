<?php
use Songfolio\Core\Routing;
?>

<div class="container">
    <h1>Bienvenue sur Songfolio</h1>
    <p>Songfolio est un CMS open-source créé par un groupe d'étudiant de l'ESGI.</p>
    <p>Ce CMS est destiné aux musiciens et/ou groupes de musiques.</p>
    <p>Pour bien débuter sur votre nouveau site, nous allons vous accompagner sur sa configuration.</p>
    <p>Il suffis de renseigner les informations demandés, et nous nous occuperons de tout!</p>
    <a href="<?=Routing::getSlug('install', 'bdd')?>" class="btn btn-success">Commencer la configuration</a>
</div>