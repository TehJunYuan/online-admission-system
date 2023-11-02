<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marital extends Model
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
        'marital_code',
        'status',
    ];
    public function applicantProfile()
    {
        return $this->hasOne(ApplicantProfile::class);
    }
}
