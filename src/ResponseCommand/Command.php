<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

interface Command
{
    public function __toString(): string;
}
