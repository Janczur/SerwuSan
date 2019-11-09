<?php

namespace Tests\Unit;

use App\Imports\BillingDataImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\BillingFactory;
use Tests\TestCase;

class BillingDataImporterTest extends TestCase
{
    use RefreshDatabase;

    /** @var int last call duration value from storage/app/tests/billing-test.csv file */
    private const LAST_CALL_DURATION_VALUE = 203;

    /** @test */
    public function uploaded_file_content_is_set_to_the_billing(): void
    {
        $file = $this->getTestFile();
        $billing = BillingFactory::create();

        $billingDataImporter = new BillingDataImporter();
        $billingDataImporter->setBillingData($billing, $file);

        $billingData = $billing->getRawData();
        $lastBillingDataElement = end($billingData);

        $this->assertEquals($lastBillingDataElement['billing_id'], $billing->id);
        $this->assertEquals($lastBillingDataElement['call_duration'], self::LAST_CALL_DURATION_VALUE);
    }
}
