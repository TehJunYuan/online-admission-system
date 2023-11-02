<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Payment;
use App\Models\DecryptId;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\CandidateProfile;
use App\Models\ApplicationRecord;
use App\Models\ApplicantStatusLog;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Crypt;
use App\Models\SupportingDocumentCrud;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    //
    public function removeSession()
    {
        Session::forget(['paymentSlipFileName','paymentSlipFolder']);
    }

    public function index($id)
    {
        $this->removeSession();

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();
        
        $get_application_status_id = 
            ApplicationStatusLog::where('user_id',Auth::id())
                ->where('application_record_id',$APPLICATION_RECORD_ID)
                ->first();

        $supportingDocumentCrud = new SupportingDocumentCrud();
        $supportingDocumentCrud->removeSingleUserTemporaryFiles($APPLICATION_RECORD_ID);

        if ($get_application_status_id->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_SUPPORTING_DOCUEMENT'))
        {
            return view('oas.student.payment.home', compact(['APPLICATION_RECORD_ID']));
        }

        return redirect()->route('stu.dashboard');
    }

    public function create($id)
    {
        $r = request();

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        (new DataFlowController)->index(Crypt::encrypt($APPLICATION_RECORD_ID));
        
        $getApplicationStatusLog = 
            ApplicationStatusLog::where('user_id', Auth::id())
                ->where('application_record_id',$APPLICATION_RECORD_ID)
                ->first();

        $getApplicantProfileId = 
            ApplicationRecord::select('applicant_profile_id')
                ->where('id', $APPLICATION_RECORD_ID)
                ->first();

        if ($getApplicationStatusLog->application_status_id != config('constants.APPLICATION_STATUS_CODE.COMPLETE_SUPPORTING_DOCUEMENT'))
        {
            return redirect()->route('stu.dashboard');
        }

        $getPaymentSlipFolder = Session::get('paymentSlipFolder');
        $getPaymentSlipFileName = Session::get('paymentSlipFileName');

        //if the user clicked continue without uploading anything
        if (!is_array($getPaymentSlipFolder) || !is_array($getPaymentSlipFileName))
        {
            Session::flash('error', 'Please upload your payment slip.');
            return back();
        }

        for ($i=0; $i < count($getPaymentSlipFolder); $i++) 
        {
            $temporary =
                TemporaryFile::where('folder',$getPaymentSlipFolder[$i])
                    ->where('file',$getPaymentSlipFileName[$i])
                    ->first();

            if ($temporary)
            {
                $createPaymentSlip = 
                    Payment::create([
                        'application_record_id' => $APPLICATION_RECORD_ID,
                        'payment_slip' => Crypt::encrypt($getPaymentSlipFolder[$i].'/'. $getPaymentSlipFileName[$i]),
                        'folderpath' => Crypt::encrypt($getPaymentSlipFolder[$i]),
                    ]);

                $temporary_image = 
                    Storage::get('/public/images/paymentSlip/tmp/'.$getPaymentSlipFolder[$i].'/'.$getPaymentSlipFileName[$i]);

                Storage::disk('c-drive')
                    ->put('paymentSlip/'.$getPaymentSlipFolder[$i].'/'.$getPaymentSlipFileName[$i],$temporary_image);

                Storage::deleteDirectory('/public/images/paymentSlip/tmp/'. $getPaymentSlipFolder[$i]);

                $temporary->delete();
            }
        }

        $this->removeSession();
        
        $getApplicationStatusLog->application_status_id = config('constants.APPLICATION_STATUS_CODE.COMPLETE_PAYMENT');
        $getApplicationStatusLog->save();
        
        return redirect()->route('stu.dashboard');
    }

    public function tmpUpload(Request $request)
    {
        //if the user access this via direct url call, redirect back to home page
        if (!$request->isMethod('post')) 
        {
            return redirect()->route('stu.dashboard');
        }

        $folderName = '';

        if ($request->hasFile('paymentSlip'))
        {
            $paymentSlip = $request->file('paymentSlip');
            $paymentSlipFileName = 'paymentSlip_'.Auth::user()->name.'_'.date('YmdHii').'_'.$paymentSlip->getClientOriginalName();
            $paymentSlipFolder = uniqid('paymentSlip', true);

            Session::push('paymentSlipFileName', $paymentSlipFileName);
            Session::push('paymentSlipFolder', $paymentSlipFolder);

            //extra attributes to mark the temp folders for deletion
            $applicant_status_log = 
                ApplicantStatusLog::where('user_id',Auth::id())
                    ->first();

            $getApplicationStatusLog = 
                ApplicationStatusLog::where('user_id',Auth::id())
                    ->latest()
                    ->first();

            $paymentSlip->storeAs('/public/images/paymentSlip/tmp/' . $paymentSlipFolder, $paymentSlipFileName);

            TemporaryFile::create([
                'folder' => $paymentSlipFolder,
                'file' => $paymentSlipFileName,
                'applicant_profile_id' => $applicant_status_log->applicant_profile_id,
                'application_record_id' => $getApplicationStatusLog->application_record_id,
                'folderdir' => 'paymentSlip',
            ]);

            $folderName = $paymentSlipFolder;
        }

        return $folderName;
    }

    public function tmpDelete(Request $request)
    {
        //if the user access this via direct url call, redirect back to home page
        if (!$request->isMethod('delete')) 
        {
            return redirect()->route('stu.dashboard');
        }

        $paymentSlipTmpFile = 
            TemporaryFile::where('folder', $request->file)
                ->first();

        $result = 'not found';

        if($paymentSlipTmpFile)
        {
            $paymentSlipFolderArr = array();
            $paymentSlipFileNameArr = array();

            if (Session::has('paymentSlipFolder'))
            {
                for ($i=0; $i < count(Session::get('paymentSlipFolder')); $i++)
                {
                    if(Session::get('paymentSlipFolder')[$i] != $paymentSlipTmpFile->folder)
                    {
                        array_push($paymentSlipFolderArr, Session::get('paymentSlipFolder')[$i]);
                    }
                }
                for ($i=0; $i < count(Session::get('paymentSlipFileName')); $i++)
                {
                    if(Session::get('paymentSlipFileName')[$i] != $paymentSlipTmpFile->file)
                    {
                        array_push($paymentSlipFileNameArr, Session::get('paymentSlipFileName')[$i]);
                    }
                }

                $this->removeSession();

                for ($i=0; $i< sizeof($paymentSlipFolderArr); $i++)
                {
                    Session::push('paymentSlipFolder', $paymentSlipFolderArr[$i]);
                } 

                for ($i=0; $i< sizeof($paymentSlipFileNameArr); $i++)
                {
                    Session::push('paymentSlipFileName', $paymentSlipFileNameArr[$i]);
                } 

                Storage::deleteDirectory('/public/images/paymentSlip/tmp/'. $paymentSlipTmpFile->folder);

                $paymentSlipTmpFile->delete();
                $result = 'success';
            }
        }
        return $result;
    }

    public function exceptionRoute()
    {
        return redirect()->route('stu.dashboard');
    }

}
