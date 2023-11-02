<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\ApplicantProfile;
use App\Models\ApplicationRecord;
use App\Models\ApplicationRemark;
use Illuminate\Support\Facades\Crypt;
use App\Models\ApplicationRemarkMapping;

class ApplicationRemarkController extends Controller
{
    //
    public function index($id)
    {
        $APPLICATIONRECORDID = Crypt::decrypt($id);

        // get applicant profile id
        $getApplicantProfileId = 
            ApplicationRecord::select('applicant_profile_id')
                ->where('id',$APPLICATIONRECORDID)
                ->first();

        $applicantProfile = 
            ApplicantProfile::select('user_detail_id')
                ->where('id',$getApplicantProfileId->applicant_profile_id)
                ->first();

        $userDetail = 
            UserDetail::where('id',$applicantProfile->user_detail_id)
                ->first();

        $allRemarkData = 
            ApplicationRemarkMapping::where('application_record_id',$APPLICATIONRECORDID)
                ->orderBy('id','desc')
                ->get();

        $getRemarkId = array();

        foreach($allRemarkData as $item)
        {
            $getRemarkId[] = $item->application_remark_id;
        }

        $remarkDate = ApplicationRemark::whereIn('id',$getRemarkId)->orderBy('updated_at','desc')->first();

        return view('oas.admin.remark.home', compact(['APPLICATIONRECORDID', 'userDetail','allRemarkData','remarkDate']));
    }

    public function create(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'application_record_id' => 'required'
        ]);

        $data = $request->all();

        $now = DB::raw('CURRENT_TIMESTAMP');

        $get_remark_id = ApplicationRemark::insertGetId([
            'content' => $data['content'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        ApplicationRemarkMapping::create([
            'user_id' => Auth::id(),
            'application_remark_id' => $get_remark_id,
            'application_record_id' => $data['application_record_id'],
        ]);

        return redirect()->back();
    }

    public function getConversationMessage(Request $request)
    {
        // $APPLICATIONRECORDID = Crypt::decrypt($id);
        $allRemarkData = 
        ApplicationRemarkMapping::leftjoin('application_remarks', 'application_remarks.id', '=', 'application_remark_mappings.application_remark_id')
        ->join('users','application_remark_mappings.user_id','=','users.id')
        ->join('model_has_roles','model_has_roles.model_id','=','users.id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('application_record_id',$request->id)
        ->select('application_remark_mappings.*','application_remarks.content','users.name','roles.name AS rolesname')    
        ->orderBy('id','desc')
        ->get();
            // ->toSql();
            // dd($allRemarkData);
        // $remarkDate = ApplicationRemark::where('id',$request->id)->orderBy('updated_at','desc')->get(); 
        return $allRemarkData;
    }
}
