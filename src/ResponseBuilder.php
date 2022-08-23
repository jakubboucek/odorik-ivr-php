<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr;

use Jakubboucek\Odorik\Ivr\ResponseCommand\Answer;
use Jakubboucek\Odorik\Ivr\ResponseCommand\Command;
use Jakubboucek\Odorik\Ivr\ResponseCommand\Composed;
use Jakubboucek\Odorik\Ivr\ResponseCommand\HangUp;
use Jakubboucek\Odorik\Ivr\ResponseCommand\Play;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ResponseBuilder
{
    use Composed;

    public static function create(): self
    {
        return new self();
    }

    public function add(Command $command): self
    {
        $this->commands[] = $command;
        return $this;
    }

    public function toHttpResponse(
        ResponseInterface $response,
        StreamFactoryInterface $streamFactory
    ): ResponseInterface {
        return $response
            ->withHeader('Content-Type', 'text/plain;charset=utf8')
            ->withBody($streamFactory->createStream((string)$this));
    }

    public function answer(): self
    {
        $this->add(new Answer());
        return $this;
    }

    public function hangUp(): self
    {
        $this->add(new HangUp());
        return $this;
    }

    public function play(string $uriOrId, bool $interuptible = false)
    {
        $this->add(new Play($uriOrId, $interuptible));
        return $this;
    }


}
