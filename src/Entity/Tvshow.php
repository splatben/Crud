<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Tvshow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private ?int $posterId ;

    public function getId(): ?int
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
    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }



    public static function findById(int $id): Tvshow
    {
        $stmt = MyPdo::getInstance()->prepare(<<<SQL
        SELECT *
        FROM tvshow
        WHERE id = :tvshowId
SQL);
        $stmt->execute([':tvshowId' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Tvshow::class);
        if (($tvShow = $stmt->fetch()) === false) {
            throw new EntityNotFoundException();
        } else {
            return $tvShow;
        }
    }

    public function getPoster(): ?Poster
    {
        $poster = null;
        if (isset($this->posterId)) {
            $poster = Poster::findById($this->posterId);
        }
        return $poster;
    }

    public function getSeasons(): array
    {
        return SeasonCollection::findByTvShowId($this->id);
    }

    public function delete(): Tvshow
    {
        $del = MyPdo::getInstance()->prepare(<<<SQL
    DELETE FROM tvshow
    WHERE id = :showId

SQL);
        $del->execute([':showId'=> $this->id]);
        $this->setId(null);
        return $this;
    }

}
