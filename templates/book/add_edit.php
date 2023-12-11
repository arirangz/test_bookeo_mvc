<?php require_once _TEMPLATEPATH_ . '/header.php'; ?>

<h1><?= $pageTitle; ?></h1>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control " id="title" name="title" value="">

    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <!-- Attention, cette liste doit être récupérer avec une requête-->
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select name="type_id" id="type" class="form-select">
            <option value="1">livre</option>
            <option value="2">manga</option>
            <option value="3">bande dessinée</option>
        </select>
    </div>

    <!-- Attention, cette liste doit être récupérer avec une requête-->
    <div class="mb-3">
        <label for="author" class="form-label">Auteur</label>
        <select name="author_id" id="author" class="form-select">
            <option value="5">Caro Fabrice</option>
            <option value="4">Ito Junji</option>
            <option value="3">Orwell George</option>
        </select>
    </div>

    <input type="hidden" name="image" value="">
    <div class="mb-3">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file" id="file" class="form-control ">
    </div>

    <input type="submit" name="saveBook" class="btn btn-primary" value="Enregistrer">

</form>


<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>