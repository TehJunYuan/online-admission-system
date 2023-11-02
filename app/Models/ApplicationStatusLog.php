<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatusLog extends Model
{
    use HasFactory;
    protected $connection = "mysql";

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'application_record_id',
        'application_status_id',
    ];

    public function applicationStatus()
    {
        return $this->belongsTo(ApplicationStatus::class);
    }
}
