<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use src\Entity\Tvshow;

class TvshowCollection
{
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(<<<SQL
        SELECT *
        FROM artist
        ORDER BY name
SQL);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Tvshow::class);
    }
}
