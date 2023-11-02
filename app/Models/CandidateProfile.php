<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateProfile extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = "mysql";

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'application_record_id',
        'applicant_profile_id',
        'cms_applicant_detail_id',
        'candidate_profile_status_id',
    ];

}
