<?php


namespace MartinVondrak\AnalyticsService\Service;


use MartinVondrak\AnalyticsService\Http\Request;
use MartinVondrak\AnalyticsService\Http\UnauthorizedException;

class AuthenticatorService
{
    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /**
     * AuthenticatorService constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticateRequest(Request $request): void
    {
        if ($request->getUsername() !== $this->username || $request->getPassword() !== $this->password) {
            throw new UnauthorizedException('Invalid username or password', 401);
        }
    }
}
