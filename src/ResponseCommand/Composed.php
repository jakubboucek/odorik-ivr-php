<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

trait Composed
{
    protected array $commands = [];

    public function __toString(): string
    {
        return implode(
            "\n",
            array_map(static function (Command $command) {
                return (string)$command;
            }, $this->commands)
        );
    }
}
