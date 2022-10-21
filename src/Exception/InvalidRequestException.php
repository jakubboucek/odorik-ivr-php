<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\Exception;

use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;
use Throwable;

class InvalidRequestException extends RuntimeException
{
    private ServerRequestInterface $serverRequest;

    public function __construct($message, ServerRequestInterface $serverRequest, $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->serverRequest = $serverRequest;
    }

    public function getServerRequest(): ServerRequestInterface
    {
        return $this->serverRequest;
    }
}
