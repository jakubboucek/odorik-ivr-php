<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr\ResponseCommand;

class Answer implements Command
{
    use RenderKeyOnly;

    public function getName(): string
    {
        return 'answer';
    }
}
