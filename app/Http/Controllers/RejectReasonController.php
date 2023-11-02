<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\DecryptId;
use App\Models\UserDetail;
use App\Models\RejectReason;
use Illuminate\Http\Request;
use App\Models\ApplicantProfile;
use App\Models\ApplicationRecord;
use App\Models\ApplicationRemark;
use App\Models\CmsApplicantDetail;
use App\Models\RejectReasonMapping;
use Illuminate\Support\Facades\Crypt;
use App\Models\ApplicationRemarkMapping;
use App\Http\Controllers\RejectController;

class RejectReasonController extends Controller
{
    //
    public function index($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATIONRECORDID = $DECRYPTED_RECORD_ID->getDecryptedId();

        // get applicant profile id
        $get_applicant_profile_id = 
            ApplicationRecord::where('id',$APPLICATIONRECORDID)
                ->first();

        $get_user_detail_id = 
            ApplicantProfile::select('user_detail_id')
                ->where('id',$get_applicant_profile_id->applicant_profile_id)
                ->first();

        $get_user_detail = 
            UserDetail::select('en_name')
                ->where('id',$get_user_detail_id->user_detail_id)
                ->first();

        $get_all_reject_reason = 
            RejectReasonMapping::where('application_record_id',$APPLICATIONRECORDID)
                ->orderBy('id','desc')
                ->get();

        $get_temp_code = 
            CmsApplicantDetail::select('tempCode')
                ->where('application_record_id',$APPLICATIONRECORDID)
                ->first();

        $get_reject_reason_id = array();

        foreach($get_all_reject_reason as $item)
        {
            $get_reject_reason_id[] = $item->reject_reason_id;
        }

        $get_all_reject_date = RejectReason::whereIn('id',$get_reject_reason_id)->orderBy('updated_at','desc')->first();

        return view('oas.admin.rejectReason.home', compact(['get_temp_code','APPLICATIONRECORDID','get_user_detail','get_all_reject_reason','get_all_reject_date']));
    }
    
    public function create(Request $request)
    {
        $userRole = Auth::user()->roles[0]['name'];

        $request->validate([
            'content' => 'required',
            'application_record_id' => 'required'
        ]);

        $data = $request->all();

        $now = DB::raw('CURRENT_TIMESTAMP');
        
        $get_reject_reason_id = RejectReason::insertGetId([
            'content' => $data['content'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $get_application_remark_id = ApplicationRemark::insertGetId([
            'content' => $data['content'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        RejectReasonMapping::create([
            'user_id' => Auth::id(),
            'reject_reason_id' => $get_reject_reason_id,
            'application_record_id' => $data['application_record_id'],
        ]);

        ApplicationRemarkMapping::create([
            'user_id' => Auth::id(),
            'application_remark_id' => $get_application_remark_id,
            'application_record_id' => $data['application_record_id'],
        ]);

        (new RejectController)->$userRole(Crypt::encrypt($data['application_record_id']));

        return redirect()->back();
    }
}
