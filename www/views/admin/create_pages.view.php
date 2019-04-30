<div class="admin-page ">

<a class="btn btn-success-outline " href="<?= Routing::getSlug("Contents", "listesPages") ?>"> Pages Listes</a>


  <div class="admin-page__form">
    <?php $this->addModal("form1", $configFormPage) ?>
  </div>


</div>
<script>
  CKEDITOR.replace('content');
</script>