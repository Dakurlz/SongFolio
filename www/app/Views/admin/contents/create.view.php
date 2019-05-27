<div class="create-contents-page">

<?php
    if (isset($alert)) $this->addModal('alert', $alert);
?>
  <div class="create-contents-page__form">
    <?php if (isset($configFormPage)) $this->addModal("form", $configFormPage) ?>
  </div>


</div>
<script>
  CKEDITOR.replace('content');
</script>