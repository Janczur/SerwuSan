<?php


namespace App\Imports\Filters;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class BillingDataReadFilter implements IReadFilter
{

    private $columns = [];

    /**
     * BillingDataReadFilter constructor.
     * @param $columns
     */
    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    /**
     * Should this cell be read?
     *
     * @param string $column Column address (as a string value like "A", or "IV")
     * @param int $row Row number
     * @param string $worksheetName Optional worksheet name
     *
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = ''): bool
    {
        return in_array($column, $this->columns, true);
    }
}
