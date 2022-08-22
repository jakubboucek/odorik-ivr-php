<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr\ResponseCommand;

trait RenderKeyOnly
{
    abstract public function getName(): string;

    public function __toString(): string
    {
        return $this->getName();
    }

}
