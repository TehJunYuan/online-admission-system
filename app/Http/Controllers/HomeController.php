<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Payment;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\ProgrammePicked;
use App\Models\ApplicantProfile;
use App\Models\ApplicationRecord;
use App\Models\ApplicantStatusLog;
use App\Models\ApplicationStatusLog;
use App\Models\DisplayApplicationDetails;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function stuDashboard()
    {

        $get_applicant_profile_status = 
            ApplicantStatusLog::select('applicant_profile_status_id')
                ->where('user_id',Auth::id())
                ->first();
        
        $get_application_status_logs = 
            ApplicationStatusLog::where('user_id',Auth::id())
                ->get();

        $arr_application_record_id = array();

        foreach ($get_application_status_logs as $item) 
        {
            $arr_application_record_id[] = $item->application_record_id;
        }

        $get_programme_pickeds = 
            ProgrammePicked::whereIn('application_record_id', $arr_application_record_id)
                ->get();

        $data = [
            'applicant_profile_status' => $get_applicant_profile_status,
            'application_status_logs' => $get_application_status_logs,
            'programme_pickeds' => $get_programme_pickeds,
        ];

        return view('oas.student.dashboard', compact('data'));
    }

    public function adminDashboard()
    {
        if(Auth::user()->is_admin != 1)
        {
            return view('welcome');
        }
        return view('oas.admin.dashboard');
    }

}
