<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status_label'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge bg-danger rounded-pill">Retur</span>';
        }
        return '<span class="badge bg-success rounded-pill">Success</span>';
    }

    public function csReport()
    {
        return $this->belongsTo(CsReport::class);
    }
}
