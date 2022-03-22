<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductExport implements FromView, ShouldAutoSize
{
    protected $order;
    protected $month;
    protected $year;
    public function __construct($order, $month, $year)
    {
        $this->order = $order;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('export.produk', [
            'order' => $this->order,
            'month' => $this->month,
            'year' => $this->year
        ]);
    }
}