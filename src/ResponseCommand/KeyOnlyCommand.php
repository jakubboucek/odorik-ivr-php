<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr\ResponseCommand;

abstract class KeyOnlyCommand implements Command
{
    use RenderKeyOnly;

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
