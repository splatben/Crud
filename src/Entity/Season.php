<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Season
{
    private int $id;

    private int $tvShowId;

    private String $name;
    private int $seasonNumber;
    private ?int $posterId;

    public function setId(int $id): Season
    {
        $this->id = $id;
        return $this;
    }

    public function setTvShowId(int $tvShowId): Season
    {
        $this->tvShowId = $tvShowId;
        return $this;
    }

    public function setName(string $name): Season
    {
        $this->name = $name;
        return $this;
    }

    public function setSeasonNumber(int $seasonNumber): Season
    {
        $this->seasonNumber = $seasonNumber;
        return $this;
    }

    public function __construct()
    {

    }
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

    public function getPoster(): string
    {
        return "http://localhost:8000/poster.php?posterId={$this->posterId}";
    }

    public function getEpisodes(): array
    {
        return EpisodeCollection::findBySeasonId($this->id);
    }

    public function update():self
    {
        $req = MyPdo::getInstance()->prepare(<<<SQL
        UPDATE season 
        Set tvshowid = :tvshowid,
             name = :Name,
            seasonnumber = :seasonNumber
        WHERE id = :id
SQL);
        $req->execute([':tvshowid'=>$this->tvShowId,
            ':name'=>$this->name,
            ':seasonNumber'=>$this->seasonNumber]);
        return $this;
    }

    public static function create(string $name, int $tvShowId, int $seasonNumber, ?int $id = null):self
    {
        $this = new Season();

    }


}
