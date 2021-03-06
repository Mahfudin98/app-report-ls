<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['type_pembelian_label', 'type_product_label'];
    public function orderDetail()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getTypePembelianLabelAttribute()
    {
        if ($this->type_pembelian == 0) {
            return '<span class="badge bg-primary rounded-pill">Ecer</span>';
        } elseif ($this->type_pembelian == 1) {
            return '<span class="badge bg-primary rounded-pill">Paket Komplit</span>';
        }
        return '<span class="badge bg-primary rounded-pill">Paket Hemat</span>';
    }

    public function getTypeProductLabelAttribute()
    {
        if ($this->type_product == 0) {
            return '<span class="badge bg-primary rounded-pill">BPOM</span>';
        }
        return '<span class="badge bg-primary rounded-pill">FARMA</span>';
    }

}
