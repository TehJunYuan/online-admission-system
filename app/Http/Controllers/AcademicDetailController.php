<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\DecryptId;
use App\Models\SchoolLevel;
use Illuminate\Http\Request;
use App\Models\AcademicRecord;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Crypt;

class AcademicDetailController extends Controller
{
    //
    public function index($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        $get_all_active_school_levels = 
            SchoolLevel::select('id','name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE'))
                ->get();

        $get_application_status_id = 
            ApplicationStatusLog::where('user_id', Auth::id())
                ->where('application_record_id', $APPLICATION_RECORD_ID)
                ->first();

        if($get_application_status_id->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_PROGRAM_SELECTION'))
        {
            return view('oas.student.academicDetail.home', 
                compact([
                    'get_all_active_school_levels',
                    'APPLICATION_RECORD_ID'
                ])
            );
        }
        else if($get_application_status_id->application_status_id >= config('constants.APPLICATION_STATUS_CODE.COMPLETE_ACADEMIC_DETAIL'))
        {
            $get_all_academic_record = 
                AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID)
                    ->get();
                
            $get_all_active_academic_records = 
                AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID)
                    ->where('status',  config('constants.STATUS.STATUS_ACTIVE'))
                    ->get();       
                    
            $data = [
                'academicRecords' => $get_all_academic_record,
                'activeAcademicRecords' => $get_all_active_academic_records,
                'schoolLevels' => $get_all_active_school_levels,
            ];

            return view('oas.student.academicDetail.update', 
                compact([
                    'data',
                    'APPLICATION_RECORD_ID'   
                ])
            );
        }
        return redirect()->route('stu.dashboard');
    }

    public function create($id)
    {
        $r = request();

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        // used to validate the data
        $seen_pair = false;

        // get all data
        $get_all_school_name = $r->school_name;
        $get_all_school_graduation = $r->school_graduation;
        
        $get_application_status_log = 
            ApplicationStatusLog::where('user_id', Auth::id())
                ->where('application_record_id',$APPLICATION_RECORD_ID)
                ->first();

        if($get_application_status_log->application_status_id != config('constants.APPLICATION_STATUS_CODE.COMPLETE_PROGRAM_SELECTION'))
        {
            return redirect()->route('stu.dashboard');
        }

        // array for storing all school level id
        $ARR_SCHOOL_LEVEL = 
            array(
                config('constants.SCHOOL_LEVEL.SECONDARY'),
                config('constants.SCHOOL_LEVEL.UPPERSECONDARY'),
                config('constants.SCHOOL_LEVEL.FOUNDATION'),
                config('constants.SCHOOL_LEVEL.DIPLOMA'),
                config('constants.SCHOOL_LEVEL.DEGREE'),
                config('constants.SCHOOL_LEVEL.MASTER'),
                config('constants.SCHOOL_LEVEL.PHD'),
                config('constants.SCHOOL_LEVEL.OTHER')
            );

        // validation
        for ($i=0; $i < count($get_all_school_name); $i++) 
        {
            if($get_all_school_name[$i] != null && $get_all_school_graduation[$i] != null)
            {
                $seen_pair = true;
            }
            else if($get_all_school_name[$i] == null xor $get_all_school_graduation[$i] == null)
            {
                Session::flash('error', 'Please enter school name/graduation date.');
                return back();
            } 
        }
        if(!$seen_pair) 
        {
            Session::flash('error', 'Please key in a school name and graduation date information.');
            return back();
        }
        // store the academic record to database
        for ($i=0; $i < count($ARR_SCHOOL_LEVEL); $i++) 
        { 
            AcademicRecord::create([
                'school_level_id' => $ARR_SCHOOL_LEVEL[$i],
                'school_name' => $get_all_school_name[$i],
                'school_graduation' => $get_all_school_graduation[$i],
                'application_record_id' => $APPLICATION_RECORD_ID,
                'status' => ($get_all_school_name[$i] == null ? 0 : 1),
            ]);
        }
        // update the application status
        $get_application_status_log->application_status_id = config('constants.APPLICATION_STATUS_CODE.COMPLETE_ACADEMIC_DETAIL');
        $get_application_status_log->save();

        return redirect()->route('statusOfHealth.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]);
    }

    public function update($id)
    {
        $r = request();

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        $get_selected_academic_record = 
            AcademicRecord::where('application_record_id', $APPLICATION_RECORD_ID)
                ->get();

        $get_all_school_level_id = $r->school_level_id;
        $get_all_school_name = $r->school_name;
        $get_all_school_graduation = $r->school_graduation;

        for ($i=0; $i < count($get_all_school_level_id); $i++) { 
            $get_selected_academic_record[$i]->school_name = $get_all_school_name[$i];
            $get_selected_academic_record[$i]->school_graduation = $get_all_school_graduation[$i];
            $get_selected_academic_record[$i]->status = ($get_all_school_name[$i] == null?0:1);
            $get_selected_academic_record[$i]->save();
        }
        return back();
    }
}
