<?php


namespace MartinVondrak\AnalyticsService\Entity;


class StatisticRecord
{
    /** @var string Resolved action for customer */
    private $action;

    /** @var int Counter for action usage */
    private $count;

    /**
     * StatisticRecord constructor.
     * @param string $action
     * @param int    $count
     */
    public function __construct(string $action, int $count = 0)
    {
        $this->action = $action;
        $this->count = $count;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function incrementCount(): self
    {
        $this->count++;
        return $this;
    }
}
