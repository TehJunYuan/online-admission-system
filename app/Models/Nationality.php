<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = "mysql";
    
    /**
     * timestamps false
     */
    public $timestamps = false;

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'nationality_code',
        'status',
    ];
    public function applicantProfile()
    {
        return $this->hasOne(ApplicantProfile::class);
    }
    public function guardianDetail()
    {
        return $this->hasOne(GuardianDetail::class);
    }
}
