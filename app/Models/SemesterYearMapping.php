<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemesterYearMapping extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = "mysql";

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'semester_id',
        'year',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function programmeRecord()
    {
        return $this->hasOne(ProgrammeRecord::class);
    }
}
