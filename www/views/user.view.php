<div class="row">
   <div class="col-12 admin-users ">
      <div class="admin-users__main">
         <div  class="header">
            <img src="<?php echo BASE_URL."public/img/users-silhouettes.svg"; ?>" />
            <p>Utilisateurs</p>
         </div>
         <div class="admin-users__main__search-add-user">
            <div class="admin-users__main__search-add-user__search">
               <input class="input-control input-control-success admin-users__main__search-add-user__search__input"  placeholder="Chercher utilisateur"/>
               <a class="btn btn-success-outline admin-users__main__search-add-user__search__button" >Chercher</a>
            </div>
            <a class="btn btn-success-outline admin-users__main__search-add-user__add-user " >Ajouter utilisatuer</a>
         </div>
         <table class="admin-users__main__table table">
            <thead role="rowgroup">
               <tr role="row">
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Rejoint</th>
                  <th>Dernière connexion</th>
                  <th>Option</th>
               </tr>
            </thead>
            <tbody role="rowgroup">
               <tr role="row">
                  <td>Adam Johnson</td>
                  <td>adam.jognson@gmail.com</td>
                  <td>01/02/2019</td>
                  <td>06/02/2019</td>
                  <td>
                     <div class="dropdown">
                        <button  onclick="showDropdown(this)" class="user-options dropbtn">Option</button>
                        <div id="myDropdown" class="dropdown-content">
                           <a href="#">Modifier</a>
                           <a href="#">Supprimer</a>
                        </div>
                     </div>
                  </td>
               </tr>
               <tr role="row">
                  <td>Adam Johnson</td>
                  <td>adam.jognson@gmail.com</td>
                  <td>01/02/2019</td>
                  <td>06/02/2019</td>
                  <td>
                     <div class="dropdown">
                        <button onclick="showDropdown(this)"  class="user-options dropbtn">Option</button>
                        <div id="myDropdown" class="dropdown-content">
                           <a href="#">Modifier</a>
                           <a href="#">Supprimer</a>
                        </div>
                     </div>
                  </td>
               </tr>
               <tr role="row">
                  <td>Adam Johnson</td>
                  <td>adam.jognson@gmail.com</td>
                  <td>01/02/2019</td>
                  <td>06/02/2019</td>
                  <td>
                     <div class="dropdown">
                        <button  onclick="showDropdown(this)" class="user-options dropbtn">Option</button>
                        <div id="myDropdown" class="dropdown-content">
                           <a href="#">Modifier</a>
                           <a href="#">Supprimer</a>
                        </div>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>