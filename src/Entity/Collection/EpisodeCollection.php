<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use Entity\Exception\EntityNotFoundException;
use PDO;

class EpisodeCollection
{
    public static function findBySeasonId(Int $id): array
    {
        $req = MyPdo::getInstance()->prepare(<<<SQL
        Select * 
        From episode
        Where seasonId = ?
        ORDER BY episodeNumber
        SQL);
        $req->execute([$id]);
        $eps = $req->fetchAll(PDO::FETCH_CLASS, Episode::class);
        return $eps;

    }
}
