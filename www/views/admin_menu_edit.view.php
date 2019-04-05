<div class="container">
    <h3><?=$menu->__get('title')?></h3>
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
    #the-menu li{
        background: #f3f3f3;
    }
    #the-menu{
        padding-bottom:5px;
        background-color: #f3f3f3;
        -webkit-box-shadow: 0 0 0 1px rgba(63,63,68,0.05), 0 1px 3px 0 rgba(63,63,68,0.15);
        box-shadow: 0 0 0 1px rgba(63,63,68,0.05), 0 1px 3px 0 rgba(63,63,68,0.15);
        max-width:500px;
    }
    .sortable ul {
        margin-left: 25px;
        min-height:5px;
        background:white;
    }
    .ui-sortable-helper {
        box-shadow: rgba(0,0,0,0.15) 0 3px 5px 0;
        width: 300px!important;
        height: 33px!important;
    }
</style>
    <ul class="sortable list-unstyled" id="the-menu">
        <?=$menu->show('menu_edit');?>
    </ul><!-- /.menu-sortable -->
    <form method="post">
        <input type="hidden" id="result-data" name="data" value=""></input>
        <button type="submit">Enregistrer</button>
    </form>
</div>