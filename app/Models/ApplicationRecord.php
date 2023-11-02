<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationRecord extends Model
{
    use HasFactory;
    protected $connection = "mysql";

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'applicant_profile_id',
    ];
    public function cmsApplicantDetail()
    {
        return $this->hasOne(CmsApplicantDetail::class);
    }
}
