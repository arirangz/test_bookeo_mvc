<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\CommentRepository;
use App\Entity\Book;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Rating;
use App\Tools\FileTools;
use App\Repository\TypeRepository;
use App\Repository\AuthorRepository;
use App\Repository\RatingRepository;


class BookController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'show':
                        $this->show();
                        break;
                    case 'add':
                        $this->add();
                        break;
                    case 'edit':
                        $this->edit();
                        break;
                    case 'delete':
                        // Appeler méthode delete()
                        $this->delete();
                        break;
                    case 'list':
                        $this->list();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    /*
    Exemple d'appel depuis l'url
        ?controller=book&action=show&id=1
    */
    protected function show()
    {
        $errors = [];

        try {
            if (isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                // Charger le livre par un appel au repository
                $bookRepository = new BookRepository();
                $book = $bookRepository->findOneById($id);

                if ($book) {
                    // Préparation de l'objet commentaire pour le formulaire
                    $commentRepository = new CommentRepository();
                    $comment = new Comment();
                    $comment->setBookId($book->getId());
                    $comment->setUserId(User::getCurrentUserId());
                    if (isset($_POST['saveComment'])) {
                        if (!User::isLogged()) {
                            throw new \Exception("Accès refusé");
                        }

                        $comment->hydrate($_POST);
                        $errors = $comment->validate();

                        if (empty($errors)) {
                            $commentRepository->persist($comment);
                            // on remet le commentaire vide pour l'ajout d'un commentaire
                            $comment = new Comment();
                        }
                    }

                    // Préparation de l'objet Rating pour le formulaire
                    $ratingRepository = new RatingRepository();
                    // On récupère si une note a déja été posté par l'utilisateur
                    $rating = $ratingRepository->findOneByBookIdAndUserId($book->getId(), User::getCurrentUserId());
                    if (!$rating) {
                        $rating = new Rating();
                    }
                    $rating->setBookId($book->getId());
                    $rating->setUserId(User::getCurrentUserId());
                    if (isset($_POST['saveRating'])) {
                        if (!User::isLogged()) {
                            throw new \Exception("Accès refusé");
                        }

                        $rating->hydrate($_POST);
                        $errors = $rating->validate();

                        if (empty($errors)) {
                            $ratingRepository->persist($rating);
                        }
                    }


                    // Récupéartion de la moyenne des notes
                    $averageRate = $ratingRepository->findAverageByBookId($book->getId());

                    // Récupération des commentaires existants
                    $commentRepository = new CommentRepository();
                    $comments = $commentRepository->findAllByBookId($book->getId());

                    $this->render('book/show', [
                        'book' => $book,
                        'comments' => $comments,
                        'newComment' => $comment,
                        'rating' => $rating,
                        'averageRate' => $averageRate,
                        'errors' => $errors,
                    ]);
                } else {
                    $this->render('errors/default', [
                        'error' => 'Livre introuvable'
                    ]);
                }
            } else {
                throw new \Exception("L'id est manquant en paramètre");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function add()
    {
        $this->add_edit();
    }

    protected function edit()
    {
        try {
            if (isset($_GET['id'])) {
                $this->add_edit((int)$_GET['id']);
            } else {
                throw new \Exception("L'id est manquant en paramètre");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function add_edit($id = null)
    {

        try {
            // Cette action est réservé aux admin
            if (!User::isLogged() || !User::isAdmin()) {
                throw new \Exception("Accès refusé");
            }
            $bookRepository = new BookRepository();
            $errors = [];
            if (is_null($id)) {
                $book = new Book();
            } else {
                $book = $bookRepository->findOneById($id);
                if (!$book) {
                    throw new \Exception("Le livre n'existe pas");
                }
            }

            // Récupération des types
            $typeRepository = new TypeRepository;
            $types = $typeRepository->findAll();

            // Récupération des auteurs
            $authorRepository = new AuthorRepository;
            $authors = $authorRepository->findAll();

            if (isset($_POST['saveBook'])) {
                $book->hydrate($_POST);
                $errors = $book->validate();


                if (empty($errors)) {
                    $fileErrors = [];
                    // On lance l'upload de fichier
                    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] !== '') {
                        $res = FileTools::uploadImage(_BOOKS_IMAGES_FOLDER_, $_FILES['file'], $_POST['image']);
                        if (empty($res['errors'])) {
                            $book->setImage($res['fileName']);
                        } else {
                            $fileErrors = $res['errors'];
                        }
                    }
                    if (empty($fileErrors)) {
                        // on lance le save

                        $book = $bookRepository->persist($book);

                        // On redirige vers la page du livre
                        header('location: index.php?controller=book&action=show&id=' . $book->getId());
                    } else {
                        $errors = array_merge($errors, $fileErrors);
                    }
                }
            }

            $this->render('book/add_edit', [
                'book' => $book,
                'types' => $types,
                'authors' => $authors,
                'pageTitle' => 'Ajouter un livre',
                'errors' => $errors
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function list()
    {

        $bookRepository = new BookRepository;

        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
        } else {
            $page = 1;
        }
        $books = $bookRepository->findAll(_ITEM_PER_PAGE_, $page);
        $totalBooks = $bookRepository->count();
        $totalPages = ceil($totalBooks / _ITEM_PER_PAGE_);


        $this->render('book/list', [
            'books' => $books,
            'totalPages' => $totalPages,
            'page' => $page,
        ]);
    }


    protected function delete()
    {
        try {
            // Cette action est réservé aux admin
            if (!User::isLogged() || !User::isAdmin()) {
                throw new \Exception("Accès refusé");
            }

            if (!isset($_GET['id'])) {
                throw new \Exception("L'id est manquant en paramètre");
            }
            $bookRepository = new BookRepository();

            $id = (int)$_GET['id'];

            $book = $bookRepository->findOneById($id);

            if (!$book) {
                throw new \Exception("Le livre n'existe pas");
            }
            if ($bookRepository->removeById($id)) {
                // On redirige vers la liste de livre
                header('location: index.php?controller=book&action=list&alert=delete_confirm');
            } else {
                throw new \Exception("Une erreur est survenue l'ors de la suppression");
            }

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
