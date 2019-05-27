<div class="create-users-page">
    <?php
        if (isset($alert)) $this->addModal('alert', $alert);
    ?>

    <div class="create-events-page__form">
        <?php if (isset($configFormUsers)) $this->addModal("form", $configFormUsers) ?>
    </div>

</div>