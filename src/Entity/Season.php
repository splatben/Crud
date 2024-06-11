<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Season
{
    private int $id;

    private int $tvShowId;

    private String $name;
    private int $seasonNumber;
    private ?int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    public static function findById(int $id): Season
    {
        $req = MyPdo::getInstance()->prepare("SELECT * FROM season WHERE id = :id");
        $req->execute(['id' => $id]);
        $req->setFetchMode(PDO::FETCH_CLASS, Season::class);
        if(($res = $req->fetch()) === false) {
            throw new EntityNotFoundException();
        } else {
            return $res;
        }
    }

    public function getPoster(): ?Poster
    {
        if (!empty($this->posterId)) {
            return Poster::findById($this->posterId);
        } else {
            return null;
        }
    }
}
