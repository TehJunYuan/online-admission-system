<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Response;
use App\Models\DecryptId;
use Illuminate\Http\Request;
use App\Models\SupportingDocument;
use App\Models\ApplicationRecord;
use App\Models\ApplicantProfilePicture;
use App\Http\Controllers\Controller;
use App\Models\IdentityDocumentPage;
use Illuminate\Support\Facades\Crypt;
use App\Models\SupportingDocumentCrud;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class SupportingDocumentCrudController extends Controller
{
    //display it out
    public function displaySingleApplicationSupportingDocument ($id)
    {
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $document_list = $supportingDocumentCrud->getSingleApplicationSupportingDocument($id);
        return view('oas.admin.supportingDocument.home', compact('document_list'));
    }


    public function displaySingleApplicationSupportingDocumentForAARO ($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATIONRECORDID = $DECRYPTED_RECORD_ID->getDecryptedId();

        $supportingDocumentCrud = new SupportingDocumentCrud();

        $getApplicantProfileId = ApplicationRecord::where('id',$APPLICATIONRECORDID)->first();
        $document_list = $supportingDocumentCrud->getSingleApplicationSupportingDocumentForAARO($id);
        $identity_document_list = $supportingDocumentCrud->getSingleIdentityDocumentForAARO($id);

        //profile picture
        $applicantProfilePicture = ApplicantProfilePicture::where('applicant_profile_id',$getApplicantProfileId->applicant_profile_id)->first();
        $profileimage = 'data:image/jpeg;base64,' . base64_encode(Storage::disk('c-drive')->get($applicantProfilePicture->folderdir.'/'.Crypt::decrypt($applicantProfilePicture->path)));

        $data =[
            'application_profile_id' => $getApplicantProfileId->id,
            'profile_image' => $profileimage,
        ]; 
        return view('oas.admin.supportingDocument.home', compact('document_list','identity_document_list','data'));
    }

    //get only a single document
    public function displaySingleDocument ($id,$maindirectory)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        //get the single payment slip via id, construct the url path
        $document = SupportingDocument::where('id',$DECRYPTED_RECORD_ID->getDecryptedId())->first();
        $fullfilepath = Crypt::decrypt($maindirectory).'/'.Crypt::decrypt($document->doc);
        //check image exist or not
        $exists = Storage::disk('c-drive')->exists($fullfilepath);
        
        if($exists) {
            
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
        } else {
            abort(404);
        }
    }

    //get only a single document
    public function displaySingleIdentityDocument ($id,$maindirectory)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        //get the single payment slip via id, construct the url path
        $document = IdentityDocumentPage::where('identity_document_id',$DECRYPTED_RECORD_ID->getDecryptedId())->first();
        $fullfilepath = Crypt::decrypt($maindirectory).'/'.Crypt::decrypt($document->page);
        //check image exist or not
        $exists = Storage::disk('c-drive')->exists($fullfilepath);
        
        if($exists) {
            
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
        } else {
            abort(404);
        }
    }
}
