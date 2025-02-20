<h2>Liste des recettes</h2>

<table class="table table-striped table-hover">
    <tr class="table-dark">
        <th>Titre</td>
        <th>Description</td>
        <th>Nb Portions</td>
        <th>Difficulté</td>
        <th>Actions</td>
    </tr>
    <?php
    foreach ($recipes as $recipe) {
    ?>
        <tr>
            <td><?= $recipe['title'] ?></td>
            <td><?= $recipe['desc'] ?></td>
            <td><?= $recipe['number'] ?></td>
            <td><?= $recipe['difficulty'] ?></td>
            <td>
                <a class="btn btn-primary" href="/recipes/detail/<?= $recipe['id'] ?>/">Voir Détail</a>
                <a class="btn btn-danger" href="/recipes/delete/<?= $recipe['id'] ?>/">Supprimer</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>