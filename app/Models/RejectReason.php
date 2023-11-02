<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectReason extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function rejectReasonMapping()
    {
        return $this->hasOne(RejectReasonMapping::class);
    }

}
