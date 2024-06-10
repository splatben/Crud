<?php

declare(strict_types=1);

namespace src\Entity;

use Database\MyPdo;
use PDO;

class Tvshow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private ?int $posterId ;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    public static function findById(int $id) : Tvshow
    {
        $stmt = MyPdo::getInstance()->prepare(<<<SQL
        SELECT *
        FROM tvshow
        WHERE id = :tvshowId
SQL);
        $stmt->execute([':tvshowId'=>$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS,self::class);
        if (($tvshow = $stmt->fetch()) === false) {
            throw new EntityNotFoundException();
        } else {
            return $stmt;
        }
    }

}