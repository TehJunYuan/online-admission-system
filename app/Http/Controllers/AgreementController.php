<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\DecryptId;
use Illuminate\Http\Request;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Crypt;

class AgreementController extends Controller
{
    //
    public function index($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        $get_application_status_id = 
            ApplicationStatusLog::where('user_id',Auth::id())
                ->where('application_record_id', $APPLICATION_RECORD_ID)
                ->first();

        if($get_application_status_id->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_STATUS_OF_HEALTH'))
        {
            return view('oas.student.agreements.home',compact('APPLICATION_RECORD_ID'));
        }
        else if ($get_application_status_id->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_AGREEMENT'))
        {
            return redirect()->route('draft.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]);
        }

        return redirect()->route('stu.dashboard');
        
    }

    public function submit($id)
    {
        $r = request();
        
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        $get_application_status_log = 
            ApplicationStatusLog::where('user_id', Auth::id())
                ->where('application_record_id', $APPLICATION_RECORD_ID)
                ->first();

        if($get_application_status_log->application_status_id != config('constants.APPLICATION_STATUS_CODE.COMPLETE_STATUS_OF_HEALTH'))
        {
            return redirect()->route('stu.dashboard');
        }

        $get_application_status_log->application_status_id = config('constants.APPLICATION_STATUS_CODE.COMPLETE_AGREEMENT');
        $get_application_status_log->save();

        return redirect()->route('draft.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]);
    }
}
