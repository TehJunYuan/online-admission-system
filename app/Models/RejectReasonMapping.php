<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectReasonMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reject_reason_id',
        'application_record_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function rejectReason()
    {
        return $this->belongsTo(RejectReason::class);
    }

    
    public function applicationRecord()
    {
        return $this->belongsTo(ApplicationRecord::class);
    }
}
