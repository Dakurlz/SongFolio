<?php
use Songfolio\Core\Routing;
?>
<div class="container">
<h1>Inscription</h1>

<?php
$this->addModal("form", $configFormRegister);
?>

<div class="text-center">
    <a href="<?php echo Routing::getSlug("users","login");?>">Connexion</a> |
    <a href="<?php echo Routing::getSlug("users","forgetPassword");?>">Mot de passe oubliée ?</a>
</div>
</div>