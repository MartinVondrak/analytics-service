<?php


namespace MartinVondrak\AnalyticsService\Service;


use MartinVondrak\AnalyticsService\Entity\StatisticRecord;

class StatisticRecordService
{
    /** @var StatisticRecord[] Array of record for all actions */
    private $statisticRecords;

    public function __construct()
    {
        $this->statisticRecords = [];
    }

    public function incrementRecord(string $action): void
    {
        if (!isset($this->statisticRecords[$action])) {
            $this->statisticRecords[$action] = new StatisticRecord($action, 1);
        } else {
            $this->statisticRecords[$action]->incrementCount();
        }
    }

    /**
     * @return StatisticRecord[]
     */
    public function getAllRecords(): array
    {
        return $this->statisticRecords;
    }
}
