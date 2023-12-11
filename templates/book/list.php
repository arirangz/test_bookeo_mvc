<?php require_once _ROOTPATH_ . '\templates\header.php'; ?>

<h1>Liste complète</h1>

<?php if (isset($_GET['alert'])) { ?>
    <div class="alert alert-success" role="alert">
        Le livre a bien été supprimé
    </div>
<?php } ?>

<div class="row text-center mb-3">
    <?php foreach ($books as $book) {
        require _TEMPLATEPATH_ . "\book\_partial_book.php";
    ?>

    <?php } ?>
</div>

<?php if ($totalPages > 1) { ?>

    <div class="row">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item">
                        <a class="page-link <?php if ($i == $page) { echo " active"; } ?>" href="/index.php?controller=book&action=list&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

<?php } ?>


<?php require_once _ROOTPATH_ . '\templates\footer.php'; ?>