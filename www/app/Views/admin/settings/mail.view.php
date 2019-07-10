<div class="create-contents-page">
    <h2>Configuration</h2>

    <?php
    if (isset($alert)) $this->addModal('alert', $alert);
    ?>
    <div class="create-contents-page__form">
        <?php $this->addModal("form", $settingsForm) ?>
    </div>
    <div class="create-contents-page__form">
        <?php $this->addModal("form", $settingsForms) ?>
    </div>


</div>