<?php
use Songfolio\Core\Routing;
?>
<section>
<div class="container">
    <h1><?php echo 'Bonjour '.$user->getShowName(); ?></h1>

    <table>
        <tr><td>Identité</td><td><?php echo $user->__get('first_name'); ?> <?php echo $user->__get('last_name'); ?></td></tr>
        <tr><td>Email</td><td><?php echo $user->__get('email'); ?></td><td></td></tr>
        <tr><td>Mot de passe </td><td>*******</td><td><input id="pwd" class='btn btn-success-outline' value='Modifier'></td></tr>
        <tr><td>Membre depuis</td><td><?php echo $user->__get('date_inserted'); ?></td><td></td></tr>
    </table>

<?php if($user->can('access_admin')): ?>
    <a href="<?=Routing::getSlug('admin', 'default')?>" class="btn btn-success-outline">Acceder au panel admin</a>
<?php endif; ?>

<div id="myModal" class="modal  <?php if(!empty($active)) echo $active  ?>">
<div class="modal-content">
<div class='modal-title'>Changement de mot de passe</div><hr>
<br>
<?php if (isset($alert)) : ?>
  
               <div class="alert alert-danger">
               <?php foreach ($alert as $danger) : ?>
                     <li><?php echo $danger; ?></li>
                  <?php endforeach; ?>
                     </div>
                     <?php endif; ?>
<?php 
        $this->addModal("form", $FormModifyPwd);
    ?>
    
<span class="close"></span>
</div>
</div>


    
</div>
</section>



<script>
// Get the modal
var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn2 = document.getElementById("pwd");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>