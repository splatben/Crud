<?php

namespace Html;

use Html\WebPage;

class AppWebPage extends WebPage
{
    private string $menu = "";

    public function appendButtonToMenu(string $url, string $nom): void
    {
        $this->menu .= "<button onclick=\"window.location.href = '$url';\">$nom</button>\n";
    }

    public function __construct(string $title = "")
    {
        parent::__construct($title);
        parent::appendCssUrl("css/style1.css");
    }
}
