<?php
use Songfolio\Core\Routing;
?>
<div class="container">
<h1>Register an Account</h1>

<?php
$this->addModal("form", $configFormRegister);
?>

<div class="text-center">
    <a href="<?php echo Routing::getSlug("users","login");?>">Login Page</a>
    <a href="<?php echo Routing::getSlug("users","forgetPassword");?>">Forgot Password?</a>
</div>
</div>