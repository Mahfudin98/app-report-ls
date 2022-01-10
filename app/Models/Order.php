<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status_label'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
            return '<span class="badge bg-danger rounded-pill">Retur</span>';
        }
        return '<span class="badge bg-success rounded-pill">Success</span>';
    }

    public function returnOrder()
    {
        return $this->hasMany(ReturnOrder::class);
    }

    public function setCustomerPhoneAttribute($value)
    {
        $this->attributes['customer_phone'] = preg_replace("/^0/", "62", $value);
    }
}
