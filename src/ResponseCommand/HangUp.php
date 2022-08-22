<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr\ResponseCommand;

class HangUp implements Command
{
    use RenderKeyOnly;

    public function getName(): string
    {
        return 'hangup';
    }
}
