<?php

declare(strict_types=1);

namespace Jakubboucek\Odorik\Ivr\ResponseCommand;

use Psr\Http\Message\UriInterface;

class UriCallback implements Command
{
    use RenderKeyValue;

    private UriInterface $uri;
    private array $params;

    public function __construct(
        UriInterface $uri,
        ?int $dtmfCount = null,
        ?int $timeout = null,
        ?string $annoucementId = null,
        ?string $backupNumber = null,
        ?string $errorEmail = null
    ) {
        $this->uri = $uri;

        $this->params = [
            'dtmf_count' => $dtmfCount,
            'timeout' => $timeout,
            'annoucement_id' => $annoucementId,
            'backup_number' => $backupNumber,
            'error_email' => $errorEmail,
        ];
    }

    public function fromParams(
        UriInterface $uri,
        array $params,
        bool $keepRestParams = true
    ): self {
        $dtmfCount = isset($params['dtmfCount']) ? (int)$params['dtmfCount'] : null;
        $timeout = isset($params['timeout']) ? (int)$params['timeout'] : null;
        $annoucementId = isset($params['annoucementId']) ? (string)$params['annoucementId'] : null;
        $backupNumber = isset($params['backupNumber']) ? (string)$params['backupNumber'] : null;
        $errorEmail = isset($params['errorEmail']) ? (string)$params['errorEmail'] : null;

        unset(
            $params['dtmfCount'],
            $params['timeout'],
            $params['annoucementId'],
            $params['backupNumber'],
            $params['errorEmail'],
        );

        if ($keepRestParams && count($params) > 0) {
            // Concatenated as sting, interferred poarams will be removed at `$this->getArgument()`
            $query = trim($uri->getQuery() . '&' . http_build_query($params), '&');
            $uri = $uri->withQuery($query);
        }

        return new self(
            $uri,
            $dtmfCount,
            $timeout,
            $annoucementId,
            $backupNumber,
            $errorEmail,
        );
    }

    public function getName(): string
    {
        return 'uri';
    }

    public function getArgument(): string
    {
        parse_str($this->uri->getQuery(), $query);

        foreach ($this->params as $key => $param) {
            // Remove interfered params
            unset($query[$key]);

            // Append new params (only non-empty)
            if ($param !== null && $param !== '') {
                $query[$key] = $param;
            }
        }

        return (string)$this->uri->withQuery(http_build_query($query));
    }
}
