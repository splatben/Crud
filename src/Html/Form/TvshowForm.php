<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Tvshow;
use Html\StringEscaper;

class TvshowForm
{
    private ?Tvshow $show;

    use StringEscaper;
    /**
     * @param Tvshow|null $show
     */
    public function __construct(?Tvshow $show = null)
    {
        $this->show = $show;
    }

    public  function getShow(): ?Tvshow
    {
        return $this->show;
    }

    public function getHtmlForm(string $action): string
    {
        return <<<HTML
<form method="post" action="$action">
    <input name="id" type="hidden" value="{$this->show?->getId()}">
    <label> Nom
        <input type="text" name="name" required value="{$this->escapeString($this->show?->getName())}">
    </label>
    <label> Nom de base
        <input type="text" name="originalName" required value="{$this->escapeString($this->show?->getOriginalName())}">
    </label> 
    <label> Page d'accueil
        <input type="text" name="homepage" required value="{$this->escapeString($this->show?->getHomepage())}">
    </label> 
    <label> Description
        <input type="text" name="overview" required value="{$this->escapeString($this->show?->getOverview())}">
    </label>
    <button type="submit">Enregister</button>
</form>
HTML;

    }



}
