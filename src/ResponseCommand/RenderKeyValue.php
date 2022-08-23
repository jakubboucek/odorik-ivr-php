<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

trait RenderKeyValue
{
    abstract public function getName(): string;

    abstract public function getArgument(): string;

    public function __toString(): string
    {
        return sprintf('%s:%s', $this->getName(), $this->getArgument());
    }

}
