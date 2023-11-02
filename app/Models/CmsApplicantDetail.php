<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsApplicantDetail extends Model
{
    use HasFactory;
    protected $connection = "mysql";

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'application_record_id',
        'tempCode',
        'studentCode',
    ];
    
    public function applicationRecord()
    {
        return $this->belongsTo(ApplicationRecord::class);
    }
}
