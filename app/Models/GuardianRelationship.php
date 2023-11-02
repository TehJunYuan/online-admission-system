<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuardianRelationship extends Model
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
        'relationship_code',
        'status',
    ];
    public function guardianDetail()
    {
        return $this->hasOne(GuardianDetail::class);
    }
    public function emergencyContact()
    {
        return $this->hasOne(emergencyContact::class);
    }
}
