<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportWeb extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function page()
    {
        return $this->hasMany(ReportPage::class);
    }
}
