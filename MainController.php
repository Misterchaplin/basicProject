<?php
error_reporting(E_ALL);
$GLOBALS["siteUrl"]="/basicProject/";
?>

<?php
require_once 'technics/log/Logger.php';

//DAO::$db=new Database("m57vctnn","sql2.olympe.in","3306","m57vctnn","512popdjh");
DAO::$db=new Database("basicproject","localhost","3306","root","");
DAO::$db->connect();
$ctrl=new MainController();
$ctrl->run();

function __autoload($myClass){
	if(file_exists("controllers/".$myClass.".php"))
		require_once("controllers/".$myClass.".php");
	else if(file_exists("classes/".$myClass.".php"))
		require_once("classes/".$myClass.".php");
	else if(file_exists("technics/".$myClass.".php"))
		require_once("technics/".$myClass.".php");
}
class MainController{
	private $urlParts;
	
	public function __construct(){
		if(!$this->isValid())
			$this->onInvalidControl();
	}
	
	public function index(){
		
	}
	public function isValid(){
		return true;
	}
	
	/**
	 * 
	 */
	public function onInvalidControl() {
		//header("location:CtrlLogin");
	}

	
	public function run(){
		session_start();
		Logger::init();
		$url=$_GET["c"];
		if(StrUtils::endswith($url, "/"))
			$url=substr($url, 0,strlen($url)-1);
		$this->urlParts=explode("/", $url);
		
		$u=$this->urlParts;
		$urlSize=sizeof($u);

		if(class_exists($u[0])){
			//Construction de l'instance de la classe (1er élément du tableau)
			try{
				$obj=new $u[0]();
				try{
					switch ($urlSize) {
						// Appel de la méthode index du controller
						case 1:
							if(method_exists($obj,"index"))
							{
								$obj->index();
							}
							else
							{
								commonUtils::backTo(); // redirection vers accueil
							}	
							break;
						//Appel d'une méthode (2ème élément du tableau) sans paramètre
						case 2:							
							if(method_exists($obj,$u[1])){
								$obj->$u[1]();
							}
							else{
								//$obj->index(); 
								commonUtils::backTo(); // retour a l'accueil du controlleur
							}
							break;
						//Appel d'une méthode (2ème élément du tableau) avec 1 paramètre
						case 3:							
							if(method_exists($obj,$u[1])){
								$obj->$u[1]($u[2]);
							}
							else{
								//$obj->index();
								commonUtils::backTo(); // retour a l'accueil du controlleur
							}
							break;
						//Appel d'une méthode (2ème élément du tableau) avec 2 paramètres
						case 4:
							if(method_exists($obj,$u[1])){
								$obj->$u[1]($u[2],$u[3]);
							}
							else{
								//$obj->index();
								commonUtils::backTo(); // retour a l'accueil du controlleur
							}
							break;
						//Appel d'une méthode (2ème élément du tableau) avec 3 paramètres
						case 5:
								if(method_exists($obj,$u[1])){
									$obj->$u[1]($u[2],$u[3], $u[4]);
								}
								else{
									//$obj->index();
									commonUtils::backTo(); // retour a l'accueil du controlleur
								}
								break;
						default:
							//Appel de la méthode en lui passant en paramètre le reste du tableau
							$obj->$u[1](array_slice($u, 2));
						break;
					}
				}catch (Exception $e){
					print "Error!: " . $e->getMessage() . "<br/>";
					die();
				}
			}catch (Exception $e){
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}

		}else{
			//if($this->urlParts[0]=="" || $this->urlParts[0]=="accueil"){
				//$obj= new accueil();
				//$obj->index();
			commonUtils::backTo();
			/*/else{
				print "Le contrôleur ".$u[0]." n'existe pas <br/>";
			}*/
		}
	}
}
?>