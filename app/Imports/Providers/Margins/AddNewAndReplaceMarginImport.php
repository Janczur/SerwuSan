<?php

namespace App\Imports\Providers\Margins;

use App\ProvidersMargin;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AddNewAndReplaceMarginImport implements ToCollection
{

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $providerMargin = ProvidersMargin::where('country', $row[0])->first();
            if($providerMargin){
                $providerMargin->margin = $row[1];
                $providerMargin->save();
            } else {
                ProvidersMargin::create([
                    'country' => $row[0],
                    'margin' => $row[1]
                ]);
            }
        }
    }
}
