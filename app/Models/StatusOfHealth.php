<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusOfHealth extends Model
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
        'disease_id',
        'disease_remark',
        'disease_status',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
