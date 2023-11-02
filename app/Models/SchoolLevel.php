<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolLevel extends Model
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
        'status',
    ];

    public function academicRecord(){
        return $this->hasOne(AcademicRecord::class);
    }

    public function schoolLevel(){
        return $this->hasOne(SchoolLevel::class);
    }
}
