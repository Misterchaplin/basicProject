<?php
	commonUtils::flash("resultAttribution");
	commonUtils::flash("resultAjoutProjet");
	commonUtils::flash("resultAjoutTache");
	$obj = $data['project'];
	$na = $data["na"];
	$af = $data['af'];
	$ec = $data['ec'];
	$te = $data['te'];
?>
<div class="divTitle">
	<h1><?php echo $obj;?></h1>
</div>
<div class="divTitle">
	<?php 
	if($obj->getUtilisateur()->getId() == $_SESSION['membre']->getId())
	{
	?>
		<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/add.png" alt="ICON ADD TACHE"/>
		<a href="<?php echo $GLOBALS["siteUrl"]?>taches/formulaireAjoutTache/<?php echo $obj->getId();?>">
			<span>Ajouter une tâche</span>
		</a>
		<img src="<?php echo $GLOBALS["siteUrl"]?>img/icon/add.png" alt="ICON ADD Taskeur"/>
		<a href="<?php echo $GLOBALS["siteUrl"]?>taches/formulaireAjoutTaskeur">
			<span>Ajouter un taskeur</span>
		</a>
	<?php 
	}
	?>
	<span class="floatRight black"><?php echo $obj->getDatecreation()."<br>"."Responsable : ".$obj->getUtilisateur();?></span>
</div>
<div class="alert alert-info">
	<?php echo $obj->getDescription();?>
</div>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!-- NON ASSIGNEES -->

	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="aTitleAccordion naAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          Non Assignées
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
							<th>S'appropirer</th>
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
          A faire
          <span class="floatRight">[ <?php echo sizeof($af);?> ]</span>
        </a>
      </h4>
    </div>
	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    	<div class="panel-body">
    	  <?php if(!empty($af)){?>
      		<table class="table table-hover">
				<thead>
					<tr>							
						<th>Libellé</th>
						<th>Description</th>
						<th>Taskeur</th>
						<th>Commencer</th>
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
							<a class="btnAction" href="<?php echo $GLOBALS['siteUrl']?>projets/attribution/<?php echo $item->getId();?>/<?php echo $obj->getId();?>/2">Je la commence</a></td>
						<?php }?>
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
	          En cours
	          <span class="floatRight">[ <?php echo sizeof($ec);?> ]</span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
        	<?php if(!empty($ec)){?>
		      <table class="table table-hover">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Description</th>
							<th>Taskeur</th>
							<th>Terminer</th>
						</tr>
					</thead>
					<tbody>
		        	<?php 
		        	foreach ($ec as $item):?>
						<tr>
							<td><?php echo $item->getDesignation();?></td>
							<td><?php echo $item->getDescription()?></td>
							<td><?php echo $item->getRealiser()->getUtilisateur();?></td>
							<td><a class="btnAction" href="<?php echo $GLOBALS['siteUrl']?>projets/attribution/<?php echo $item->getId();?>/<?php echo $obj->getId();?>/3">Je l'ai terminée</a></td>
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
	          Terminées
	          <span class="floatRight">[ <?php echo sizeof($te);?> ]</span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
	        <?php if(!empty($te)){?>
		      <table class="table table-hover">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Description</th>
							<th>Taskeur</th>
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