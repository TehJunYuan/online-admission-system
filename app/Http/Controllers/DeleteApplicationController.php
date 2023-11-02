<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Payment;
use App\Models\DecryptId;
use Illuminate\Http\Request;
use App\Models\AcademicRecord;
use App\Models\StatusOfHealth;
use App\Models\ProgrammePicked;
use App\Models\IdentityDocument;
use App\Models\ApplicationRecord;
use App\Models\AcademicTranscript;
use App\Models\SupportingDocument;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatusLog;
use App\Models\IdentityDocumentPage;
use App\Models\SupportingDocumentCrud;
use Illuminate\Support\Facades\Storage;

class DeleteApplicationController extends Controller
{
    //delete payment slip
    public function DeletePaymentSlip($id){
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $document_list = $supportingDocumentCrud->getPaymentSlip($id);
        foreach($document_list as $payment_slip){
            if(Storage::disk('c-drive')->exists('/'.$payment_slip->getFoldername().'/'.$payment_slip->getFolderpath()) && Storage::disk('c-drive')->exists('/'.$payment_slip->getFoldername().'/'.$payment_slip->getFilename())){
                // delete storage item
                Storage::disk('c-drive')->deleteDirectory('/'.$payment_slip->getFoldername().'/'.$payment_slip->getFolderpath());
                //delete database entry
                $deletedPaymentSlip = Payment::where('application_record_id',$payment_slip->getApplicationrecordid())->delete();
            }
        }
        
    }

    //clean up temporary file table, if any
    public function DeleteTemporaryFiles($id){
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $supportingDocumentCrud->removeSingleUserTemporaryFiles($id);
    }

    //identity_documents_pages
    public function DeleteIdentityDocumentPages($document_list){
        //delete the pictures in storage but check if it exist first
        foreach($document_list as $identity_document){
            //dd($identity_document->getFolderpath());
            if(Storage::disk('c-drive')->exists('/'.$identity_document->getFoldername().'/'.$identity_document->getFolderpath()) && Storage::disk('c-drive')->exists('/'.$identity_document->getFoldername().'/'.$identity_document->getFilename())){
                // delete storage item
                Storage::disk('c-drive')->deleteDirectory('/'.$identity_document->getFoldername().'/'.$identity_document->getFolderpath());
                
            }
            //delete database entry
            $deletedIdentityDocument = IdentityDocumentPage::where('identity_document_id',$identity_document->getSupportingdocumentid())->delete();
        }
        
    }
    //identity_documents
    public function DeleteIdentityDocuments($id){
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $document_list = $supportingDocumentCrud->getSingleIdentityDocument($id);
        //delete the database entry
        $this->DeleteIdentityDocumentPages($document_list);
        if(count($document_list)>0){
            $deletedIdentityDocument = IdentityDocument::where('application_record_id',$document_list[0]->getApplicationrecordid())->delete();
        }
        
        

    }
    //supporting_documents
    public function DeleteSupportingDocuments($academicRecord){
        //delete the pictures in storage but check if it exist first
            if(Storage::disk('c-drive')->exists('/'.$academicRecord->getFoldername().'/'.$academicRecord->getFolderpath()) && Storage::disk('c-drive')->exists('/'.$academicRecord->getFoldername().'/'.$academicRecord->getFilename())){
                // delete storage item
                    Storage::disk('c-drive')->deleteDirectory('/'.$academicRecord->getFoldername().'/'.$academicRecord->getFolderpath());

            }
            //delete database entry
            $deletedIdentityDocument = SupportingDocument::where('id',$academicRecord->getSupportingdocumentid())->delete();
    }
    //academic_transcripts
    public function DeleteAcademicTranscripts($document_list){
        //delete the database entry
        foreach($document_list as $academicRecord){
            $deletedAcademicTranscript = AcademicTranscript::where('academic_record_id',$academicRecord->getAcademicrecordid())->delete();
            $this->DeleteSupportingDocuments($academicRecord);
        }
        
    }
    //academic_records
    public function DeleteAcademicRecords($id){
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);
        //call function in SupportingDocumentCrud controller to get id of documents to be deleted
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $document_list = $supportingDocumentCrud->getSingleApplicationSupportingDocument($id);
        //delete academic record database entry
        $this->DeleteAcademicTranscripts($document_list);
        $deletedAcademicRecord = AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID->getDecryptedId())->delete();
        
        
    }

    //status_of_health
    public function DeleteStatusOfHealth($id){
        $status_of_health = StatusOfHealth::where('application_record_id',$id)->delete();
    }

    //programme_picked
    public function DeleteProgrammePickeds($id){
        $programme_picked = ProgrammePicked::where('application_record_id',$id)->delete();
    }

    //application_status_logs
    public function DeleteApplicationStatusLogs($id){
        $application_status_log = ApplicationStatusLog::where('application_record_id',$id)->delete();
    }

    //application_records
    public function DeleteApplicationRecords($id){
        $application_record = ApplicationRecord::where('id',$id)->delete();
    }

    public function DeleteApplication($id){
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);
        //Storage::deleteDirectory('/public/images/testingtesting');
        //already have built in decryption method
        $this->DeletePaymentSlip($id);
        $this->DeleteAcademicRecords($id);
        $this->DeleteIdentityDocuments($id);
        //doesn't have decryption method, must supply decrypted id
        $this->DeleteTemporaryFiles($APPLICATION_RECORD_ID->getDecryptedId());
        $this->DeleteStatusOfHealth($APPLICATION_RECORD_ID->getDecryptedId());
        $this->DeleteProgrammePickeds($APPLICATION_RECORD_ID->getDecryptedId());
        $this->DeleteApplicationStatusLogs($APPLICATION_RECORD_ID->getDecryptedId());
        $this->DeleteApplicationRecords($APPLICATION_RECORD_ID->getDecryptedId());
        
        return redirect()->route('stu.dashboard');

    }
}
