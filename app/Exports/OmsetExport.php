<?php

namespace App\Exports;

use App\Models\DetailOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OmsetExport implements FromView, ShouldAutoSize
{
    protected $omset;
    protected $month;
    protected $year;
    public function __construct($omset, $month, $year)
    {
        $this->omset = $omset;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('export.omset', [
            'omset' => $this->omset,
            'month' => $this->month,
            'year' => $this->year
        ]);
    }
}
