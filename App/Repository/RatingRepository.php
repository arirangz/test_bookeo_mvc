<?php

namespace App\Repository;

use App\Entity\Rating;
use App\Db\Mysql;
use App\Tools\StringTools;

class RatingRepository extends Repository
{


    public function findOneByBookIdAndUserId(int $book_id, int $user_id): Rating|bool
    {

        $query = $this->pdo->prepare('SELECT * FROM rating WHERE book_id = :book_id AND user_id = :user_id');
        $query->bindValue(':book_id', $book_id, $this->pdo::PARAM_INT);
        $query->bindValue(':user_id', $user_id, $this->pdo::PARAM_INT);
        $query->execute();
        $rating = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($rating) {
            return Rating::createAndHydrate($rating);
        } else {
            return false;
        }
    }

    public function findAverageByBookId(int $book_id):int|bool
    {
        $query = $this->pdo->prepare("SELECT AVG(rate) as rate FROM rating WHERE book_id = :book_id");
        $query->bindParam(':book_id', $book_id, $this->pdo::PARAM_STR);
        $query->execute();
        $rate = $query->fetch($this->pdo::FETCH_ASSOC);

        if ($rate && !empty($rate['rate'])) {
            $rate = floor($rate['rate']);
        } else {
            $rate = false;
        }

        return $rate;

    }

    public function persist(Rating $rating)
    {
        
        if ($rating->getId() !== null) {
                $query = $this->pdo->prepare('UPDATE rating SET rate = :rate, book_id = :book_id,  
                                                    user_id = :user_id  WHERE id = :id'
                );
                $query->bindValue(':id', $rating->getId(), $this->pdo::PARAM_INT);
           

        } else {
            $query = $this->pdo->prepare('INSERT INTO rating (rate, book_id, user_id, created_at) 
                                                    VALUES (:rate, :book_id, :user_id, :created_at)'
            );
            $query->bindValue(':created_at', $rating->getCreatedAt()->format('Y-m-d H:i:s'), $this->pdo::PARAM_STR);


        }

        $query->bindValue(':rate', $rating->getRate(), $this->pdo::PARAM_STR);
        $query->bindValue(':book_id', $rating->getBookId(), $this->pdo::PARAM_STR);
        $query->bindValue(':user_id', $rating->getUserId(), $this->pdo::PARAM_STR);

        return $query->execute();
    }
}