<?php


namespace MartinVondrak\AnalyticsService\Http;


class Request
{

    private const UPLOAD_FIELD = 'data';

    /** @var string HTTP method used */
    private $method;

    /** @var string Username for HTTP basic */
    private $username;

    /** @var string Password for HTTP basic */
    private $password;

    /** @var array|string[]|int[] Array with file information from $_FILES */
    private $file;

    public static function initFromGlobals(): Request
    {
        return new Request(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['PHP_AUTH_USER'] ?? '',
            $_SERVER['PHP_AUTH_PW'] ?? '',
            $_FILES[self::UPLOAD_FIELD] ?? []
        );
    }

    /**
     * Request constructor.
     * @param string               $method
     * @param string               $username
     * @param string               $password
     * @param array|string[]|int[] $file
     */
    public function __construct(string $method, string $username, string $password, array $file)
    {
        $this->method = $method;
        $this->username = $username;
        $this->password = $password;
        $this->file = $file;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array|int[]|string[]
     */
    public function getFile(): array
    {
        return $this->file;
    }

    public function getFilePath(): string
    {
        return (string)$this->file['tmp_name'];
    }
}
