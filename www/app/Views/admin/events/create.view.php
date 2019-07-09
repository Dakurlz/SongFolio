<div class="create-events-page">

    <?php

        if (isset($alert)) $this->addModal('alert', $alert);
    ?>


    <div class="create-events-page__form">
        <?php if (isset($configFormEvent)) $this->addModal("form", $configFormEvent) ?>
    </div>
    
</div>