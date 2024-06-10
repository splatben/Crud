<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Poster
{
    private int $id;
    private string $jpeg;

    public function getId(): int
    {
        return $this->id;
    }
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id) : Poster
    {
        $stmt =  MyPdo::getInstance()->prepare(<<<SQL
        SELECT *
        FROM poster
        WHERE id = :posterId

SQL);
        $stmt->execute([':posterId'=> $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS,self::class);
        if (($poster = $stmt->fetch())=== false)
        {
            throw new EntityNotFoundException();
        } else {
            return $poster;
        }
    }

}
