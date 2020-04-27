<?php


namespace MartinVondrak\AnalyticsService\Entity;


class CustomerAction
{
    /** @var string Customer's name */
    private $name;

    /** @var string Resolved action for customer */
    private $action;

    public function __construct(string $name, string $action)
    {
        $this->name = $name;
        $this->action = $action;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
