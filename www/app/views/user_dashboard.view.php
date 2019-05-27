<?php
use Songfolio\Core\Routing;
?>
<div class="container">
    <h1><?php echo 'Bonjour '.$user->__get('username'); ?></h1>
    <a href="<?=Routing::getSlug('users', 'logout')?>">Deconnexion</a><br>

<?php if (isset($success)) : ?>
  
<div class="success alert-success">
                    <?php echo $success ?>
                     </div>
<?php endif; ?>

 <table>
        <tr><td>Speudo :</td><td> <?php echo $user->__get('username'); ?></td><td></td></tr>
        <tr><td>Email</td><td><?php echo $user->__get('email'); ?></td><td><input class='btn btn-info' value='Modifier'></td></tr>
        <tr><td>Mot de passe </td><?php echo $user->__get('username'); ?><td>*******</td><td><input id="pwd" class='btn btn-info' value='Modifier'></td></tr>
        <tr><td>Membre depuis</td><td><?php echo $user->__get('date_inserted'); ?></td><td></td></tr>
    </table>
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