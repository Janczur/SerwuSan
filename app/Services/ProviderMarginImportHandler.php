<?php


namespace App\Services;

use App\Imports\Providers\Margins\AddNewAndReplaceMarginImport;
use App\Imports\Providers\Margins\AddNewImport;
use App\Imports\Providers\Margins\ReplaceMarginImport;
use App\Imports\Strategies\ProviderMargin;
use Maatwebsite\Excel\Facades\Excel;

class ProviderMarginImportHandler
{

    /** @var array */
    private $formRequest;

    /**
     * HandleProviderMarginUpdate constructor.
     * @param array $formRequest
     */
    public function __construct(array $formRequest)
    {
        $this->formRequest = $formRequest;
    }

    public function importProviderMargin(): void
    {
        if ($this->formRequest['importStrategy'] === ProviderMargin::ADD_NEW){
            Excel::import(new AddNewImport(), $this->formRequest['import_file']);
        }

        if ($this->formRequest['importStrategy'] === ProviderMargin::REPLACE_MARGIN){
            Excel::import(new ReplaceMarginImport(), $this->formRequest['import_file']);
        }

        if ($this->formRequest['importStrategy'] === ProviderMargin::ADD_NEW_AND_REPLACE_MARGIN){
            Excel::import(new AddNewAndReplaceMarginImport(), $this->formRequest['import_file']);
        }
    }


}
