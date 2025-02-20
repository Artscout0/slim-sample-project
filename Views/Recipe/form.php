<div id="errors">
    <?php

    foreach ($errors as $key => $error) {
        if (is_numeric($key)) {
            ?>
            <div class="alert alert-danger"><?= $error ?></div>
            <?php
        }
    }
    ?>
</div>
<form action="/add" method="post" class="needs-validation" novalidate>
    <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" id="title" placeholder="ex. Spaghetti" name="title" value="<?= $recipe_title ?>" required>
        <label for="title">Titre</label>
    </div>
    <div class="form-floating mb-3 mt-3">
        <textarea class="form-control" id="description" placeholder="Recette italienne classique..." name="description" required><?= $description ?></textarea>
        <label for="description">Description</label>
    </div>
    <div class="form-floating mb-3 mt-3">
        <input type="number" class="form-control <?= isset($errors['number']) ? 'is-invalid' : '' ?>" id="portions" placeholder="3" name="portions" min="1" max="10" step="1" value="<?= $portions ?>" required>
        <label for="portions">Nombre de portions (1-10)</label>
        <div class="invalid-feedback">
            <?= $errors['number'] ?>
        </div>
    </div>
    <div class="form-floating">
        <select class="form-select <?= isset($errors['difficulty']) ? 'is-invalid' : '' ?>" id="difficulty" name="difficulty" required>
            <option value="easy">Facile</option>
            <option value="average" selected default>Moyenne</option>
            <option value="hard">Difficile</option>
        </select>
        <label for="difficulty" class="form-label">Select list (select one):</label>

        <div class="invalid-feedback">
            <?= $errors['difficulty'] ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    // Textarea-autoheight stuff
    function calcHeight(value) {
        let numberOfLineBreaks = (value.match(/\n/g) || []).length;
        // min-height + lines x line-height + padding + border
        let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
        return newHeight;
    }
    let textarea = document.querySelector("textarea");
    textarea.addEventListener("keyup", () => {
        textarea.style.height = calcHeight(textarea.value) + 20 + "px";
    });

    // form validation stuff
    let form = document.querySelector('form')
    form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false);
</script>