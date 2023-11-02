<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programme extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = "mysql";

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'en_name',
        'programme_level_id',
        'programme_type_id',
        'programme_code',
        'status',
    ];

    public function programmeLevel()
    {
        return $this->belongsTo(ProgrammeLevel::class);
    }

    public function programmeType()
    {
        return $this->belongsTo(ProgrammeType::class);
    }

    public function programmeRecord()
    {
        return $this->hasOne(ProgrammeRecord::class);
    }
}
