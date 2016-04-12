<?php commonUtils::flash("resultAjoutProjet");?>
<nav class="navbar navbar-default">
	<div class="navbar-header">
		<div id="bs-example-navbar-collapse-7">
			<ul class="nav navbar-nav">
				<li>
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/home.png" alt="ICON BACK"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>">
						<span>Accueil</span>
					</a>
				</li>
				<li>
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/infos.png" alt="ICON GUIDE"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>accueil/guide">
						<span>Guide de gestion</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="divTitle">
	<h1>Création d'un nouveau projet</h1>
</div>

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