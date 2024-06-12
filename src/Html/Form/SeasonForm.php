<?php

namespace Html\Form;

use Entity\Season;
use Exception\ParameterException;
use Html\StringEscaper;

class SeasonForm
{
    use StringEscaper;
    private ?Season $season;
    /**
     * @param Season|null $season
     */
    public function __construct(?Season $season = null)
    {
        $this->season = $season;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function getHtmlForm(string $action): string
    {
        return <<<HTML
<form method="post" action="$action">
    <input name="id" type="hidden" value="{$this->season?->getId()}">
    <label> Nom
        <input type="text" name="name" required value="{$this->escapeString($this->season?->getName())}">
    </label>
    <label> Nom de base
        <input type="text" name="tvShowId" required value="{$this->season?->getTvShowId()}">
    </label> 
    <label> Page d'accueil
        <input type="text" name="seasonNumer" required value="{$this->season?->getSeasonNumber()}">
    </label> 
    <button type="submit">Enregister</button>
</form>
HTML;
    }

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        $name = '';
        if(!empty($_POST['name'])) {
            $name = $this->stripTagsAndTrim($this->escapeString($_POST['name']));
        } else {
            throw new ParameterException();
        }
        $tvShowId = null;
        if (!empty($_POST['tvShowId']) && ctype_digit($_POST['tvShowId'])) {
            $tvShowId = (int) $_POST['tvShowId'];
        }
        $seasonNumer = null;
        if (!empty($_POST['seasonNumer']) && ctype_digit($_POST['seasonNumer'])) {
            $seasonNumer = (int) $_POST['seasonNumer'];
        }
        $id = null;
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = (int) $_POST['id'];
        }

        $this->season = Season::create($name, $tvShowId, $seasonNumer, $id);
    }
}
