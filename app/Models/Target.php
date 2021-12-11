<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['start_date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
