<?php commonUtils::flash("resultAjoutTache");?>
<form action="<?php echo $GLOBALS['siteUrl']?>taches/ajouterTache/<?php echo $data;?>" id="frmAddProject" name="frmAddProject" method="post">
	<div class="form-group">
	    <!-- Les champs IdUtilisateur et IdProjet sont ajoutés automatiquement par le code -->
	    <label for="designation">Designation de la tâche</label>
	    <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation de la tâche" required>
	    <label for="description">Description de la tâche</label>
	    <input type="text" class="form-control" name="description" id="description" placeholder="Description de la tâche" required>
	    <input class="submit" class="btn btn-default" value="Ajouter la tâche" name="submit" type="submit"/>
	</div>