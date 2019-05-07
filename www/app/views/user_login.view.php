<?php
use app\Core\Routing;
?>

<div class="container">
    <h1>Connexion</h1>

    <?php

    $this->addModal("form", $configFormLogin);
    ?>

    <div class="text-center">
        <a href="<?php echo Routing::getSlug("users","register");?>">Register</a>
        <a href="<?php echo Routing::getSlug("users","forgetPassword");?>">Forgot Password?</a>
    </div>
</div>