<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgrammeRecord extends Model
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
        'semester_year_mapping_id',
        'programme_id',
    ];
    
    public function semesterYearMapping()
    {
        return $this->belongsTo(SemesterYearMapping::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function programmePicked()
    {
        return $this->hasOne(ProgrammePicked::class);
    }
}
