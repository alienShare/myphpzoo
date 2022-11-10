<?php
ob_start(); ?>
<form 
method="POST"
action="<?=URL ?>back/familles/creationFamilleValidation">

  <div class="mb-3">
    <label for="famille_libelle" class="form-label">Nom de la famille</label>
    <input type="text" class="form-control" id="famille_libelle" name="famille_libelle">
  </div>  
  <label for="famille_description" class="form-label" >Description</label>
  <div class="form-group">
    <textarea 
            aria-colspan="3" 
            class="form-control" 
            id="famille_description"
            name="famille_description"
            >
    </textarea>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Valider</button>
  </div>
</form>

<?php
$content = ob_get_clean();
$titre = "Page de création d'une famille";
require "views/common/template.php";