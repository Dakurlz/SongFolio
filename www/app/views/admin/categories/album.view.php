<?php
    use app\Core\Routing;
?>

<div class="row categories-page">

  <?php
    if (isset($alert)) $this->addModal('alert', $alert);
  ?>


  <div class="col-md-6 col-12 col-sm-6 col-xs-6">

    <table class="table col-12 col-sm-8 col-lg-8 col-md-8">

      <thead>
        <tr>
          <th>Catégories d'albume</th>
          <th></th>
          <th></th>
        </tr>
      </thead>

      <tbody>

        <td><?php if (sizeof($albumCategories) === 0) echo 'Aucune categorie.'; ?></td>
        <?php foreach ($albumCategories as $category) : ?>

          <tr>
            <td><?= $category['name']; ?></td>

            <td class="icn"><a href='<?= Routing::getSlug("Categories", "update") . "?id=" . $category['id'] . '&type=album' ?>'><i class="icon icon-edit"></i></a></td>
            <td class="icn"><a href='<?= Routing::getSlug("Categories", "delete") . "?id=" . $category['id'] . '&type=album' ?>'><i class="icon icon-delete"></i></a></td>
          </tr>
        <?php endforeach ?>
      </tbody>

    </table>

  </div>

  <div class="col-12 col-md-4 col-lg-4 col-sm-6 col-xs-6 categories-page__add-categ">
    <h2 class="col-12">Ajouter une nouvelle catégorie</h2>
    <?php $this->addModal("form", $configFormCategory) ?>
  </div>
</div>