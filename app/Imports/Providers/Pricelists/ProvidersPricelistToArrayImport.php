<?php

namespace App\Imports\Providers\Pricelists;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProvidersPricelistToArrayImport implements ToArray, WithStartRow, WithHeadingRow
{

    public function array(array $rows): array
    {
        return $rows;
    }

    public function startRow(): int
    {
        return 2;
    }
}
