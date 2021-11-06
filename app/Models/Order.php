<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status_label'];

    public function csReport()
    {
        return $this->belongsTo(CsReport::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge badge-pill badge-secondary">Retur</span>';
        }
        return '<span class="badge badge-pill badge-brand">Success</span>';
    }

    public function returnOrder()
    {
        return $this->hasMany(ReturnOrder::class);
    }
}
