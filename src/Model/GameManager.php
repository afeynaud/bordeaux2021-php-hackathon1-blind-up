<?php

namespace App\Model;

class GameManager extends AbstractManager
{
    public const TABLE = 'music';

    public function showGameDatas()
    {
        $query = ("SELECT title, title_only, author
                    FROM " . self::TABLE);
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function countMusics()
    {
        $query = ("SELECT COUNT(*)
                    FROM " . self::TABLE);
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetch();
    }

    public function insert(array $music): int
    {
        $statement = $this->pdo->prepare('
        INSERT INTO ' . self::TABLE . '(title, title_only, author, url)
        VALUES (:title, :title_only, :author, :url)
        ');
        $statement->bindValue(':title', $music['title'], \PDO::PARAM_STR);
        $statement->bindValue(':title_only', $music['title_only'], \PDO::PARAM_STR);
        $statement->bindValue(':author', $music['author'], \PDO::PARAM_STR);
        $statement->bindValue(':url', $music['url'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
