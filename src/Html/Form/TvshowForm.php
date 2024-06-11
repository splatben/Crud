<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Tvshow;
use Exception\ParameterException;
use Html\StringEscaper;

class TvshowForm
{
    use StringEscaper;
    private ?Tvshow $show;
    /**
     * @param Tvshow|null $show
     */
    public function __construct(?Tvshow $show = null)
    {
        $this->show = $show;
    }

    public function getShow(): ?Tvshow
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

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        $name = '';
        if(empty($_POST['name'])) {
            $name = $this->stripTagsAndTrim($this->escapeString($_POST['name']));
        } else {
            throw new ParameterException();
        }

        $ogName = '';
        if(empty($_POST['originalName'])) {
            $ogName = $this->stripTagsAndTrim($this->escapeString($_POST['originalName']));
        } else {
            throw new ParameterException();
        }

        $homepage = '';
        if(empty($_POST['homepage'])) {
            $homepage = $this->stripTagsAndTrim($this->escapeString($_POST['homepage']));
        } else {
            throw new ParameterException();
        }

        $overview = '';
        if(empty($_POST['overview'])) {
            $overview = $this->stripTagsAndTrim($this->escapeString($_POST['overview']));
        } else {
            throw new ParameterException();
        }

        $id = null;
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = (int) $_POST['id'];
        }

        $this->show = Tvshow::create($name, $ogName, $homepage, $overview, $id);
    }



}
