<?php commonUtils::flash("resultAjoutProjet");?>
<form action="<?php echo $GLOBALS['siteUrl']?>projets/ajouterProjet" id="frmAddProject" name="frmAddProject" method="post">
	<div class="form-group">
		<!-- Les champs IdUtilisateur et DateCreation sont ajoutés automatiquement par le code -->
	    <label for="designation">Designation du projet</label>
	    <input maxlength="30" type="text" class="form-control" name="designation" id="designation" placeholder="Designation du projet" required>
	    <label for="description">Description du projet</label>
	    <input type="text" class="form-control" name="description" id="description" placeholder="Description du projet" required>
	    <input class="submit" class="btn btn-default" value="Ajouter le projet" name="submit" type="submit"/>    
	</div>
</form>