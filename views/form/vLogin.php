
<?php commonUtils::flash("resultConnexion");?>
<form action="<?php echo $GLOBALS['siteUrl']?>accueil/connexionMembre" method="post" name="frmAddUser">
 	<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php commonUtils::flash("pseudoConnexion","","valInput");?>" required>
    <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" value="<?php commonUtils::flash("passwdConnexion","","valInput");?>" required>
	<input class="submit" value="Se connecter" name="submit" type="submit"/>
</form>