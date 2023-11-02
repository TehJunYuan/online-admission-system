<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Disease;
use App\Models\DecryptId;
use Illuminate\Http\Request;
use App\Models\StatusOfHealth;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Crypt;

class StatusOfHealthController extends Controller
{
    //
    public function index($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        // $diseases = Disease::where('status',config('constants.COL_ACTIVE.ACTIVE'))->get();
        $get_all_active_diseases = 
            Disease::select('id','name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE'))
                ->get();


        // $application_status_log = ApplicationStatusLog::where('user_id',Auth::id())->where('application_record_id',$APPLICATION_RECORD_ID)->first();
        $get_application_status_id = 
            ApplicationStatusLog::select('application_status_id')
                ->where('user_id', Auth::id())
                ->where('application_record_id', $APPLICATION_RECORD_ID)
                ->first();

        if ($get_application_status_id->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_ACADEMIC_DETAIL'))
        {
            return view('oas.student.statusOfHealth.home', 
                compact([
                    'get_all_active_diseases',
                    'APPLICATION_RECORD_ID'
                ])
            );
        }
        else if ($get_application_status_id->application_status_id > config('constants.APPLICATION_STATUS_CODE.COMPLETE_ACADEMIC_DETAIL'))
        {
            // $getStatusOfHealth = StatusOfHealth::where('application_record_id',$APPLICATION_RECORD_ID)->get();
            $get_user_status_of_health = 
                StatusOfHealth::where('application_record_id', $APPLICATION_RECORD_ID)
                    ->get();

            // $getDiseases = Disease::where('status',config('constants.COL_ACTIVE.ACTIVE'))->get();
            
            $data = [
                'activeDisease' => $get_all_active_diseases,
                'statusOfHealth' => $get_user_status_of_health,
            ];
            
            return view('oas.student.statusOfHealth.update', compact(['data','APPLICATION_RECORD_ID']));
        }

        return redirect()->route('stu.dashboard');
    }

    public function create($id)
    {
        $r = request();

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        // $getApplicationStatusLog = ApplicationStatusLog::where('user_id', Auth::id())->where('application_record_id',$APPLICATION_RECORD_ID)->first();
        $get_application_status_id =
            ApplicationStatusLog::where('user_id', Auth::id())
                ->where('application_record_id', $APPLICATION_RECORD_ID)
                ->first();

        if($get_application_status_id->application_status_id != config('constants.APPLICATION_STATUS_CODE.COMPLETE_ACADEMIC_DETAIL'))
        {
            return redirect()->route('stu.dashboard');
        }
        
        $get_all_disease_id = $r->disease_id;
        $get_all_disease_status = $r->disease_status;
        $get_all_disease_remark = $r->disease_remark;

        for ($i=0; $i < count($get_all_disease_id); $i++) { 
            StatusOfHealth::create([
                'application_record_id' => $APPLICATION_RECORD_ID,
                'disease_id' => $get_all_disease_id[$i],
                'disease_remark' => $get_all_disease_remark[$i],
                'disease_status' => $get_all_disease_status[$i],
            ]);
        }

        $get_application_status_id->application_status_id = config('constants.APPLICATION_STATUS_CODE.COMPLETE_STATUS_OF_HEALTH');
        $get_application_status_id->save();
        
        return redirect()->route('agreements.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]);
    }

    public function update($id){

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();
        
        $r = request();

        $getSelectedStatusOfHealth = StatusOfHealth::where('application_record_id',$APPLICATION_RECORD_ID)->get();

        $get_all_disease_id = $r->disease_id;
        $get_all_disease_status = $r->disease_status;
        $get_all_disease_remark = $r->disease_remark;

        for ($i=0; $i < count($get_all_disease_id); $i++) { 
            $getSelectedStatusOfHealth[$i]->disease_remark = $get_all_disease_remark[$i];
            $getSelectedStatusOfHealth[$i]->disease_status = $get_all_disease_status[$i];
            $getSelectedStatusOfHealth[$i]->save();
        }

        return back();
    }

    public function exceptionRoute()
    {
        return redirect()->route('stu.dashboard');
    }
}
