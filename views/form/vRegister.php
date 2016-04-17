
<?php commonUtils::flash("resultInscription");?>
<form action="<?php echo $GLOBALS['siteUrl']?>accueil/inscrireMembre" method="post" name="frmRegisterUser">
 	<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php commonUtils::flash("pseudoInscription","","valInput");?>" required>
 	<input type="text" name="surname" id="surname" placeholder="Nom" value="<?php commonUtils::flash("surnameInscription","","valInput");?>" required>
 	<input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?php commonUtils::flash("firstnameInscription","","valInput");?>" required>
    <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" value="<?php commonUtils::flash("passwdInscription","","valInput");?>" maxlength="20" required>
    <input type="password" name="passwdConfirm" id="passwdConfirm" placeholder="Confirmer mot de passe" value="<?php commonUtils::flash("passwdConfirmInscription","","valInput");?>" maxlength="20" required>
	<input class="submit" value="S'inscrire" name="submit" type="submit"/>
	<a href="<?php echo $GLOBALS['siteUrl']?>accueil">Connexion</a>
</form>
