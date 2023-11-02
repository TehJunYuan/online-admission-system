<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Response;
use App\Models\DecryptId;
use App\Models\OfferLetter;
use Illuminate\Http\Request;
use App\Models\ProgrammePicked;
use App\Models\CandidateProfile;
use App\Models\RejectReasonMapping;
use Illuminate\Support\Facades\Crypt;
use App\Models\SupportingDocumentCrud;
use Illuminate\Support\Facades\Storage;
use App\Models\DisplayApplicationProgress;

class ApplicationProgressController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        return('home');
    }
    
    //
    public function removeSession()
    {
        Session::forget(['paymentSlipFileName','paymentSlipFolder']);
    }

    public function index()
    {
        $this->exceptionRoute();
        $get_candidate_profile = 
            CandidateProfile::select('application_record_id', 'candidate_profile_status_id', 'created_at', 'updated_at')
                ->where('user_id', Auth::user()->id)
                ->get();

        $get_all_application_record_id = array();
        $Application_Object = array();

        foreach ($get_candidate_profile as $item)
        {
            $get_all_application_record_id[] = $item->application_record_id;

        }
        for($i=0; $i < count($get_candidate_profile); $i++){
            $display_application_progress = new DisplayApplicationProgress();
            $get_reject_reason =
            RejectReasonMapping::where('application_record_id', $get_candidate_profile[$i]->application_record_id)
                ->latest('reject_reason_id')
                ->first();
            $display_application_progress->setReject_reason($get_reject_reason);
            array_push($Application_Object,$display_application_progress);
        }

        $get_selected_programme = 
            ProgrammePicked::whereIn('application_record_id', $get_all_application_record_id)
                ->get();

        $data = [
            'candidateProfile' => $get_candidate_profile,
            'programme' =>$get_selected_programme,
            'Application_Object' =>$Application_Object,
        ];
        $supportingDocumentCrud = new SupportingDocumentCrud();

        foreach ($get_all_application_record_id as $item)
        {
            $supportingDocumentCrud->removeSingleUserTemporaryFiles($item);
        }

        $this->removeSession();
        $getPaymentSlipFolder = Session::get('paymentSlipFolder');
        $getPaymentSlipFileName = Session::get('paymentSlipFileName');
        foreach ($Application_Object as $item2){
            //dd($item2->getReject_reason()->application_record_id);
        }
        return view('oas.student.applicationProgress.home', compact('data','Application_Object'));
    }

    //get single offer letter
    public function getOfferLetter($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);

        //get the single offer letter via id, construct the url path
        $offer_letter = OfferLetter::where('application_record_id',$DECRYPTED_RECORD_ID->getDecryptedId())->first();
        
        $fullfilepath = 'offerLetter/'.Crypt::decrypt($offer_letter->offer_letter);

        //check image exist or not
        $exists = Storage::disk('c-drive')->exists($fullfilepath);
        
        if($exists)
        {
            //get content of image
            $content = Storage::disk('c-drive')->get($fullfilepath);
            //get mime type of image
            $mime = Storage::disk('c-drive')->mimeType($fullfilepath);
            //prepare response with image content and response code
            $response = Response::make($content, 200);
            //set header 
            $response->header("Content-Type", $mime);
            // return response
            return $response;
        } 
        else 
        {
            abort(404);
        }
    }

    public function exceptionRoute()
    {
        return redirect()->route('stu.dashboard');
    }
}
