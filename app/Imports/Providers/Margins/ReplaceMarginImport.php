<?php

namespace App\Imports\Providers\Margins;

use App\ProvidersMargin;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ReplaceMarginImport implements ToCollection
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $providerMargin = ProvidersMargin::where('country', $row[0])->first();
            if($providerMargin){
                $providerMargin->margin = $row[1];
                $providerMargin->save();
            }
        }
    }
}
