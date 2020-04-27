<?php


namespace MartinVondrak\AnalyticsService\Entity;


class Customer
{
    /** @var string Customer's name */
    private $name;

    /** @var int Customer's credit balance */
    private $credit;

    /** @var \DateTime Date of last credit charging */
    private $lastTopUpDate;

    /**
     * Customer constructor.
     * @param string    $name
     * @param int       $credit
     * @param \DateTime $lastTopUpDate
     */
    public function __construct(string $name, int $credit, \DateTime $lastTopUpDate)
    {
        $this->name = $name;
        $this->credit = $credit;
        $this->lastTopUpDate = $lastTopUpDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @return \DateTime
     */
    public function getLastTopUpDate(): \DateTime
    {
        return $this->lastTopUpDate;
    }
}
