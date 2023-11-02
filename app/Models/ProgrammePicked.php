<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammePicked extends Model
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
        'application_record_id',
        'programme_record_id',
        'choice_priority_id',
        'created_at',
        'updated_at',
    ];

    public function programmeRecord()
    {
        return $this->belongsTo(ProgrammeRecord::class);
    }

}
