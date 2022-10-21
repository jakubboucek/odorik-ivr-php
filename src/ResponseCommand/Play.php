<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

use Psr\Http\Message\UriInterface;

class Play extends KeyValueCommand
{
    public function __construct(string $uriOrId, bool $interuptible = false)
    {
        parent::__construct($interuptible ? 'play2' : 'play', $uriOrId);
    }

    public static function fromId(int $id, bool $interuptible = false): self
    {
        return new self((string)$id, $interuptible);
    }

    public static function fromUri(UriInterface $uri, bool $interuptible = false): self
    {
        return new self((string)$uri, $interuptible);
    }
}
