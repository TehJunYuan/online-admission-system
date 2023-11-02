<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationRemark extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function applicationRemarkMapping()
    {
        return $this->hasOne(ApplicationRemarkMapping::class);
    }
}
