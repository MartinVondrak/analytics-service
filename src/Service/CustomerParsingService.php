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

    private function buildCustomerFromLine(array $line): Customer
    {
        // FIXME check line content
        return new Customer($line[0], $line[1], new \DateTime($line[2]));
    }
}
