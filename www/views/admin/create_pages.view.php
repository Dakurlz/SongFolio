<div class="admin-page ">

<a class="btn btn-success-outline " href="<?php echo Routing::getSlug("Contants", "index") ?>"> Pages Listes</a>


  <div class="admin-page__form">
    <?php $this->addModal("form2", $configFormPage) ?>
  </div>


</div>
<script>
  CKEDITOR.replace('content');
</script>