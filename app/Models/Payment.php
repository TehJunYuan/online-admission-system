<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    
    protected $fillable = [
        'application_record_id',
        'payment_slip',
        'folderpath'
    ];
}
