<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class DisplayApplicationProgress extends Model
{
    use HasFactory;

    public $timestamps = false;
    private $reject_reason;
    private $application_record_id;

    public function setReject_reason($reject_reason){
        $this->reject_reason = $reject_reason;
    }

    public function getReject_reason(){
        return $this->reject_reason;
    }

    public function setApplication_record_id($application_record_id){
        $this->application_record_id = $application_record_id;
    }

    public function getApplication_record_id(){
        return $this->application_record_id;
    }
}
