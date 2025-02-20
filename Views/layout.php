<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="navbar navbar-expand-sm bg-light sticky-top">
        <div class="container-fluid">
            <h1 class="navbar-text"><?= $title ?></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/homepage">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/add">Ajouter une recette</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/recipes">Voir les recettes</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <main class="container mt-3">
        <?= $content ?>
    </main>
</body>

</html>