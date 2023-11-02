<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianDetail extends Model
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
        'occupation',
        // 'income_id',
        'income',
        'guardian_relationship_id',
        'nationality_id',
        'user_detail_id',
    ];
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function guardianRelationship()
    {
        return $this->belongsTo(GuardianRelationship::class);
    }
    // public function income()
    // {
    //     return $this->belongsTo(Income::class);
    // }
}
