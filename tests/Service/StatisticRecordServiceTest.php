<?php

namespace Service;

use MartinVondrak\AnalyticsService\Entity\StatisticRecord;
use MartinVondrak\AnalyticsService\Service\StatisticRecordService;
use PHPUnit\Framework\TestCase;

class StatisticRecordServiceTest extends TestCase
{
    /** @var StatisticRecordService */
    private $statisticRecordService;

    public function setUp(): void
    {
        parent::setUp();
        $this->statisticRecordService = new StatisticRecordService();
    }

    public function testIncrementRecord(): void
    {
        $this->statisticRecordService->incrementRecord('TEST');
        $records = $this->statisticRecordService->getAllRecords();
        $this->assertContainsOnlyInstancesOf(StatisticRecord::class, $records);
        $this->assertCount(1, $records);
        $record = reset($records);
        $this->assertEquals('TEST', $record->getAction());
        $this->assertEquals(1, $record->getCount());

        $this->statisticRecordService->incrementRecord('TEST');
        $records = $this->statisticRecordService->getAllRecords();
        $this->assertContainsOnlyInstancesOf(StatisticRecord::class, $records);
        $this->assertCount(1, $records);
        $record = reset($records);
        $this->assertEquals('TEST', $record->getAction());
        $this->assertEquals(2, $record->getCount());

        $this->statisticRecordService->incrementRecord('TEST 2');
        $records = $this->statisticRecordService->getAllRecords();
        $this->assertContainsOnlyInstancesOf(StatisticRecord::class, $records);
        $this->assertCount(2, $records);
    }
}
