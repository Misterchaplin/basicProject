<?php

class commonUtils {
	
	// message flash SESSION
	public static function flash( $name, $message = '', $class = '')
	{
		//Si le message n'existe pas, alors : création du message
		if( !empty( $message ) && empty( $_SESSION[$name] ) )
		{
			if( !empty( $_SESSION[$name.'_class'] ) )
			{
				unset( $_SESSION[$name.'_class'] );
			}
			$_SESSION[$name] = $message;
			$_SESSION[$name.'_class'] = $class;
		}
		elseif( !empty( $_SESSION[$name] ) && empty( $message ) )
		{ // S'il existe alors on l'affiche
			if($class == "valInput")
			{
				echo $_SESSION[$name];
			}
			else
			{
				echo "<div class='".$_SESSION[$name.'_class']."' id='msg-flash'><span> #! ".$_SESSION[$name]."</span></div>";
			}
			unset($_SESSION[$name.'_class']);
			unset($_SESSION[$name]);
		}
	}
	
	// redirection
	public static function backTo($url = null){
		if($url == null){
			$url = "accueil";
		}
		header("location:".$GLOBALS["siteUrl"].$url);
	}
	
	// permet de charger les fichiers Js
	public static function loadJs($jsName){
		echo "<script type='text/javascript' src='".$GLOBALS['siteUrl']."js/".$jsName.".js'></script>";
	}
	
	// permet de charger les fichiers css
	public static function loadCss($cssName){
		echo "<link rel='stylesheet' type='text/css' href='".$GLOBALS['siteUrl']."css/".$cssName.".css'>";
	}
	
	// permet de charger le membre connecté
	public static function chargerMembre(){
		$membre=null;
		if (array_key_exists('membre', $_SESSION)){
			$membre=$_SESSION['membre'];
		}
		return $membre;
	}
	
	// permet de checker si l'email passée en paramêtre est déjà utilisée 
	public static function checkIfEmailExists($emailPosted){	
		$condition = "email ='".$emailPosted."'";	
		$email=DAO::getOne("Utilisateur", $condition);
		if($email==null){	// alors email disponible
			$validateEmail=true;
		}else{
			$validateEmail=false;
		}
		return $validateEmail;
	}
	
	// permet de calculer la diffèrence entre deux dates
	public static function getDiff($d1, $d2){
		$d1 = new DateTime($d1);
		$d2 = new DateTime($d2);
		$diff = $d2->diff($d1);
		$arrayUnit=array("%y", "%m", "%d", "%h", "%i", "%s"); // tableau permettant de stoker les codes de formats
		$arrayUnitPluriel=array("ans", "mois", "jours", "heures", "minutes", "secondes"); // tableau pluriel des unités de temps
		$arrayUnitSingle=array("an", "mois", "jour", "heure", "minute", "seconde"); // tableau singulier des unités de temps
		$format=""; // déclaration de la variable format
		for($i = 0; $i <= sizeof($arrayUnit)-1	; $i++){ // on parcours arrayUnit
			$value=intval($diff->format($arrayUnit[$i])); // on stock la valeur du temps selon l'unité
			if($value==1){ // si il y a 1 unité
				$format=$format.$arrayUnit[$i]." ".$arrayUnitSingle[$i]; // le format est défini
				$i=sizeof($arrayUnit); // on break la boucle
			}
			if($value>1){ // si il y a plus d'1 unité
				$format=$format." ".$arrayUnit[$i]." ".$arrayUnitPluriel[$i]; // le format est défini
				$i=sizeof($arrayUnit); // on break la boucle
			}
		}
		if($diff->format($format) == "" || $diff->format($format) == null){
			$diff = "A l'instant";
		}else{
			$diff="Il y a ".$diff->format($format);
		}
		return $diff;
	}	
	
	// permet de translate une dateTime en fr
	public static function translateTime($dateTimeParam, $needSec){
		$dateTime = new DateTime($dateTimeParam);
		$heures=$dateTime->format('H'); // récupère sous format H les heures
		if($heures[0] == "0"){  // si 05h alors (by example)
			$heures=$heures[1]; // on supprime le 0 devant 5
		}
		$mns=$dateTime->format('i');		// récupère sous format i les mns
		if($needSec == true){ // si il faut indiquer les secondes
			$sec=$dateTime->format('s'); // récupère sous format s les secondes
			$time=$heures."h ".$mns."mns ".$sec."s"; // valeur de retour avec les secondes
		}else{ // sinon sans les secondes
			$time=$heures." h ".$mns; // valeur de retour
		}
		return $time; // on retourne l'heure
	}
	
// permet de traduire la date en fr
	public static function translateDate($date, $format = null, $firstLetter = null, $secondLetter  = null){
		if($format == null){
			$format = '%d %B %Y';
		}
		setlocale(LC_TIME, 'fra_fra');
		$dateFr = utf8_encode(strftime($format,strtotime($date)));
		// si il faut ne prendre que certains caractères
		if($firstLetter > -1 && $secondLetter > -1)
		{	
			$arrayChar = array("é", "û", "juin", "juil", "août", "sept", "mars");
			foreach($arrayChar as $char)
			{
				if(strstr($dateFr, $char))
				{
					$secondLetter = $secondLetter + 1;
				}
			}
			$dateFr = substr($dateFr, $firstLetter, $secondLetter);
		}
		
		return $dateFr;
	}
}