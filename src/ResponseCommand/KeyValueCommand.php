<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr\ResponseCommand;

abstract class KeyValueCommand implements Command
{
    use RenderKeyValue;

    private string $name;
    private string $argument;


    public function __construct(string $name, string $argument)
    {
        $this->name = $name;
        $this->argument = $argument;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArgument(): string
    {
        return $this->argument;
    }
}
