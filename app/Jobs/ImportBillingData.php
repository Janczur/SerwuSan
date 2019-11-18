<?php

namespace App\Jobs;

use App\Billing;
use App\Imports\BillingDataImporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImportBillingData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Billing */
    private $billing;

    /** @var string */
    private $path;

    /**
     * Create a new job instance.
     *
     * @param Billing $billing
     * @param string $path
     */
    public function __construct(Billing $billing, string $path)
    {
        $this->billing = $billing;
        $this->path = $path;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $file = new UploadedFile(storage_path("app/$this->path"), 'billing.csv');
        $billingDataImporter = new BillingDataImporter();

        try {
            $billingDataImporter->setBillingData($this->billing, $file);
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            logger(__('app.import.readerError'));
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            logger(__('app.import.spreadsheetError'));
        }

        $this->billing->saveBillingData();
        $this->billing->update(['imported' => true]);
        logger(__('app.billingData.added'));

        Storage::delete($this->path);
    }
}
