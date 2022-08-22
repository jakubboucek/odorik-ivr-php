<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr\ResponseCommand;

interface Command
{
    public function __toString(): string;
}
