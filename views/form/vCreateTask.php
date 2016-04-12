<?php commonUtils::flash("resultAjoutTache");?>
<nav class="navbar navbar-default">
	<div class="navbar-header">
		<div id="bs-example-navbar-collapse-7">
			<ul class="nav navbar-nav">
				<li>
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/home.png" alt="ICON HOME"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>">
						<span>Accueil</span>
					</a>
				</li>
				<li>
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/back.png" alt="ICON BACK"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>projets/afficher/<?php echo $data;?>">
						<span>Retour</span>
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
	<h1>Création d'une nouvelle tâche</h1>
</div>

<form action="<?php echo $GLOBALS['siteUrl']?>taches/ajouterTache/<?php echo $data;?>" id="frmAddTache" name="frmAddTache" method="post">
	<div class="form-group">
	    <label for="designation">Designation de la tâche</label>
	    <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation de la tâche" required>
	    <label for="description">Description de la tâche</label>
	    <input type="text" class="form-control" name="description" id="description" placeholder="Description de la tâche" required>
	    <input class="submit" class="btn btn-default" value="Ajouter la tâche" name="submit" type="submit"/>
	</div>