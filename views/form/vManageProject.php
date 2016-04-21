<?php commonUtils::flash("resultSupprProjet");
 commonUtils::flash("resultUpdateProj");
 ?>
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
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/back.png" alt="ICON BACK"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>projets/afficher/<?php echo $data->getId();?>">
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
	<h1>Modification du projet : <?php echo $data->getDesignation();?></h1>
</div>

<form action="<?php echo $GLOBALS['siteUrl']?>projets/updateProj/<?php echo $data->getId();?>" id="frmUpdateProj" name="frmUpdateProj" method="post">
	<div class="form-group">
	
	    <label for="designation">Designation du projet</label>
	    <input maxlength="30" type="text" class="form-control" name="designation" id="designation" value="<?php echo $data;?>" placeholder="Designation du projet" required>
	    <label for="description">Description du projet</label>
	    <input type="text" class="form-control" name="description" id="description" value="<?php echo $data->getDescription();?>" placeholder="Description du projet" required>
	    <input class="submit" class="btn btn-default" value="Modifier le projet" name="submit" type="submit"/>    
	</div>
</form>



<div class="divTitle">
	<h1>Suppression du projet : <?php echo $data->getDesignation();?></h1>
</div>

<form action="<?php echo $GLOBALS['siteUrl']?>projets/deleteProj/<?php echo $data->getId();?>" id="frmDeleteProject" name="frmDeleteProject" method="post">
	<div class="form-group">
	   <p></p>
	    <input class="delete" class="btn btn-default" value="Supprimer le projet" name="submit" type="submit"/>    
	</div>
</form>