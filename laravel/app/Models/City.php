<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
   public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'state_id',
    ];    

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
