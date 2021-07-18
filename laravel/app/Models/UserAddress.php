<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'state_id',
        'city_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
