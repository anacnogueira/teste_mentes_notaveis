<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Get the address for the user.
     */
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}
