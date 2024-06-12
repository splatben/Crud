<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use PDO;

class TvshowCollection
{
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(<<<SQL
        SELECT *
        FROM tvshow
        ORDER BY name
SQL);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Tvshow::class);
    }

    public static function findByGenreId(Int $id): array
    {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
        Select * 
        From tvshow
        Where id IN(Select tvShowId From tvshow_genre Where genreId = ?)
        SQL
        );
        $req->execute([$id]);
        return $req->fetchAll(PDO::FETCH_CLASS, Tvshow::class);


    }
}
