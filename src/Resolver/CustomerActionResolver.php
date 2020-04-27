<?php


namespace MartinVondrak\AnalyticsService\Resolver;


use MartinVondrak\AnalyticsService\Entity\Customer;
use MartinVondrak\AnalyticsService\Entity\CustomerAction;
use MartinVondrak\AnalyticsService\Enum\CustomerActionEnum;

class CustomerActionResolver
{
    public function resolve(Customer $customer): CustomerAction
    {
        if ($customer->getCredit() < 200) {
            $action = new CustomerAction($customer->getName(), CustomerActionEnum::SMS_ACTION);
        } elseif ($customer->getLastTopUpDate() < new \DateTime('-5 months')) {
            $action = new CustomerAction($customer->getName(), CustomerActionEnum::SMS_ACTION);
        } elseif ($customer->getCredit() <= 300 && $customer->getLastTopUpDate() > new \DateTime('-2 months')) {
            $action = new CustomerAction($customer->getName(), CustomerActionEnum::SMS_ACTION);
        } else {
            $action = new CustomerAction($customer->getName(), CustomerActionEnum::NONE_ACTION);
        }

        return $action;
    }
}
