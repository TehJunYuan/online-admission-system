<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Mail\Email;
use App\Models\UserDetail;
use App\Mail\RejectedEmail;
use Illuminate\Http\Request;
use App\Models\ApplicantProfile;
use App\Models\CandidateProfile;
use App\Models\ApplicationRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class RejectController extends Controller
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

        $get_candidate_profile_status_id = 
            CandidateProfile::where('application_record_id', $APPLICATIONRECORDID)
                ->first();

        $r = request();

        $data = [
            'subject' => 'Status of Application of Student',
            'name' => 'Student Name : '.$get_user_details->en_name."",
            'ic' => 'IC : '.$get_user_details->ic."",
            'status' => 'Status : Payment Rejected by AFO',
            'reason' => 'Reason : '.$r->content,
        ];
        
        $user_email = $get_user_details->email;
        $sendEmail = array('b230085a@sc.edu.my');
        $ccEmail = array('b230085a@sc.edu.my','b230085a@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new RejectedEmail($data));

        $get_candidate_profile_status_id->candidate_profile_status_id = 
            config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO');

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

        $get_candidate_profile_status_id = 
            CandidateProfile::where('application_record_id', $APPLICATIONRECORDID)
                ->first();

        $r = request();

        $data = [
            'subject' => 'Status of Application of Student',
            'name' => 'Student Name : '.$get_user_details->en_name."",
            'ic' => 'IC : '.$get_user_details->ic."",
            'status' => 'Status : Application Rejected by SRO',
            'reason' => 'Reason : '.$r->content,
        ];
        
        $user_email = $get_user_details->email;
        $sendEmail = array('b230085a@sc.edu.my');
        $ccEmail = array('b230085a@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new RejectedEmail($data));

        $get_candidate_profile_status_id->candidate_profile_status_id = 
            config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_SRO');

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
        
        $get_candidate_profile_status_id = 
            CandidateProfile::where('application_record_id', $APPLICATIONRECORDID)
                ->first();

        $r = request();

        $data = [
            'subject' => 'Status of Application of Student',
            'name' => 'Student Name : '.$get_user_details->en_name."",
            'ic' => 'IC : '.$get_user_details->ic."",
            'status' => 'Status : Application Rejected by AARO',
            'reason' => 'Reason : '.$r->content,
        ];
        
        $user_email = $get_user_details->email;
        $sendEmail = array('b230085a@sc.edu.my');
        $ccEmail = array('b230085a@sc.edu.my','b230085a@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new RejectedEmail($data));

        $get_candidate_profile_status_id->candidate_profile_status_id = 
            config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_AARO');
            
        $get_candidate_profile_status_id->save();

        return back();
    }
}
