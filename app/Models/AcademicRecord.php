<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRecord extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    public $timestamps = false;

    protected $fillable = [
        'application_record_id',
        'school_level_id',
        'school_name',
        'school_graduation',
        'status',
    ];

    // In the future, If you want to make the school name become dropdown list. Please seperate the school name become a new table.

    public function schoolLevel()
    {
        return $this->belongsTo(SchoolLevel::class);
    }
}
