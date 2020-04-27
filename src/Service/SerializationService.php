<?php


namespace MartinVondrak\AnalyticsService\Service;


use MartinVondrak\AnalyticsService\Entity\CustomerAction;
use MartinVondrak\AnalyticsService\Entity\StatisticRecord;

class SerializationService
{
    /**
     * @param CustomerAction[]  $customerActions
     * @param StatisticRecord[] $statisticRecords
     * @return string
     */
    public function serialize(array $customerActions, array $statisticRecords): string
    {
        $actions = [];
        $stats = [];

        foreach ($customerActions as $customerAction) {
            $actions[] = $this->customerActionToArray($customerAction);
        }

        foreach ($statisticRecords as $statisticRecord) {
            $stats[] = $this->statisticRecordToArray($statisticRecord);
        }

        $data = [
            'actions' => $actions,
            'stats' => $stats,
        ];

        return json_encode($data);
    }

    /**
     * @param CustomerAction $customerAction
     * @return string[]
     */
    public function customerActionToArray(CustomerAction $customerAction): array
    {
        return ['name' => $customerAction->getName(), 'action' => $customerAction->getAction(),];
    }

    /**
     * @param StatisticRecord $statisticRecord
     * @return string[]|int[]
     */
    public function statisticRecordToArray(StatisticRecord $statisticRecord): array
    {
        return ['action' => $statisticRecord->getAction(), 'count' => $statisticRecord->getCount(),];
    }
}
