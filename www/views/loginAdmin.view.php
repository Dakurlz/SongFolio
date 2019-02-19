
    <main class="login-page">
      <div class="wrapper">
        <div class="col-lg-12">
          <div class="container row ">
            <div class="container__logo col-lg-6 col-md-6">
              <h1>SongFolio</h1>
            </div>
            <span class="container__line"></span>
            <div class="container__connection col-lg-6">
              <p>Nom de l’utilisateur ou adresse e-mail</p>
              <a class="log"></a><input class="input-control" type="text" />
              <p>Mot de passe</p>
              <input class="input-control" type="password" />
              <div class="container__connection__linkButton row ">
                <a class="link passForgot" href="#">Mot de passe oublié?</a>
                <a href="<?php echo Routing::getSlug("Admin", "default") ?>" class="btn btn-primary-outline" >Se connecter</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  
