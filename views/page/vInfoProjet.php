<?php
	commonUtils::flash("resultAttribution");
	commonUtils::flash("resultAjoutProjet");
	commonUtils::flash("resultAjoutTache");
	commonUtils::flash("resultAjoutTaskeur");
	$obj = $data['project'];
	$na = $data["na"];
	$af = $data['af'];
	$ec = $data['ec'];
	$te = $data['te'];
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
			<?php 
			if($obj->getUtilisateur()->getId() == $_SESSION['membre']->getId())
			{
			?>
				<li>
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/add.png" alt="ICON ADD TACHE"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>taches/formulaireAjoutTache/<?php echo $obj->getId();?>">
						<span>Créer une nouvelle tâche</span>
					</a>
				</li>
				<li>
					<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/add.png" alt="ICON ADD TASKEUR"/>
					<a href="<?php echo $GLOBALS["siteUrl"]?>projets/formulaireAjoutTaskeur/<?php echo $obj->getId();?>">
						<span>Ajouter un taskeur au projet</span>
					</a>
				</li>
			<?php 
			}
			?>
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
	<h1><?php echo $obj;?></h1>
</div>

<div class="alert alert-info">
	<p>Projet dirigé par <b><?php echo $obj->getUtilisateur();?></b></p>
	<p>Créé le <b><?php echo commonUtils::translateDate($obj->getDatecreation());?></b></p>
	<p class="center">" <?php echo $obj->getDescription();?> "</p>
</div>

<div class="divTitle center espaced">
	<h3>Gestion des tâches</h3>
</div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!-- NON ASSIGNEES -->

	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="aTitleAccordion naAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          Tâches non assignées
	          <span class="floatRight">[ <?php echo sizeof($na);?> ]</span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
	      <?php if(!empty($na)){?>
		      <table class="table">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Description</th>
							<th class="width20">S'appropirer</th>
						</tr>
					</thead>
					<tbody>
		        	<?php 
		        	foreach ($na as $item):?>
						<tr>
							<td><?php echo $item->getDesignation();?></td>
							<td><?php echo $item->getDescription()?></td>
							<td><a class="btnAction" href="<?php echo $GLOBALS['siteUrl']?>projets/attribution/<?php echo $item->getId();?>/<?php echo $obj->getId();?>/1">Je m'en occupe</a>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
	      <?php
			}
	      ?>	      	      
      	</div>
	    </div>
	  </div>

<!-- A FAIRE-->

	<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="aTitleAccordion afAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Tâches à commencer
          <span class="floatRight">[ <?php echo sizeof($af);?> ]</span>
        </a>
      </h4>
    </div>
	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    	<div class="panel-body">
    	  <?php if(!empty($af)){?>
      		<table class="table">
				<thead>
					<tr>							
						<th>Libellé</th>
						<th>Description</th>
						<th class="width20">Taskeur</th>
						<th class="width20">Commencer</th>
					</tr>
				</thead>
				<tbody>
	    			 <?php 
	        		foreach ($af as $item):?>
					<tr>
						<td><?php echo $item->getDesignation();?></td>
						<td><?php echo $item->getDescription()?></td>
						<td><?php echo $item->getRealiser()->getUtilisateur();?></td>
						<td>
						<?php if($_SESSION['membre']->getId() == $item->getRealiser()->getUtilisateur()->getId()){?>
							<a class="btnAction" href="<?php echo $GLOBALS['siteUrl']?>projets/attribution/<?php echo $item->getId();?>/<?php echo $obj->getId();?>/2">Je la commence</a>
						<?php } else{echo "Non commencée";}?>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<?php }?>
        </div>
	</div>
	</div>

<!-- EN COURS -->

	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="aTitleAccordion ecAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
	          Tâches en cours de production
	          <span class="floatRight">[ <?php echo sizeof($ec);?> ]</span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
        	<?php if(!empty($ec)){?>
		      <table class="table">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Description</th>
							<th class="width20">Taskeur</th>
							<th class="width20">Terminer</th>
						</tr>
					</thead>
					<tbody>
		        	<?php 
		        	foreach ($ec as $item):?>
						<tr>
							<td><?php echo $item->getDesignation();?></td>
							<td><?php echo $item->getDescription()?></td>
							<td><?php echo $item->getRealiser()->getUtilisateur();?></td>
							<td>
							<?php if($_SESSION['membre']->getId() == $item->getRealiser()->getUtilisateur()->getId()){?>	
								<a class="btnAction" href="<?php echo $GLOBALS['siteUrl']?>projets/attribution/<?php echo $item->getId();?>/<?php echo $obj->getId();?>/3">Je l'ai terminée</a></td>
							<?php } else{echo "En cours";}?>
							</tr>
					<?php endforeach;?>
					</tbody>
				</table>
				<?php }?>
      	</div>
	    </div>
	  </div>

<!-- TERMINEES -->

	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="aTitleAccordion teAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
	          Tâches terminées
	          <span class="floatRight">[ <?php echo sizeof($te);?> ]</span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
	        <?php if(!empty($te)){?>
		      <table class="table">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Description</th>
							<th class="width20">Taskeur</th>
						</tr>
					</thead>
					<tbody>
		        	<?php 
		        	foreach ($te as $item):?>
						<tr>
							<td><?php echo $item->getDesignation();?></td>
							<td><?php echo $item->getDescription()?></td>
							<td><?php echo $item->getRealiser()->getUtilisateur();?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
				<?php }?>
      	</div>
	    </div>
	  </div>
	  
</div>