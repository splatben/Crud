<?php

namespace Entity;

class Episode
{
    private int $id;
    private int $seasonId;
    private String $name;
    private String $overview;
    private Int $episodeNumber;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }
}