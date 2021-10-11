<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoriUsed extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['kondisi_label'];
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
    public function getKondisiLabelAttribute()
    {
        if ($this->kondisi == 0) {
            return '<span class="badge badge-pill badge-danger">Buruk</span>';
        }
        return '<span class="badge badge-pill badge-success">Baik</span>';
    }
}
