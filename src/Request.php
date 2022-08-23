<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class Request
{
    private UriInterface $baseUri;
    private ?string $dtmf;
    private string $from;
    private string $to;
    private int $line;
    private string $callId;
    private array $params;

    public function __construct(
        UriInterface $baseUri,
        ?string $dtmf,
        string $from,
        string $to,
        int $line,
        string $callId,
        array $params
    ) {
        $this->baseUri = $baseUri;
        $this->dtmf = $dtmf;
        $this->from = $from;
        $this->to = $to;
        $this->line = $line;
        $this->callId = $callId;
        $this->params = $params;
    }


    public static function fromHttpRequest(ServerRequestInterface $request): self
    {
        $baseUri = $request->getUri()->withQuery('')->withUserInfo('')->withFragment('');

        $params = $request->getQueryParams();
        $dtmf = isset($params['dtmf']) ? (string)$params['dtmf'] : null;
        $from = (string)$params['from'];
        $to = (string)$params['to'];
        $line = (int)$params['line'];
        $callId = (string)$params['sip_in_callid'];

        unset(
            $params['dtmf'],
            $params['from'],
            $params['to'],
            $params['line'],
            $params['sip_in_callid']
        );

        return new self(
            $baseUri,
            $dtmf,
            $from,
            $to,
            $line,
            $callId,
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
            'sip_in_callid' => $this->callId,
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

    public function getCallId(): string
    {
        return $this->callId;
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

    public function withCallId(string $callId): self
    {
        $dolly = clone $this;
        $dolly->callId = $callId;
        return $dolly;
    }

    public function withParams(array $params): self
    {
        $dolly = clone $this;
        $dolly->params = $params;
        return $dolly;
    }
}
