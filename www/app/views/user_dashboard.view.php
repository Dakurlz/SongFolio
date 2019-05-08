<?php
use Songfolio\Core\Routing;
?>
<div class="container">
    <h1><?php echo 'Bonjour '.$user->__get('username'); ?></h1>
    <a href="#">Modifier son adresse mail</a><br>
    <a href="#">Modifier son mot de passe</a><br>
    <a href="<?=Routing::getSlug('users', 'logout')?>">Deconnexion</a><br>

   <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
 <table>
        <tr><td>Speudo :</td><td> <?php echo $user->__get('username'); ?></td><td></td></tr>
        <tr><td>Email</td><td><?php echo $user->__get('email'); ?></td><td><input class='btn btn-info' value='Modifier'></td></tr>
        <tr><td>Mot de passe </td><?php echo $user->__get('username'); ?><td>*******</td><td><input id="pwd" class='btn btn-info' value='Modifier'></td></tr>
        <tr><td>Membre depuis</td><td><?php echo $user->__get('date_inserted'); ?></td><td></td></tr>
    </table>
<div id="myModal" class="modal">
<div class="modal-content"><br><br>
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