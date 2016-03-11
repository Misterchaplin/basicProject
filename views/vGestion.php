<div class="row">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Responsable</th>
				<th>Libellé</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($data as $projets):?>
			<tr class='clickable-row' data-href='<?php echo $GLOBALS['siteUrl'];?>projets/afficher/<?php echo $projets->getId();?>'>
				<td><?php echo $projets->getUtilisateur()->getPseudo();?></td>
				<td><?php echo $projets->getDesignation();?></td>
				<td><?php echo $projets->getDatecreation();?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>