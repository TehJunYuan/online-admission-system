<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationRemarkMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_remark_id',
        'application_record_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function applicationRemark()
    {
        return $this->belongsTo(ApplicationRemark::class);
    }

    
    public function applicationRecord()
    {
        return $this->belongsTo(ApplicationRecord::class);
    }
}
