<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
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
        'birth_date',
        'place_of_birth',
        'gender_id',
        'marital_id',
        'race_id',
        'nationality_id',
        'religion_id',
        'user_detail_id',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function marital()
    {
        return $this->belongsTo(Marital::class);
    }
    public function race()
    {
        return $this->belongsTo(Race::class);
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
    
}
