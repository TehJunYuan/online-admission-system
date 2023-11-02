<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Mail\ApprovedEmail;
use Illuminate\Http\Request;
use App\Models\ApplicantProfile;
use App\Models\CandidateProfile;
use App\Models\ApplicationRecord;
use App\Models\CmsApplicantDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\ApplicationApprovalEmail;

class ApprovedController extends Controller
{
    //
    public function AFO($id)
    {
        $APPLICATIONRECORDID = Crypt::decrypt($id);

        // get applicant profile id
        $get_applicant_profile_id = 
            ApplicationRecord::where('id',$APPLICATIONRECORDID)
                ->first();

        $get_applicant_profile = 
            ApplicantProfile::where('id',$get_applicant_profile_id->applicant_profile_id)
                ->first();

        $get_user_details = 
            UserDetail::where('id',$get_applicant_profile->user_detail_id)
                ->first();

        $get_temp_code = 
            CmsApplicantDetail::where('application_record_id',$APPLICATIONRECORDID)
                ->first();

        $get_candidate_profile_status_id = 
            CandidateProfile::where('application_record_id', $APPLICATIONRECORDID)
                ->first();

        $r = request();

        $data = [
            'subject' => 'Status of Application of Student',
            'name' => 'Student Name : '.$get_user_details->en_name."",
            'ic' => 'IC : '.$get_user_details->ic."",
            'tempCode' => 'Temp Code : '.$get_temp_code->tempCode."",
            'status' => 'Status : Payment Verified by AFO',
        ];
        
        $sendEmail = array('pt0015@sc.edu.my');
        $ccEmail = array('pt0015@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new ApprovedEmail($data));

        $get_candidate_profile_status_id->candidate_profile_status_id = 
            config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_PAYMENT_SLIP');

        $get_candidate_profile_status_id->save();

        return back();
    }


    public function SRO($id)
    {
        $APPLICATIONRECORDID = Crypt::decrypt($id);

        // get applicant profile id
        $get_applicant_profile_id = 
            ApplicationRecord::where('id',$APPLICATIONRECORDID)
                ->first();

        $get_applicant_profile = 
            ApplicantProfile::where('id',$get_applicant_profile_id->applicant_profile_id)
                ->first();

        $get_user_details = 
            UserDetail::where('id',$get_applicant_profile->user_detail_id)
                ->first();

        $get_temp_code = 
            CmsApplicantDetail::where('application_record_id',$APPLICATIONRECORDID)
                ->first();

        $r = request();
        
        $get_candidate_profile_status_id = 
            CandidateProfile::where('application_record_id', $APPLICATIONRECORDID)
                ->first();

        $data = [
            'subject' => 'Status of Application of Student',
            'name' => 'Student Name : '.$get_user_details->en_name."",
            'ic' => 'IC : '.$get_user_details->ic."",
            'tempCode' => 'Temp Code : '.$get_temp_code->tempCode."",
            'status' => 'Status : Application Detail checked, promotion and programmed proposed by SRO. Please check at the remark.',
        ];
        
        $sendEmail = array('pt0015@sc.edu.my');
        $ccEmail = array('pt0015@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new ApprovedEmail($data));

        $get_candidate_profile_status_id->candidate_profile_status_id = 
            config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_APPLICATION');

        $get_candidate_profile_status_id->save();

        return back();
    }


    public function AARO($id)
    {
        $APPLICATIONRECORDID = Crypt::decrypt($id);

        // get applicant profile id
        $get_applicant_profile_id = 
            ApplicationRecord::where('id',$APPLICATIONRECORDID)
                ->first();

        $get_applicant_profile = 
            ApplicantProfile::where('id',$get_applicant_profile_id->applicant_profile_id)
                ->first();

        $get_user_details = 
            UserDetail::where('id',$get_applicant_profile->user_detail_id)
                ->first();

        $get_temp_code = 
            CmsApplicantDetail::where('application_record_id',$APPLICATIONRECORDID)
                ->first();

        $get_candidate_profile_status_id = 
            CandidateProfile::where('application_record_id', $APPLICATIONRECORDID)
                ->first();

        $r = request();

        $data = [
            'subject' => 'Status of Application of Student',
            'name' => 'Student Name : '.$get_user_details->en_name."",
            'ic' => 'IC : '.$get_user_details->ic."",
            'tempCode' => 'Temp Code : '.$get_temp_code->tempCode."",
            'status' => 'Status : Applciation Approved by AARO. The offer letter will be generated in 7 working days.',
        ];
        
        // $user_Email -> $get_user_details->email;
        $sendEmail = array('pt0015@sc.edu.my','pt0015@sc.edu.my');
        $ccEmail = array('pt0015@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new ApprovedEmail($data));

        $get_candidate_profile_status_id->candidate_profile_status_id = 
            config('constants.CANDIDATE_PROFILE_STATUS.APPROVE_BECOME_STUDENT');

        $get_candidate_profile_status_id->save();

        return back();
    }
}
