<?php
	commonUtils::flash("resultAttribution");
	$obj = $data['project'];
	$na = $data["na"];
	$af = $data['af'];
	$ec = $data['ec'];
	$te = $data['te'];
?>
<div class="divTitle">
	<h1><?php echo $obj;?></h1>
	<span class="floatRight"><?php echo commonUtils::translateDate($obj->getDatecreation());?><br>Dirigé par <?php echo $obj->getUtilisateur();?></span>
</div>
<div class="alert alert-info">
	<?php echo $obj->getDescription();?>
</div>

<?php
if(!empty($na))
{
?>
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="naAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          Non Assignées
	        </a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
	      <table class="table">
				<thead>
					<tr>							
						<th>Libellé</th>
						<th>Description</th>
						<th>Taskeur</th>
					</tr>
				</thead>
				<tbody>
	        	<?php 
	        	foreach ($na as $item):?>
					<tr>
						<td><?php echo $item->getDesignation();?></td>
						<td><?php echo $item->getDescription()?></td>
						<td><a class="btnAction" href="<?php echo $GLOBALS['siteUrl']?>projets/attribution/<?php echo $item->getId();?>/<?php echo $obj->getId();?>">Je m'en occupe</a>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
      	</div>
	    </div>
	  </div>
<?php
}

if(!empty($af))
{
?>
			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="afAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          A faire
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	      		<div class="panel-body">
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
        			foreach ($af as $item):?>
					<tr>
						<td><?php echo $item->getDesignation();?></td>
						<td><?php echo $item->getDescription()?></td>
					</tr>
					<?php endforeach;?>
					</tbody>
				</table>
        		</div>
		    </div>
		  </div>
<?php 
}
		
if(!empty($ec))
{
	?>
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="ecAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
	          En cours
	        </a>
	      </h4>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
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
	        	foreach ($ec as $item):?>
					<tr>
						<td><?php echo $item->getDesignation();?></td>
						<td><?php echo $item->getDescription()?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
      	</div>
	    </div>
	  </div>
<?php
}
		
if(!empty($te))
{
	?>
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="teAccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
	          Terminées
	        </a>
	      </h4>
	    </div>
	    <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
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