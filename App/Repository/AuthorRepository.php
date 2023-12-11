<?php

namespace App\Repository;

use App\Entity\Author;
use App\Db\Mysql;

class AuthorRepository extends Repository
{

    public function findOneById(int $id): Author|bool
    {

        $query = $this->pdo->prepare('SELECT * FROM author WHERE id = :id');
        $query->bindValue(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $author = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($author) {
            return Author::createAndHydrate($author);
        } else {
            return false;
        }
    }

    public function findAll(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM author ORDER BY last_name ASC");
        $query->execute();
        $authors = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $authorsArray = [];
        if (!empty($authors)) {
            foreach ($authors as $author) {
                $authorsArray[] = Author::createAndHydrate($author);
            }
        }

        return $authorsArray;
    }
}
