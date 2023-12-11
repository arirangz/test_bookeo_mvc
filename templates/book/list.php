<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>

<h1>Liste complète</h1>

<div class="row text-center mb-3">
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/uploads/books/3-zai-zai-zai-zai.jpg" class="card-img-top" alt="Zaï Zaï Zaï Zaï">
            <div class="card-body">
                <h5 class="card-title">Zaï Zaï Zaï Zaï</h5>
                <p class="card-text">Au passage à la caisse d'un supermarché, un auteur de bande dessinée réalise qu’il n’a pas s...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=82" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/uploads/books/2-histoires-courtes.jpg" class="card-img-top" alt="Histoires courtes">
            <div class="card-body">
                <h5 class="card-title">Histoires courtes</h5>
                <p class="card-text">Ce volume unique rassemble les nouvelles créées par le maître Junji Ito pour l'éditeur japonais ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=81" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/uploads/books/1-1984.jpg" class="card-img-top" alt="1984">
            <div class="card-body">
                <h5 class="card-title">1984</h5>
                <p class="card-text">L’histoire se passe à Londres en 1984, comme l'indique le titre du roman. Le monde, depuis les gr...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=80" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/assets/images/default-book.jpg" class="card-img-top" alt="Test 79">
            <div class="card-body">
                <h5 class="card-title">Test 79</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=79" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/assets/images/default-book.jpg" class="card-img-top" alt="Test 78">
            <div class="card-body">
                <h5 class="card-title">Test 78</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=78" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/assets/images/default-book.jpg" class="card-img-top" alt="Test 77">
            <div class="card-body">
                <h5 class="card-title">Test 77</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=77" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/assets/images/default-book.jpg" class="card-img-top" alt="Test 76">
            <div class="card-body">
                <h5 class="card-title">Test 76</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=76" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/assets/images/default-book.jpg" class="card-img-top" alt="Test 75">
            <div class="card-body">
                <h5 class="card-title">Test 75</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=75" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 d-flex">
        <div class="card">
            <img src="/assets/images/default-book.jpg" class="card-img-top" alt="Test 74">
            <div class="card-body">
                <h5 class="card-title">Test 74</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ...</p>
                <a href="index.php?controller=book&amp;action=show&amp;id=74" class="btn btn-primary">Lire la suite</a>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <li class="page-item">
                    <a class="page-link" href="#"><?php echo $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>




<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>