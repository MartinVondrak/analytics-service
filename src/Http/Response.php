<?php


namespace MartinVondrak\AnalyticsService\Http;


class Response
{
    private const MESSAGES = [
        200 => 'OK',
        401 => 'Unauthorized',
    ];

    /** @var int HTTP response status code */
    private $statusCode;

    /** @var string Response content */
    private $content;

    public function __construct(int $statusCode, string $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getMessage(): string
    {
        if (empty(self::MESSAGES[$this->statusCode])) {
            return 'OK';
        }

        return self::MESSAGES[$this->statusCode];
    }
}
