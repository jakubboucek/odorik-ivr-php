<?php

declare(strict_types=1);

namespace Jakubboucek\OdorikIvr;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class Request
{
    private UriInterface $baseUri;
    private ?string $dtmf;
    private string $from;
    private string $to;
    private int $line;
    private array $params;

    public function __construct(
        UriInterface $baseUri,
        ?string $dtmf,
        string $from,
        string $to,
        int $line,
        array $params
    ) {
        $this->baseUri = $baseUri;
        $this->dtmf = $dtmf;
        $this->from = $from;
        $this->to = $to;
        $this->line = $line;
        $this->params = $params;
    }


    public static function fromHttpRequest(ServerRequestInterface $request): self
    {
        $baseUri = $request->getUri()->withQuery('')->withUserInfo('')->withFragment('');

        $params = $request->getQueryParams();
        $dtmf = $params['dtmf'] ?? null;
        $from = $params['from'];
        $to = $params['to'];
        $line = $params['line'];

        unset(
            $params['dtmf'],
            $params['from'],
            $params['to'],
            $params['line']
        );

        return new self(
            $baseUri,
            $dtmf,
            $from,
            $to,
            $line,
            $params
        );
    }

    public function getUri(): UriInterface
    {
        $params = [
            'dtmf' => $this->dtmf,
            'from' => $this->from,
            'to' => $this->to,
            'line' => $this->line,
        ];

        return $this->baseUri->withQuery(
            http_build_query(
                $params + $this->params
            )
        );
    }

    public function getBaseUri(): UriInterface
    {
        return $this->baseUri;
    }

    public function getDtmf(): ?string
    {
        return $this->dtmf;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function withBaseUri(UriInterface $baseUri): self
    {
        $dolly = clone $this;
        $dolly->baseUri = $baseUri;
        return $dolly;
    }

    public function withDtmf(?string $dtmf): self
    {
        $dolly = clone $this;
        $dolly->dtmf = $dtmf;
        return $dolly;
    }

    public function withFrom(string $from): self
    {
        $dolly = clone $this;
        $dolly->from = $from;
        return $dolly;
    }

    public function withTo(string $to): self
    {
        $dolly = clone $this;
        $dolly->to = $to;
        return $dolly;
    }

    public function withLine(int $line): self
    {
        $dolly = clone $this;
        $dolly->line = $line;
        return $dolly;
    }

    public function withParams(array $params): self
    {
        $dolly = clone $this;
        $dolly->params = $params;
        return $dolly;
    }
}
