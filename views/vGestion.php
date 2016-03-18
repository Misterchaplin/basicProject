<?php 
$lstResponsable = $data['lstProjectsResponsable'];
$lstLies = $data['lstProjects']
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<?php 
		if(!empty($lstResponsable))
		{
	?>
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Mes Projets
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body">
		      <table class="table table-hover">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Responsable</th>
							<th>Date de création</th>
						</tr>
					</thead>
					<tbody>
		        	<?php 
		        	foreach ($lstResponsable as $projet):?>
						<tr class='clickable-row' data-href='<?php echo $GLOBALS['siteUrl'];?>projets/afficher/<?php echo $projet->getId();?>'>
							<td><?php echo $projet->getDesignation();?></td>
							<td><?php echo $projet->getUtilisateur()?></td>
							<td><?php echo commonUtils::translateDate($projet->getDatecreation());?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
	      	</div>
		    </div>
		  </div>
	<?php
		}
		
		if(!empty($lstLies))
		{
	?>
			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Mes Projets liés
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	      		<div class="panel-body">
	      		 <table class="table table-hover">
					<thead>
						<tr>							
							<th>Libellé</th>
							<th>Responsable</th>
							<th>Date de création</th>
						</tr>
					</thead>
					<tbody>
        			<?php 
		        	foreach ($lstLies as $projet):?>
						<tr class='clickable-row' data-href='<?php echo $GLOBALS['siteUrl'];?>projets/afficher/<?php echo $projet->getProjet()->getId();?>'>							
							<td><?php echo $projet->getProjet()->getDesignation();?></td>
							<td><?php echo $projet->getProjet()->getUtilisateur()?></td>
							<td><?php echo commonUtils::translateDate($projet->getProjet()->getDatecreation());?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
        		</div>
		    </div>
		  </div>
	<?php 
		}
	?>
</div>