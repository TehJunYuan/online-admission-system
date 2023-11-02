<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\DecryptId;
use App\Models\UserDetail;
use App\Models\OfferLetter;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\ApplicantProfile;
use App\Models\CandidateProfile;
use App\Models\ApplicationRecord;
use App\Models\ApplicantStatusLog;
use App\Models\CmsApplicantDetail;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Crypt;
use App\Models\SupportingDocumentCrud;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationApprovalEmail;


class OfferLetterController extends Controller
{
    //
    public function removeSession()
    {
        Session::forget(['offerLetterFileName','offerLetterFolder']);
    }

    public function index($id)
    {
        $this->removeSession();

        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        $getInfomationCandidate = 
            CandidateProfile::where('application_record_id',$APPLICATION_RECORD_ID)
                ->first();

        $get_user_detail_id = 
            ApplicantProfile::where('id', $getInfomationCandidate->applicant_profile_id)
                ->first();
        
        $get_user_detail = 
            UserDetail::where('id', $get_user_detail_id->user_detail_id)
                ->first();
        
        $get_cms_detail =
            CmsApplicantDetail::where('application_record_id',$APPLICATION_RECORD_ID)
                ->first();

        $supportingDocumentCrud = new SupportingDocumentCrud();
        $supportingDocumentCrud->removeSingleUserTemporaryFiles($APPLICATION_RECORD_ID);
        
        return view('oas.admin.offer_letter.home', compact(['APPLICATION_RECORD_ID','get_user_detail','get_cms_detail']));
    }

    public function create($id)
    {
        $r = request();

        $getOfferLetterFolder=$r->file('offerLetter');        
        $getOfferLetterFolder->move('storage\images\offerLetter\tmp',$getOfferLetterFolder->getClientOriginalName());   //images is the location                
        $getOfferLetterFileName=$getOfferLetterFolder->getClientOriginalName(); 
        
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();
        
        $getApplicationStatusLog = 
            CandidateProfile::where('application_record_id',$APPLICATION_RECORD_ID)
                ->first();

        $temporary_file = 
            Storage::get('/public/images/offerLetter/tmp/'.$getOfferLetterFileName);
        
        Storage::disk('c-drive')
            ->put('offerLetter/'.$getOfferLetterFileName,$temporary_file);

        $offerLetterFolderPath =
            Storage::disk('c-drive')->url('offerLetter/'.$getOfferLetterFileName);

        $createOfferLetter = 
        OfferLetter::create([
                'application_record_id' => $APPLICATION_RECORD_ID,
                'offer_letter' => Crypt::encrypt($getOfferLetterFileName),
                'folderpath' => Crypt::encrypt($offerLetterFolderPath),
            ]);

        Storage::delete('/public/images/offerLetter/tmp/'.$getOfferLetterFileName);

        $this->SuccessBecomeStudent(Crypt::encrypt($APPLICATION_RECORD_ID));
        
        $getApplicationStatusLog->candidate_profile_status_id = config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_OFFER_LETTER');
        $getApplicationStatusLog->save();

        return redirect()->route('aaro.home');
    }

    public function exceptionRoute()
    {
        return redirect()->route('aaro.home');
    }


    public function SuccessBecomeStudent($id)
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
        
        $data = [
            'subject' => 'Status of Application of Student',
            'name' => $get_user_details->en_name."",
            'status' => 'Congratulation, the Application had been approved. Please check your offer letter at',
        ];
        
        //send email (you can change the email depends on the department needed)
        Mail::to($get_user_details->email)->send(new ApplicationApprovalEmail($data));
    }
}
