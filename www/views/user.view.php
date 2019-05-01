<div class="row">
   <div class="col-12 admin-users ">
      <div class="admin-users__main">

         <div class="admin-users__main__search-add-user">
            <div class="admin-users__main__search-add-user__search">
               <input class="input-control input-control-success admin-users__main__search-add-user__search__input" placeholder="Chercher utilisateur" />
               <a class="btn btn-success-outline admin-users__main__search-add-user__search__button">Chercher</a>
            </div>
            <a class="btn btn-success-outline admin-users__main__search-add-user__add-user">Ajouter utilisatuer</a>
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

               <?php


               // if(isset($allUsers)):
               //    echo '<tr role="row">';
               //    foreach($allUsers as $value){
               //       echo '<td>'.$value.'</td>';
               //       var_dump_pre($allUsers);

               //    }
               //    echo '</tr>';

               
               ?>

               <?php
               //    endif;
               
               ?>

               <tr role="row">
                  <td>Adam Johnson</td>
                  <td>adam.jognson@gmail.com</td>
                  <td>01/02/2019</td>
                  <td>06/02/2019</td>
                  <td>
                     <div class="dropdown">
                        <button onclick="showDropdown(this)" class="user-options dropbtn">Option</button>
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
                        <button onclick="showDropdown(this)" class="user-options dropbtn">Option</button>
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
                        <button onclick="showDropdown(this)" class="user-options dropbtn">Option</button>
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


   <a class="btn" data-popup-open="popup-1" href="#">Open Popup #1</a>

   <div class="popup" data-popup="popup-1">
      <div class="popup-inner">
         <h2>Wow! This is Awesome! (Popup #1)</h2>
         <p>Donec in volutpat nisi. In quam lectus, aliquet rhoncus cursus a, congue et arcu. Vestibulum tincidunt neque id nisi pulvinar aliquam. Nulla luctus luctus ipsum at ultricies. Nullam nec velit dui. Nullam sem eros, pulvinar sed pellentesque ac, feugiat et turpis. Donec gravida ipsum cursus massa malesuada tincidunt. Nullam finibus nunc mauris, quis semper neque ultrices in. Ut ac risus eget eros imperdiet posuere nec eu lectus.</p>
         <p><a data-popup-close="popup-1" href="#">Close</a></p>

         <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
      </div>
   </div>
</div>