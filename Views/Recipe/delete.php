<div class="alert alert-danger">
    <h2>Recette enregistrée</h2>
    <h3>Rappel des valeurs choisies:</h3>
    <table class="table table-hover">
        <tr>
            <td>Id:</td>
            <td><?=$id?></td>
        </tr>
        <tr>
            <td>Titre:recipe_title</td>
            <td><?=$title?></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><?=$desc?></td>
        </tr>
        <tr>
            <td>Nombre de portions:</td>
            <td><?=$number?></td>
        </tr>
        <tr>
            <td>Difficulté</td>
            <td><?=$difficulty?></td>
        </tr>
    </table>

    <form id="delete-form" method="post">
        <input type="hidden" name="_METHOD" value="DELETE"/>
        <button type="submit" class="btn btn-danger">Supprimer Definitivement</button>
    </form>
</div>  