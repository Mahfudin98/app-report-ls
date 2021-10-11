<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // parent id
    public function parent()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace("/^0/", "62", $value);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeTeam($query)
    {
        return $query->where('role', 2);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function child()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    // report
    public function csReport()
    {
        return $this->hasMany(CsReport::class);
    }

    public function advReport()
    {
        return $this->hasMany(AdvReport::class);
    }

    public function reportCsAdv(){
        return $this->hasMany(CsReport::class, 'parent_id');
    }
}
