<div class="create-songs-page">

    <div class="create-albums-page__form">
        <?php if (isset($configFormSongs)) $this->addModal("form", $configFormSongs) ?>
    </div>
    
</div>


<script>
  CKEDITOR.replace('content');
</script>