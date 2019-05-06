<div class="admin-page ">

<?php
    if (isset($alert)) $this->addModal('alert', $alert);
?>
  <div class="admin-page__form">
    <?php $this->addModal("form", $configFormPage) ?>
  </div>


</div>
<script>
  CKEDITOR.replace('content');
</script>