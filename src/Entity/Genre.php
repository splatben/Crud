<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Genre
{
    private Int $id;
    private String $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function findById(Int $id): Genre
    {
        $req = MyPdo::getInstance()->prepare(<<<SQL
        Select * 
        FROM genre
        Where id = ?
SQL);
        $req->execute([$id]);
        $req->setFetchMode(PDO::FETCH_CLASS, Genre::class);
        if (($genre = $req->fetch()) === false) {
            throw new EntityNotFoundException();
        } else {
            return $genre;
        }
    }
}
