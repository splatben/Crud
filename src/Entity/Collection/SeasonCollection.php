<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use PDO;

class SeasonCollection
{
    public static function findByTvShowId(Int $id): array
    {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
Select *
From season
Where tvshowid = :id
Order by seasonnumber;
SQL
        );
        $req->execute([':id' => $id]);
        if (($seasons = $req->fetchAll(PDO::FETCH_CLASS, Season::class)) === false) {
            throw new EntityNotFoundException();
        } else {
            return $seasons;
        }
    }
}
