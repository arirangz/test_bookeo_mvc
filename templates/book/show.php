<?php

use App\Entity\User;

require_once _TEMPLATEPATH_ . '\header.php';
/** @var  App\Entity\Book $book */
?>

<div class="row align-items-start g-5 py-5 my-5 bg-body-tertiary">
    <div class="col-10 col-sm-8 col-lg-4">
        <img src="<?= htmlspecialchars($book->getImagePath()); ?>" class="d-block mx-lg-auto img-fluid" alt="<?= htmlspecialchars($book->getTitle()); ?>" >
    </div>
    <div class="col-lg-4">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?= htmlspecialchars($book->getTitle()); ?></h1>
        <p class="lead"><?= nl2br(htmlspecialchars($book->getDescription())); ?></p>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <?php if (User::isLogged() && User::isAdmin()) { ?>
            <div class="card mb-3">
                <div class="card-body p-4">
                    <a href="index.php?controller=book&action=edit&id=<?= $book->getId(); ?>" class="btn btn-primary">Modifier</a>
                    <a href="index.php?controller=book&action=delete&id=<?= $book->getId(); ?>" class="btn btn-primary">Supprimer</a>

                </div>
            </div>
        <?php } ?>

        <div class="card mb-3">
            <div class="card-body p-4">
                <h2>Auteur : <?= htmlspecialchars($book->getAuthor()->getDisplayName()) ?></h2>
                <h2>Type : <?= htmlspecialchars($book->getType()->getName()) ?></h2>
            </div>
        </div>
        <?php require_once _TEMPLATEPATH_ . '\book\_partial_rating.php'; ?>
    </div>
</div>


<div class="row align-items-start justify-content-center">

    <?php require_once _TEMPLATEPATH_ . '\book\_partial_comments.php'; ?>
</div>




<?php require_once _TEMPLATEPATH_ . '\footer.php'; ?>