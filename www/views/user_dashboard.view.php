<div class="container">
    <h1><?php echo 'Bonjour '.$user->__get('username'); ?></h1>
    <a href="#">Modifier son adresse mail</a><br>
    <a href="#">Modifier son mot de passe</a><br>
    <a href="<?=Routing::getSlug('users', 'logout')?>">Deconnexion</a><br>

    <style>
        .block {
            margin: 5px 0;
            border: 1px solid #f1e8e2;
            background: #fff;
        }
        .sortable ul {
            padding: 5px;
        }
        .block-title {
            font-family: Arial;
            font-size: 12px;
            color: #4c4743;
            padding: 0 10px;
            height: 33px;
            line-height: 33px;
            position: relative;
        }
        .sortable {
            list-style: none;
            padding-left: 0;
        }
        .sortable ul {
            margin-left: 25px;
        }
        .ui-sortable-helper {
            box-shadow: rgba(0,0,0,0.15) 0 3px 5px 0;
            width: 300px!important;
            height: 33px!important;
        }
        .sortable-placeholder {
            height: 35px;
            background: #e3dcd7;
            margin-bottom: 5px;
            margin-top: 5px;
        }
    </style>
    <ul class="sortable list-unstyled" id="sortable">
        <li>
            <div class="block block-title">Index</div>
            <ul class="sortable list-unstyled"></ul>
        </li>
        <li>
            <div class="block block-title">About Us</div>
            <ul class="sortable list-unstyled"></ul>
        </li>
        <li>
            <div class="block block-title">Portfoion</div>
            <ul class="sortable list-unstyled"></ul>
        </li>
        <li>
            <div class="block block-title">Services</div>
            <ul class="sortable list-unstyled">
                <li>
                    <div class="block block-title">Design</div>
                    <ul class="sortable list-unstyled"></ul>
                </li>
                <li>
                    <div class="block block-title">Develope</div>
                    <ul class="sortable list-unstyled"></ul>
                </li>
                <li>
                    <div class="block block-title">SEO</div>
                    <ul class="sortable list-unstyled"></ul>
                </li>
                <li>
                    <div class="block block-title">Support</div>
                    <ul class="sortable list-unstyled"></ul>
                </li>
            </ul><!-- /.menu-sortable -->
        </li>
        <li>
            <div class="block block-title">Contact</div>
            <ul class="sortable list-unstyled"></ul>
        </li>
    </ul><!-- /.menu-sortable -->
</div>