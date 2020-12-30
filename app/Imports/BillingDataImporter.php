<?php

namespace App\Imports;

use App\Billing;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Imports\Filters\BillingDataReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class BillingDataImporter
{
    /**
     * @param Billing $billing
     * @param UploadedFile $file
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function setBillingData(Billing $billing, UploadedFile $file): void
    {
        $billingData = $this->getBillingDataToImport($billing, $file);
        $billing->setRawData($billingData);
    }

    /**
     * @param Billing $billing
     * @param UploadedFile $file
     * @return array $preparedBillingData
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function getBillingDataToImport($billing, $file): array
    {
        $filter = $this->getReadFilter();
        $reader = $this->setupReaderWithFilter($filter, 'Csv');
        $loadedBillingData = $this->loadBillingDataToArray($reader, $file);
        return $this->prepareBillingData($billing->id, $loadedBillingData);
    }

    /**
     * @return BillingDataReadFilter $readFilter
     */
    private function getReadFilter(): BillingDataReadFilter
    {
        $columnsToRead = ['A', 'G'];
        return new BillingDataReadFilter($columnsToRead);
    }

    /**
     * @param BillingDataReadFilter $filter
     * @param string $fileType
     * @return IReader
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    private function setupReaderWithFilter(BillingDataReadFilter $filter, string $fileType): IReader
    {
        $reader = IOFactory::createReader($fileType);
        $reader->setReadDataOnly(true)
            ->setReadFilter($filter)
            ->setDelimiter("\t");

        return $reader;
    }

    /**
     * @param IReader $reader
     * @param UploadedFile $file
     * @return array $billingData
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function loadBillingDataToArray(IReader $reader, UploadedFile $file): array
    {
        $spreadsheet = $reader->load($file->getPathname());
        return $spreadsheet->getActiveSheet()->toArray();
    }

    /**
     * returns array of data ready to insert into DB
     *
     * @param int $billing_id
     * @param array $billingData
     * @return array $preparedBilling
     */
    private function prepareBillingData(int $billing_id, array $billingData): array
    {
        $preparedBilling = [];
        unset($billingData[0]); // drop headings
        foreach($billingData as $row){
            $preparedBilling[] = [
                'billing_id' => $billing_id,
                'call_start_date' => $row[0],
                'call_duration' => $row[6]
            ];
        }
        return $preparedBilling;
    }
}
