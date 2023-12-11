<?php require_once _ROOTPATH_ . '\templates\header.php'; ?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="assets/images/logo-bookeo.jpg" class="d-block mx-lg-auto img-fluid" alt="Bookeo" width="400" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Bookeo - Livre, BD, Manga</h1>
        <p class="lead">Découvrez et partagez vos lectures préférées sur Bookeo, où les livres, BD et mangas prennent vie. Notez, commentez et explorez dès maintenant !</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="index.php?controller=book&action=list" class="btn btn-primary btn-lg px-4 me-md-2">Voir tous les livres</a>
        </div>
    </div>
</div>

<h2>Découvez les dernières oeuvres</h2>

<div class="row text-center">
    <?php foreach ($books as $book) {
        require _TEMPLATEPATH_."\book\_partial_book.php";
    ?>

    <?php } ?>
</div>

<?php require_once _ROOTPATH_ . '\templates\footer.php'; ?>