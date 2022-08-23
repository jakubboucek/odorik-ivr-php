<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

class HangUp implements Command
{
    use RenderKeyOnly;

    public function getName(): string
    {
        return 'hangup';
    }
}
