<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function create(array $userData): int
    {
        $statement = $this->pdo->prepare('
        INSERT INTO user (pseudo, mail, password, created_at, is_admin, leaderboard_score)
        VALUES (:pseudo, :mail,  :password, NOW(), false,0)');
        $statement->bindValue(':pseudo', $userData['pseudo'], \PDO::PARAM_STR);
        $statement->bindValue(':mail', $userData['mail'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $userData['password'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    public function selectOneByEmail(string $mail)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE mail=:mail");
        $statement->bindValue(':mail', $mail, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
}

