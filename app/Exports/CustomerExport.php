<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomerExport implements FromView, ShouldAutoSize
{
    protected $customer;
    protected $date;
    public function __construct($customer, $date)
    {
        $this->customer = $customer;
        $this->date = $date;
    }

    public function view(): View
    {
        return view('export.datacustomer', [
            'customer' => $this->customer,
            'date' => $this->date
        ]);
    }
}
