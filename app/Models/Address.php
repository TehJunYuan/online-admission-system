<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $connection = "mysql";

    /**
     * timestamps false
     */
    public $timestamps = false;

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'street1',
        'street2',
        'zipcode',
        'city',
        'state',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
