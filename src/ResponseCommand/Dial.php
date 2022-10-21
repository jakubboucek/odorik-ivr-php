<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

class Dial implements Command
{
    use RenderKeyValue;

    private string $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getName(): string
    {
        return 'dial';
    }

    public function getArgument(): string
    {
        return $this->number;
    }
}
