<?php

namespace Tests\Unit;

use App\Billing;
use App\Jobs\ImportBillingData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportBillingDataTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_correctly_performs_file_import_updates_billing_and_logs_process_result_information(): void
    {
        copy(storage_path('app/public/billing-test.csv'), storage_path('app/public/copy-billing-test.csv'));
        $path = [
            'public/copy-billing-test.csv'
        ];
        $billing = factory(Billing::class)->create();

        $importBillingData = new ImportBillingData($billing, $path);
        $importBillingData->handle();

        $this->assertTrue($billing->imported);
    }
}
