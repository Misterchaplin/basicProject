<?php commonUtils::flash("resultSupprTache");?>
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
					<a href="<?php echo $GLOBALS["siteUrl"]?>projets/afficher/<?php echo $data['projet']->getId();?>">
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
	<h1>Modification de la tâche : <?php echo $data['tache'];?></h1>
</div>

A toi de jouer ly-char !


<div class="divTitle">
	<h1>Suppression de la tâche : <?php echo $data['tache'];?></h1>
</div>

<form action="<?php echo $GLOBALS['siteUrl']?>taches/deleteTask/<?php echo $data['projet']->getId();?>/<?php echo $data['tache']->getId();?>" id="frmDeleteTache" name="frmDeleteTache" method="post">
	<div class="form-group">
	   <p></p>
	    <input class="delete" class="btn btn-default" value="Supprimer la tâche" name="submit" type="submit"/>    
	</div>
</form>