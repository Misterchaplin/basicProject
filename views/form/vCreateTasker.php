<?php commonUtils::flash("resultAjoutTaskeur");?>
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
					<a href="<?php echo $GLOBALS["siteUrl"]?>projets/afficher/<?php echo $data['idProjet'];?>">
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
	<h1>Ajout d'un nouveau taskeur</h1>
</div>

<form action="<?php echo $GLOBALS['siteUrl']?>projets/ajouterTaskeur/<?php echo $data['idProjet'];?>" id="frmAddTasker" name="frmAddTasker" method="post">
	<div class="form-group">
	    <label for="designation">Choisissez le taskeur à ajouté au projet :</label>
	    <select required name="userSelected">
	    	<?php 
	    		foreach($data['lstUsers'] as $user)
	    		{
	    	?>
	    			<option value="<?php echo $user->getId();?>"><?php echo $user;?></option>
	    	<?php
	    		}
	    	?>
	    </select>
	    <input class="submit" class="btn btn-default" value="Ajouter le taskeur" name="submit" type="submit"/>
	</div>