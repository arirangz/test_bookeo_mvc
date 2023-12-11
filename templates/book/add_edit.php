<?php require_once _TEMPLATEPATH_ . '\header.php';
use App\Entity\Book;
/** @var \App\Entity\Book $book */
?>

<h1><?= $pageTitle; ?></h1>


<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control <?= (isset($errors['title']))  ? ('is-invalid') : ''; ?>" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()); ?>">
        <?php if (isset($errors['title'])) { ?>
            <div class="invalid-feedback"><?= $errors['title']; ?></div>
        <?php } ?>

    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($book->getDescription()); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select name="type_id" id="type" class="form-select">
            <?php foreach ($types as $type) { 
                /** @var \App\Entity\Type $type */
                ?>
                <option value="<?= $type->getId(); ?>" <?php if ($book->getTypeId() == $type->getId()) { ?>selected="selected" <?php }; ?>><?= htmlspecialchars($type->getName());  ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="author" class="form-label">Auteur</label>
        <select name="author_id" id="author" class="form-select">
            <?php foreach ($authors as $author) { 
                /** @var \App\Entity\Author $author */
                ?>
                <option value="<?= $author->getId(); ?>" <?php if ($book->getAuthorId() == $author->getId()) { ?>selected="selected" <?php }; ?>><?= htmlspecialchars($author->getLastName(). ' '.$author->getFirstName());  ?></option>
            <?php } ?>
        </select>
    </div>

    <?php if (isset($_GET['id']) && isset($recipe['image'])) { ?>
        <p>
            <img src="<?= _BOOKS_IMAGES_FOLDER_ . $recipe['image'] ?>" alt="<?= $recipe['title'] ?>" width="100">
            <label for="delete_image">Supprimer l'image</label>
            <input type="checkbox" name="delete_image" id="delete_image">


        </p>
    <?php } ?>
    <input type="hidden" name="image" value="<?= $book->getImage(); ?>">
    <div class="mb-3">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file" id="file" class="form-control <?= (isset($errors['file']))  ? ('is-invalid') : ''; ?>">
        <?php if (isset($errors['file'])) { ?>
            <div class="invalid-feedback"><?= $errors['file']; ?></div>
        <?php } ?>
    </div>

    <input type="submit" name="saveBook" class="btn btn-primary" value="Enregistrer">

</form>


<?php require_once _TEMPLATEPATH_ . '\footer.php'; ?>