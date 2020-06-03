<?php

namespace App\Imports\Providers\Margins;

use App\ProvidersMargin;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;

class AddNewImport implements ToModel, SkipsOnError
{
    use SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ProvidersMargin([
            'country' => $row[0],
            'margin' => $row[1]
        ]);
    }
}
