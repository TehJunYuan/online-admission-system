<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferLetter extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    
    protected $fillable = [
        'application_record_id',
        'offer_letter',
        'folderpath'
    ];
}
