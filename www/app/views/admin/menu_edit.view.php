<?php
    use Songfolio\Models\Contents;
    use Songfolio\Models\Menus;
    use Songfolio\Core\Routing;
?>

<div class="container">
    <style>
    .block-title {
        padding: 10px;
        background:white;
        border-left: 1px solid #dfe3e8;
        border-bottom: 1px solid #dfe3e8;
    }
    .sortable li:not(:first-child) .block-title {
        border-top: 1px solid #dfe3e8;
    }
    .sortable li{
        background: white;
    }

    .sortable-placeholder {
        height: 35px;
        background: #e3dcd7!important;
    }
    .sortable {
        list-style: none;
        padding-left: 0;
    }
    #menu-form{
        max-width:500px;
    }
    #the-menu li{
        background: #f3f3f3;
        position:relative;
    }
    #the-menu{
        padding-bottom:5px;
        background-color: #f3f3f3;
        -webkit-box-shadow: 0 0 0 1px rgba(63,63,68,0.05), 0 1px 3px 0 rgba(63,63,68,0.15);
        box-shadow: 0 0 0 1px rgba(63,63,68,0.05), 0 1px 3px 0 rgba(63,63,68,0.15);
        margin:0;
    }
    #the-menu > li > ul {
        margin-left: 25px;
        min-height:5px;
        background:white;
    }
    .del-menu-btn{
        position:absolute;
        right:5px;
        top:10px;
    }
    .ui-sortable-helper {
        box-shadow: rgba(0,0,0,0.15) 0 3px 5px 0;
        width: 300px!important;
        height: 33px!important;
    }
</style>
    <form id="menu-form" method="post">
        <div class="form-group">
            <label>Titre du menu</label>
            <input type="text" class="form-control" value="<?=($menu->id() ? $menu->__get('title') : '')?>" name="title" required>
        </div>

        <div class="form-group">
            <label>Contenu du menu</label>
            <ul class="sortable lis-unstyled" id="the-menu">
                <?=$menu->show('menu_edit');?>
            </ul><!-- /.menu-sortable -->
            <input type="hidden" id="result-data" name="data" value="" />
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-info" modal="menu-edit-modal">Ajouter un lien</button>
        </div>
        <hr>
        <button class="btn btn-success" type="submit">Enregistrer le menu</button>

        <?php if($menu->id()): ?>
            <a href="<?=Routing::getSlug('admin', 'menusDel')?>?menu=<?=$menu->id()?>" class="btn btn-danger">Supprimer le menu</a>
        <?php endif; ?>
    </form>

    <!-- The Modal -->
    <div id="menu-edit-modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close"></span>

            <div class="form-group">
                <label>Nom du lien</label>
                <input class="input-control" type="link" id="menu-title" placeholder="Entrez le nom du menu">
            </div>

            <div class="form-group">
                <label>Cible du lien</label>
                <select class="select-control smart-toggle" id="menu-add">
                    <option value="homepage">Accueil</option>
                    <option value="custom-page">Page</option>
                    <option value="custom-link">Lien externe</option>
                </select>
            </div>

            <div class="form-group smart-menu-add menu-add-homepage">
                <input type="hidden" id="menu-link" value="<?=BASE_URL?>">
            </div>

            <div class="form-group smart-menu-add menu-add-custom-page">
                <label>Choisir une page</label>
                <select class="select-control menu-custom-page" id="menu-link">
                <?php foreach( (new Contents)->getAllData() as $page):?>
                    <option value="<?=BASE_URL.$page['slug']?>"><?=$page['title']?></option>
                <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group smart-menu-add menu-add-custom-link">
                <label>Lien</label>
                <input class="input-control menu-custom-link" type="link" id="menu-link" placeholder="Entrez le lien">
            </div>

            <button type="button" id="add-menu-btn" class="btn btn-success" >Ajouter</button>
        </div>

    </div>
</div>