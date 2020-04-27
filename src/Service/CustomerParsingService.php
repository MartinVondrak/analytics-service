<?php


namespace MartinVondrak\AnalyticsService\Service;


use MartinVondrak\AnalyticsService\Entity\Customer;

class CustomerParsingService
{
    /**
     * @param string $file
     * @return array|Customer[]
     */
    public function parse(string $file): array
    {
        $customers = [];

        if (false === ($resource = fopen($file, 'r'))) {
            return $customers;
        }

        while (false !== ($line = fgetcsv($resource))) {
            $customers[] = $this->buildCustomerFromLine($line);
        }

        fclose($resource);

        return $customers;
    }

    /**
     * @param string[]|int[] $line
     * @return Customer
     */
    private function buildCustomerFromLine(array $line): Customer
    {
        // FIXME check line content
        return new Customer((string)$line[0], (int)$line[1], new \DateTime((string)$line[2]));
    }
}
