<?php

namespace App\Repository;

use App\Entity\Book;
use App\Repository\AuthorRepository;
use App\Repository\TypeRepository;

class BookRepository extends Repository
{
    public function findOneById(int $id): Book|bool
    {

        $query = $this->pdo->prepare('SELECT * FROM book WHERE id = :id');
        $query->bindValue(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $book = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($book) {
            $book = Book::createAndHydrate($book);
            // On rajoute auteur
            $authorRepository = new AuthorRepository();
            $author =  $authorRepository->findOneById($book->getAuthorId());
            $book->setAuthor($author);

            // On rajoute type
            $typeRepository = new TypeRepository();
            $type =  $typeRepository->findOneById($book->getTypeId());
            $book->setType($type);

            return $book;
        } else {
            return false;
        }
    }

    public function findAll(int $limit = null, int $page = null): array
    {
        //@todo commencer par une requête simple puis gérer la pagination
        

        $booksArray = [];

        //@todo faire une boucle sur le tableau de livre pour hydrater et stocker les objets livres avec Book::createAndHydrate
    
        

        return $booksArray;
    }


    public function count(): int
    {

        $query = $this->pdo->prepare("SELECT COUNT(*) as total_books FROM book");
        $query->execute();
        $total = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($total && !empty($total['total_books'])) {
            $total = $total['total_books'];
        } else {
            $total = 0;
        }
        return $total;
    }

    public function persist(Book $book)
    {

        if ($book->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE book SET title = :title, 
                        description = :description, type_id = :type_id, author_id = :author_id, image = :image WHERE id = :id'
            );
            $query->bindValue(':id', $book->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                'INSERT INTO book (title, description, type_id, author_id, image) 
                                                    VALUES (:title, :description, :type_id, :author_id, :image)'
            );
        }

        $query->bindValue(':title', $book->getTitle(), $this->pdo::PARAM_STR);
        $query->bindValue(':description', $book->getDescription(), $this->pdo::PARAM_STR);
        $query->bindValue(':type_id', $book->getTypeId(), $this->pdo::PARAM_INT);
        $query->bindValue(':author_id', $book->getAuthorId(), $this->pdo::PARAM_INT);
        $query->bindValue(':image', $book->getImage(), $this->pdo::PARAM_STR);

        $res = $query->execute();

        if ($res) {
            if ($book->getId() == null) {
                $book->setId($this->pdo->lastInsertId());
            }
            return $book;
        } else {
            throw new \Exception("Erreur lors de l'enregistrement");
        }
    }

    public function removeById(int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM book WHERE id = :id');
        $query->bindValue(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
