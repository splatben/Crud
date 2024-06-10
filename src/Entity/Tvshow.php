<?php

declare(strict_types=1);

namespace src\Entity;

class Tvshow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private ?int $posterId ;
}