<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param ?string $text chaîne à protéger
     * @return string chaîne protégée
     */
    public function escapeString(?string $text): string
    {
        $strProtegee = "";
        if ($text !== null) {
            $strProtegee = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_XHTML);
        }
        return $strProtegee;
    }

    /**
     * Enlever les espaces en tête et en queue de chaîne ainsi que les balises éventuelles
     *
     * @param ?string $text chaîne à protéger
     * @return string chaîne protégée
     */
    public function stripTagsAndTrim(?string $text): string
    {
        $strProtegee = "";
        if ($text !== null) {
            $strProtegee = trim(strip_tags($text), " ");
        }
        return $strProtegee;

    }

}
