<?php
use Songfolio\Core\Routing;
?>

<div class="container">
    <h1>Connexion</h1>

    <?php

    $this->addModal("form", $configFormLogin);
    ?>

    <?php if($loginFb): ?>
        <div class="text-center">
            <a href="<?php echo $loginFb;?>">Login with FB</a>
        </div>
    <?php endif; ?>
    <div class="text-center">
        <a href="<?php echo Routing::getSlug("users","register");?>">Register</a>
        <a href="<?php echo Routing::getSlug("users","forgetPassword");?>">Forgot Password?</a>
    </div>
</div>