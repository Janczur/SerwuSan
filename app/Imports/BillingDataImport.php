<?php

namespace App\Imports;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Imports\Filters\BillingDataReadFilter;
use Carbon\Carbon;

class BillingDataImport
{
    /**
     * @param int $billing_id
     * @param UploadedFile $file
     * @return array $preparedBillingData
     */
    public function getBillingDataToImport($billing_id, $file): array
    {
        $filter = $this->getReadFilter();
        $reader = $this->setupReaderWithFilter($filter);
        $loadedBillingData = $this->loadBillingDataToArray($reader, $file);
        $preparedBillingData = $this->prepareBillingData($billing_id, $loadedBillingData);
        return $preparedBillingData;
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
     * @return Csv $reader
     */
    private function setupReaderWithFilter($filter): Csv
    {
        $reader = new Csv();
        $reader->setReadDataOnly(true)
            ->setReadFilter($filter)
            ->setDelimiter("\t");

        return $reader;
    }

    /**
     * @param Csv $reader
     * @param UploadedFile $file
     * @return array $billingData
     */
    private function loadBillingDataToArray($reader, $file): array
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
    private function prepareBillingData($billing_id, $billingData): array
    {
        $preparedBilling = [];
        unset($billingData[0]); // drop headings
        foreach($billingData as $row){
            $preparedBilling[] = [
                'billing_id' => $billing_id,
                'call_start_date' => Carbon::createFromFormat('Y-m-d H:i:s', $row[0]),
                'call_duration' => $row[6]
            ];
        }
        return $preparedBilling;
    }
}
