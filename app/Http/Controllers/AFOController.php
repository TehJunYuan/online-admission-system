<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\ProgrammePicked;
use App\Models\ApplicantProfile;
use App\Models\CandidateProfile;
use App\Models\ApplicationRecord;
use App\Models\CmsApplicantDetail;
use App\Models\ApplicationStatusLog;
use App\Models\DisplayApplicationDetails;
use DB;

class AFOController extends Controller
{
    //
    public function index()
    {
        $all_candidate_profiles = [];

        $get_all_candidate_profiles = 
            CandidateProfile::latest()->get();

        $get_all_complete_checking_payment_slip_by_afo = 
            CandidateProfile::where('candidate_profile_status_id', '>=', config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_PAYMENT_SLIP'))
                ->where('candidate_profile_status_id', '!=', config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO'))
                ->get();

        $count_all_complete_checking_payment_slip_by_afo = 
            count($get_all_complete_checking_payment_slip_by_afo);

        $get_all_payment_slip_rejected_by_afo = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO'))
                ->get();

        $count_all_payment_slip_rejected_by_afo = 
            count($get_all_payment_slip_rejected_by_afo);

        $get_all_todo_for_afo = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_SUBMIT_PAYMENT'))
            ->get();
        
        $count_all_todo_for_afo =
            count($get_all_todo_for_afo);

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

            // get programme picked
            $getSelectedCourses = ProgrammePicked::where('application_record_id',$get_all_candidate_profiles[$i]->application_record_id)
            ->first();

            $get_payment_slip = 
                Payment::where('application_record_id', $get_all_candidate_profiles[$i]->application_record_id)
                    ->get('id');

            $display_application_detail->setApplicant_profile_id($get_all_candidate_profiles[$i]->applicant_profile_id);
            $display_application_detail->setApplication_record_id($get_all_candidate_profiles[$i]->application_record_id);
            $display_application_detail->setTemp_code($get_temp_code);
            $display_application_detail->setPayment_slip($get_payment_slip);
            $display_application_detail->setCandidate_profile_status_id($get_all_candidate_profiles[$i]->candidate_profile_status_id);
            $display_application_detail->setSelected_Programme($getSelectedCourses);
    
            array_push($all_candidate_profiles, $display_application_detail);
        }
        $count = [
            'count_all_complete_checking_payment_slip_by_afo' => $count_all_complete_checking_payment_slip_by_afo,
            'count_all_payment_slip_rejected_by_afo' => $count_all_payment_slip_rejected_by_afo,
            'count_all_todo_for_afo' => $count_all_todo_for_afo,
        ];
        return view('oas.admin.afo.home', compact('all_candidate_profiles','count'));
    }

    public function viewPendingVerifyPaymentList()
    {

        $pending_verify_candidates = [];

        $get_all_complete_payment_candidate_profiles = 
            CandidateProfile::where('candidate_profile_status_id', config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_SUBMIT_PAYMENT'))
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
            
            $get_payment_slip = 
                Payment::where('application_record_id', $get_all_complete_payment_candidate_profiles[$i]->application_record_id)
                    ->get('id');

            // get programme picked
            $getSelectedCourses = ProgrammePicked::where('application_record_id',$get_all_complete_payment_candidate_profiles[$i]->application_record_id)
            ->first();

            $display_application_detail->setApplicant_profile_id($get_all_complete_payment_candidate_profiles[$i]->applicant_profile_id);
            $display_application_detail->setApplication_record_id($get_all_complete_payment_candidate_profiles[$i]->application_record_id);
            $display_application_detail->setTemp_code($get_temp_code);
            $display_application_detail->setPayment_slip($get_payment_slip);
            $display_application_detail->setCandidate_profile_status_id($get_all_complete_payment_candidate_profiles[$i]->candidate_profile_status_id);
            $display_application_detail->setSelected_Programme($getSelectedCourses);

            array_push($pending_verify_candidates, $display_application_detail);
        }

        return view('oas.admin.afo.pendingVerifiedPaymentSlip', compact('pending_verify_candidates'));
    }
}
