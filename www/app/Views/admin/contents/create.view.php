<div class="create-contents-page">

  <div class="create-contents-page__form">
    <?php if (isset($configFormPage)) $this->addModal("form", $configFormPage) ?>
  </div>


</div>
<script>
  CKEDITOR.replace('content');
</script>