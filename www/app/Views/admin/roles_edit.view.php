<?php
    use Songfolio\Core\Routing;
?>

<style>
    .form-group {
        display:block;
    }
</style>

<div class="container">
    <form id="role-form" class="roles_edit" method="post">
        <div class="form-group">
            <label>Titre du rôle</label>
            <input type="text" class="form-control" value="<?=($role->id() ? $role->__get('name') : '')?>" name="name" required>
        </div>

        <?php foreach($permsList as $group => $group_data):?>

            <?php if ( isset($group_data['title']) ): ?>
                <h3><?=$group_data['title']?></h3>
            <?php endif; ?>àa

            <?php foreach($group_data['perms'] as $perm => $perm_data): ?>
                <div class="form-group">
                    <input type="checkbox" id="<?=$perm?>" name="perms[<?=$perm?>]" value="1" <?=( $role->getPerm($perm) ? 'checked' : '')?>>
                    <label for="<?=$perm?>"><?=$perm_data['desc']?></label>
                </div>
            <?php endforeach; ?>

        <?php endforeach; ?>

        <button class="btn btn-success" type="submit">Enregistrer le role</button>

        <?php if($role->id()): ?>
            <a href="<?=Routing::getSlug('admin', 'rolesDel')?>?role=<?=$role->id()?>" class="btn btn-danger">Supprimer le menu</a>
        <?php endif; ?>
    </form>
</div>