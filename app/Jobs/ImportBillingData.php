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
use Illuminate\Support\Facades\Log;

class ImportBillingData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600;

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
            $this->billing->saveBillingData();
            $this->billing->update(['imported' => true]);
            Log::info(__('app.billingData.added'));
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            Log::error(__('app.import.readerError'));
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            Log::error(__('app.import.spreadsheetError'));
        }

        Storage::delete($this->path);
    }
}
