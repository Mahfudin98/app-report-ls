<?php

namespace App\Exports;

use App\Models\Target;
use Maatwebsite\Excel\Concerns\FromCollection;

class TargetExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Target::all();
    }
}
