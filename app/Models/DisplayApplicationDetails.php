<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class DisplayApplicationDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    private $en_name;
    private $ic;
    private $applicant_profile_id;
    private $application_record_id;
    private $payment_slip;
    private $offer_letter;
    private $temp_code;
    private $selected_programme;
    private $candidate_profile_status_id;

    public function setEn_name($en_name){
        $this->en_name = $en_name;
    }

    public function getEn_name(){
        return $this->en_name;
    }

    public function setIc($ic){
        $this->ic = $ic;
    }

    public function getIc(){
        return $this->ic;
    }

    public function setApplicant_profile_id($applicant_profile_id){
        $this->applicant_profile_id = $applicant_profile_id;
    }

    public function getApplicant_profile_id(){
        return $this->applicant_profile_id;
    }

    public function setApplication_record_id($application_record_id){
        $this->application_record_id = $application_record_id;

    }

    public function getApplication_record_id(){
        return $this->application_record_id;
    }

    public function setPayment_slip($payment_slip){
        $this->payment_slip = $payment_slip;
    }

    public function getPayment_slip(){
        return $this->payment_slip;
    }

    public function setOffer_letter($offer_letter){
        $this->offer_letter = $offer_letter;
    }

    public function getOffer_letter(){
        return $this->offer_letter;
    }
    
    public function setTemp_code($temp_code){
        $this->temp_code = $temp_code;
    }

    public function getTemp_code(){
        return $this->temp_code;
    }

    public function setCandidate_profile_status_id($candidate_profile_status_id){
        $this->candidate_profile_status_id = $candidate_profile_status_id;
    }

    public function getCandidate_profile_status_id(){
        return $this->candidate_profile_status_id;
    }

    public function setSelected_Programme($selected_programme){
        $this->selected_programme = $selected_programme;
    }

    public function getSelected_Programme(){
        return $this->selected_programme;
    }

}
