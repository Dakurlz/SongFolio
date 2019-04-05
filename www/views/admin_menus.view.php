<div class="container">
    <table>
        <?php foreach($menus as $menu):?>
            <tr>
                <td>
                    <?=$menu['id']?>
                </td>
                <td>
                    <?=$menu['title']?>
                </td>
                <td>
                    <a href="<?=Routing::getSlug('admin', 'menusEdit').'?menu='.$menu['id']?>">Modifier</a>
                </td>

            </tr>
        <?php endforeach;?>
    </table>
</div>