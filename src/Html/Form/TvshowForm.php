<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Tvshow;

class TvshowForm
{
    private ?Tvshow $show;

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



}
