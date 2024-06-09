<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    /**
     * @var string
     * Donnée au format Html entre <head> et </head>
     */
    private string $head = "";
    /**
     * @var string
     * Titre
     */
    private string $title;
    /**
     * @var string
     * Donnée au format html entre <title></title>
     */
    private string $body = "";

    /**
     * @param String $title Optionnel
     * Constructeur de la classe prend en paramètre le Titre de la page Web
     */

    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * @return string
     * Acesseur sur le titre
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     * Modificateur sur le Titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     * Acesseur sur le head
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     * Acesseur sur le body
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param String $content code au format html
     * @return void
     * Ajoute du contenue a la partie body, ne remplace pas l'ancien
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * @param String $css code au format css
     * @return void
     * Ajoute les balise de style puis ajoute le tout a la partie head
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead("\n<style>\n $css \n </style>");
    }

    /**
     * @param String $content code au format html
     * @return void
     * Ajoute du contenue a la partie head, ne remplace pas l'ancien
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * @param String $url chemin d'accès du script
     * @return void
     * Ajoute un lien vers un doc css
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead("\n<link rel=\"stylesheet\" href='$url'/>");
    }

    /**
     * @param String $js code au format js
     * @return void
     * Ajoute les balise de script puis ajoute le tout a la partie head
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead("\n<script>\n $js</script>\n ");
    }

    /**
     * @param String $url chemin d'accès
     * @return void
     * Ajoute un lien vers un fichier js
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToHead("\n<script src='$url'></script>");
    }

    /**
     * @return string
     * Renvoie le code de la page html selon ce que vous avez remplis
     * dans les variable $body,$head et $title la page est en UTF-8 et en langue francaise
     */
    public function toHtml(): string
    {
        return <<<HTML
        <!doctype html>
        <html lang = "fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title> $this->title </title>
            $this->head
        </head>
        <body>
        <h1>$this->title</h1>
        $this->body
        </body>
        </html>
        HTML;
    }

    /**
     * @return string
     * Renvoie la dernière Modification du script principal
     */
    public static function getLastModification(): string
    {
        return date("j/n/y h:m:s", getlastmod());
    }
}
