<div class="create-albums-page">

    <?php

        if (isset($alert)) $this->addModal('alert', $alert);
    ?>


    <div class="create-albums-page__form">
        <?php if (isset($configFormAlbum)) $this->addModal("form", $configFormAlbum) ?>
    </div>
    
</div>