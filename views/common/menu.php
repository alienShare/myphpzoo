<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if(!Security::checkAccessSession()) :?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>back/login" >Login</a>
        </li>
      <?php else :?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>back/admin" >Accueil</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Familles
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= URL ?>back/familles/visualisation">Visualiser</a></li>
            <li><a class="dropdown-item" href="<?= URL ?>back/familles/creation">Creer</a></li>
            
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>back/logout" >Déconnexion</a>
        </li>
        <?php endif ?>
      </ul>
      
    </div>
  </div>
 
</nav>
