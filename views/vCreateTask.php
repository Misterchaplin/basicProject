<div class="form-group">

    <!-- Les champs IdUtilisateur et IdProjet sont ajoutés automatiquement par le code -->
    <label for="designation">Designation de la tâche</label>
    <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation de la tâche" required>

    <label for="description">Description de la tâche</label>
    <input type="text" class="form-control" name="description" id="description" placeholder="Description de la tâche" required>

    <select name="etat">
        <option value="1" selected="selected">A associer</option>
        <option value="2">A faire</option>
        <option value="3">En cours</option>
        <option value="4">Terminé</option>
    </select>

    <input class="submit" class="btn btn-default" value="Ajouter la tâche" name="submit" type="submit"/>

</div>