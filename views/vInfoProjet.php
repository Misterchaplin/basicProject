<?php 
	$obj = $data['project'];
?>
<div class="divTitle">
	<h1><?php echo $obj;?></h1>
	<span><?php echo $obj->getDatecreation();?></span>
</div>

<?php 
	var_dump($data["project"]);
	echo "bjbjb------------------------------";
	var_dump($data["tasks"]);
?>