<?php

namespace App\Jobs;

use App\ProvidersPricelist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProvidersPricelistData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;
    public $timeout = 300;

    /** @var ProvidersPricelist */
    private $providersPricelist;

    /** @var array */
    private $providersPricelistSheets;

    /** @var array */
    private $dataToImport;

    /**
     * Create a new job instance.
     *
     * @param ProvidersPricelist $providersPricelist
     * @param array $providersPricelistSheets
     */
    public function __construct(ProvidersPricelist $providersPricelist, array $providersPricelistSheets)
    {
        $this->providersPricelist = $providersPricelist;
        $this->providersPricelistSheets = $providersPricelistSheets;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->removeDuplicatesByMaxValueOfT1();
        $this->saveProvidersPricelist();
    }

    /**
     * Modifies imported data so that providers with the highest T1 column value are unique
     */
    private function removeDuplicatesByMaxValueOfT1(): void
    {
        $maxValuesWithoutDuplicates = [];
        foreach ($this->providersPricelistSheets as $providersPricelistSheet) {
            foreach ($providersPricelistSheet as $row) {

                if (!array_key_exists($row['country'], $maxValuesWithoutDuplicates)) {
                    $maxValuesWithoutDuplicates[$row['country']] = $row;
                } else if ($row['t1'] > $maxValuesWithoutDuplicates[$row['country']]['t1']) {
                    $maxValuesWithoutDuplicates[$row['country']] = $row;
                }

            }
        }
        $this->setDataToImport($maxValuesWithoutDuplicates);
    }

    private function saveProvidersPricelist()
    {
        $this->providersPricelist->providersPricelistData()->createMany($this->getDataToImport());
    }

    /**
     * @return array
     */
    public function getDataToImport(): array
    {
        return $this->dataToImport;
    }

    /**
     * @param array $dataToImport
     */
    public function setDataToImport(array $dataToImport): void
    {
        $this->dataToImport = $dataToImport;
    }
}
