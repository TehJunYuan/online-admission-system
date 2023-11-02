<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\OfferLetter;
use Illuminate\Http\Request;
use App\Models\ProgrammePicked;
use App\Models\ApplicantProfile;
use App\Models\CandidateProfile;
use App\Models\CmsApplicantDetail;
use App\Models\DisplayApplicationDetails;

class AAROController extends Controller
{
    //
    public function index()
    {
        $all_candidate_profiles = [];

        $get_all_candidate_profiles = 
            CandidateProfile::latest()->get();

        $get_all_complete_checking_application_by_aaro = 
            CandidateProfile::where('candidate_profile_status_id',config('constants.CANDIDATE_PROFILE_STATUS.APPROVE_BECOME_STUDENT'))
                ->get();

        $count_all_complete_checking_application_by_aaro = 
            count($get_all_complete_checking_application_by_aaro);

        $get_all_application_rejected_by_aaro = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_AARO'))
                ->get();

        $count_all_application_rejected_by_aaro = 
            count($get_all_application_rejected_by_aaro);

        $get_all_todo_for_aaro = 
            CandidateProfile::where('candidate_profile_status_id',config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_APPLICATION'))
                ->get();
        
        $count_all_todo_for_aaro =
            count($get_all_todo_for_aaro);

        $get_all_uploaded_offer_letter_by_aaro = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_OFFER_LETTER'))
                ->get();

        $count_all_uploaded_offer_letter_by_aaro = 
            count($get_all_uploaded_offer_letter_by_aaro);

        for ($i=0; $i < count($get_all_candidate_profiles); $i++) 
        { 
            $display_application_detail = new DisplayApplicationDetails();

            $get_user_detail_id = 
                ApplicantProfile::where('id', $get_all_candidate_profiles[$i]->applicant_profile_id)
                    ->first();
            
            $get_user_detail = 
                UserDetail::where('id', $get_user_detail_id->user_detail_id)
                    ->first();

            $display_application_detail->setEn_name($get_user_detail->en_name);
            $display_application_detail->setIc($get_user_detail->ic);

            $get_temp_code = 
                CmsApplicantDetail::select('tempCode')
                    ->where('application_record_id', $get_all_candidate_profiles[$i]->application_record_id)
                    ->first();

            $get_offer_letter = 
                OfferLetter::where('application_record_id', $get_all_candidate_profiles[$i]->application_record_id)
                    ->get('id');

            // get programme picked
            $getSelectedCourses = ProgrammePicked::where('application_record_id',$get_all_candidate_profiles[$i]->application_record_id)
            ->first();

            $display_application_detail->setApplicant_profile_id($get_all_candidate_profiles[$i]->applicant_profile_id);
            $display_application_detail->setApplication_record_id($get_all_candidate_profiles[$i]->application_record_id);
            $display_application_detail->setTemp_code($get_temp_code);
            $display_application_detail->setOffer_letter($get_offer_letter);
            $display_application_detail->setCandidate_profile_status_id($get_all_candidate_profiles[$i]->candidate_profile_status_id);
            $display_application_detail->setSelected_Programme($getSelectedCourses);

            array_push($all_candidate_profiles, $display_application_detail);
        }

        $count = [
            'count_all_complete_checking_application_by_aaro' => $count_all_complete_checking_application_by_aaro,
            'count_all_application_rejected_by_aaro' => $count_all_application_rejected_by_aaro,
            'count_all_todo_for_aaro' => $count_all_todo_for_aaro,
            'count_all_uploaded_offer_letter_by_aaro' => $count_all_uploaded_offer_letter_by_aaro,
        ];

        return view('oas.admin.aaro.home', compact('all_candidate_profiles', 'count'));
    }

    public function viewList()
    {

        $pending_verify_candidates = [];

        $get_all_complete_payment_candidate_profiles = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_APPLICATION'))
                ->latest()->get();

        for ($i=0; $i < count($get_all_complete_payment_candidate_profiles); $i++) 
        { 
            $display_application_detail = new DisplayApplicationDetails();

            $get_user_detail_id = 
                ApplicantProfile::where('id', $get_all_complete_payment_candidate_profiles[$i]->applicant_profile_id)
                    ->first();
            
            $get_user_detail = 
                UserDetail::where('id', $get_user_detail_id->user_detail_id)
                    ->first();

            $display_application_detail->setEn_name($get_user_detail->en_name);
            $display_application_detail->setIc($get_user_detail->ic);

            $get_temp_code = 
                CmsApplicantDetail::select('tempCode')
                    ->where('application_record_id', $get_all_complete_payment_candidate_profiles[$i]->application_record_id)
                    ->first();

            // get programme picked
            $getSelectedCourses = ProgrammePicked::where('application_record_id',$get_all_complete_payment_candidate_profiles[$i]->application_record_id)
            ->first();

            $display_application_detail->setApplicant_profile_id($get_all_complete_payment_candidate_profiles[$i]->applicant_profile_id);
            $display_application_detail->setApplication_record_id($get_all_complete_payment_candidate_profiles[$i]->application_record_id);
            $display_application_detail->setTemp_code($get_temp_code);
            $display_application_detail->setCandidate_profile_status_id($get_all_complete_payment_candidate_profiles[$i]->candidate_profile_status_id);
            $display_application_detail->setSelected_Programme($getSelectedCourses);

            array_push($pending_verify_candidates, $display_application_detail);
        }

        return view('oas.admin.aaro.list', compact('pending_verify_candidates'));
    }

    public function viewOfferLetter()
    {

        $pending_offer_letter_candidates = [];

        $get_all_complete_payment_candidate_profiles = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.APPROVE_BECOME_STUDENT'))
                ->latest()->get();

        for ($i=0; $i < count($get_all_complete_payment_candidate_profiles); $i++) 
        { 
            $display_application_detail = new DisplayApplicationDetails();

            $get_user_detail_id = 
                ApplicantProfile::where('id', $get_all_complete_payment_candidate_profiles[$i]->applicant_profile_id)
                    ->first();
            
            $get_user_detail = 
                UserDetail::where('id', $get_user_detail_id->user_detail_id)
                    ->first();

            $display_application_detail->setEn_name($get_user_detail->en_name);
            $display_application_detail->setIc($get_user_detail->ic);

            $get_temp_code = 
                CmsApplicantDetail::select('tempCode')
                    ->where('application_record_id', $get_all_complete_payment_candidate_profiles[$i]->application_record_id)
                    ->first();

            // get programme picked
            $getSelectedCourses = ProgrammePicked::where('application_record_id',$get_all_complete_payment_candidate_profiles[$i]->application_record_id)
            ->first();

            $display_application_detail->setApplicant_profile_id($get_all_complete_payment_candidate_profiles[$i]->applicant_profile_id);
            $display_application_detail->setApplication_record_id($get_all_complete_payment_candidate_profiles[$i]->application_record_id);
            $display_application_detail->setTemp_code($get_temp_code);
            $display_application_detail->setCandidate_profile_status_id($get_all_complete_payment_candidate_profiles[$i]->candidate_profile_status_id);
            $display_application_detail->setSelected_Programme($getSelectedCourses);

            array_push($pending_offer_letter_candidates, $display_application_detail);
        }

        return view('oas.admin.aaro.upload_offer_letter', compact('pending_offer_letter_candidates'));
    }
}
