<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicRecord;
use App\Models\AcademicTranscript;
use App\Models\DecryptId;
use App\Models\SupportingDocument;
use App\Models\TemporaryFile;
use App\Models\IdentityDocumentPage;
use App\Models\IdentityDocument;
use App\Models\Payment;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Session;


class SupportingDocumentCrud extends Model
{
    use HasFactory;
    private $academicrecordid;
    private $supportingdocumentid;
    private $applicationrecordid;
    //these paths are set in constant
    private $foldername;
    private $folderpath;
    private $filename;
    private $encodedImage;
    private $filetype;

    public function setFileType($filetype){
        $this->filetype = $filetype;
    }
    public function getFileType(){
        return $this->filetype;
    }
    public function setEncodedImage($data){
        $this->encodedImage = 'data:image/jpeg;base64,' . base64_encode($data);
    }
    public function getEncodedImage(){
        return $this->encodedImage;
    }
    public function setApplicationrecordid($applicationrecordid){
        $this->applicationrecordid = $applicationrecordid;
    }
    public function getApplicationrecordid(){
        return $this->applicationrecordid;
    }
    public function setAcademicrecordid($academicrecordid){
        $this->academicrecordid = $academicrecordid;
    }
    public function getAcademicrecordid(){
        return $this->academicrecordid;
    }

    public function setSupportingdocumentid($supportingdocumentid){
        $this->supportingdocumentid = $supportingdocumentid;
    }
    public function getSupportingdocumentid(){
        return $this->supportingdocumentid;
    }

    public function setFoldername($foldername){
        $this->foldername = $foldername;
    }
    public function getFoldername(){
        return $this->foldername;
    }

    public function setFolderpath($folderpath){
        $this->folderpath = $folderpath;
    }
    public function getFolderpath(){
        return $this->folderpath;
    }

    public function setFilename($filename){
        $this->filename = $filename;
    }
    public function getFilename(){
        return $this->filename;
    }

    public function getSingleIdentityDocument($id){
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);
        
        $identityDocuments = IdentityDocument::where('application_record_id',$APPLICATION_RECORD_ID->getDecryptedId())->get();
        $document_list = [];
        if($identityDocuments->isNotEmpty()){
            foreach($identityDocuments as $identityDocument){
                $supportingDocumentCrud = new SupportingDocumentCrud();
                $icPath = IdentityDocumentPage::where('identity_document_id',$identityDocument->id)->get();
                $supportingDocumentCrud->setFilename(Crypt::decrypt($icPath[0]->page));
                $supportingDocumentCrud->setSupportingdocumentid($identityDocument->id);
                $supportingDocumentCrud->setFolderPath(Crypt::decrypt($icPath[0]->folderpath));
                $supportingDocumentCrud->setApplicationrecordid($APPLICATION_RECORD_ID->getDecryptedId());
                if($identityDocument->identity_document_type_id == 1){
                    $supportingDocumentCrud->setFolderName('icFront');
                }else if($identityDocument->identity_document_type_id == 2){
                    $supportingDocumentCrud->setFolderName('icBack');
                }
                array_push($document_list,$supportingDocumentCrud);
    
            }
        }
        
        //dd($document_list);
        return $document_list;
    }

    //read out the documents from aaro admin site
    public function getSingleApplicationSupportingDocumentForAARO($id){
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $document_list = $supportingDocumentCrud->getSingleApplicationSupportingDocument($id);
        foreach($document_list as $document){
            //decrypt and encode the image to be display
            //$data = Storage::disk('c-drive')->get($document->getFoldername().'/'.$document->getFilename());
            $this->identifyImagePDF($document);
            //dd($data);
            //$document->setEncodedImage($data);
        }
        return $document_list;
    }
    public function getSingleIdentityDocumentForAARO($id){
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $identity_document_list = $supportingDocumentCrud->getSingleIdentityDocument($id);

        foreach($identity_document_list as $identity_document){
            //decrypt and encode the image to be display
            //$data = Storage::disk('c-drive')->get($identity_document->getFoldername().'/'.$identity_document->getFilename());
            //dd($data);
            //$identity_document->setEncodedImage($data);
            $this->identifyImagePDF($identity_document);
        }
        return $identity_document_list;
    }

    public function identifyImagePDF($document){
        //check if the data mimetype is application/pdf
        $filetype = Storage::disk('c-drive')->mimeType($document->getFoldername().'/'.$document->getFilename());
        
        if($filetype == 'application/pdf'){
            $document->setFileType($filetype);
        }else{
            $data = Storage::disk('c-drive')->get($document->getFoldername().'/'.$document->getFilename());
            $document->setEncodedImage($data);
            $document->setFileType($filetype);
        }
    }
    //read out the documents from user perspective
    public function getSingleApplicationSupportingDocument($id){
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);
        
        //get the academic records of this application
        $academicRecords = AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID->getDecryptedId())->get('id');
        $document_list = [];
        foreach ($academicRecords as $academicRecord){
            //using each academic record id, get each of the academic transcript id
            //it is possible to have multiple academic transcripts using one academic record id
            $academicTranscripts = AcademicTranscript::where('academic_record_id',$academicRecord->id)->get();
            if($academicTranscripts->isNotEmpty()){
                for($i=0;$i<count($academicTranscripts);$i++){
                    //get the encrypted supporting document
                    $supportingDocumentCrud = new SupportingDocumentCrud();
                    $supportingDocument = SupportingDocument::where('id',$academicTranscripts[$i]->supporting_document_id)->get();
                    $supportingDocumentCrud->setAcademicrecordid($academicRecord->id);
                    $supportingDocumentCrud->setSupportingdocumentid($supportingDocument[0]->id);
                    $supportingDocumentCrud->setFilename(Crypt::decrypt($supportingDocument[0]->doc));
                    $supportingDocumentCrud->setApplicationrecordid($APPLICATION_RECORD_ID->getDecryptedId());
                    if($academicTranscripts[$i]->school_level_id == 1 && $supportingDocument[0]->isCert == 1){
                        $supportingDocumentCrud->setFoldername("schoolLeavingCerts");
                    }else if($academicTranscripts[$i]->school_level_id == 1 && $supportingDocument[0]->isCert != 1){
                        $supportingDocumentCrud->setFoldername("secondarySchoolTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 2){
                        $supportingDocumentCrud->setFoldername("upperSecondarySchoolTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 3){
                        $supportingDocumentCrud->setFoldername("foundationTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 4){
                        $supportingDocumentCrud->setFoldername("diplomaTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 5){
                        $supportingDocumentCrud->setFoldername("degreeTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 6){
                        $supportingDocumentCrud->setFoldername("masterTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 7){
                        $supportingDocumentCrud->setFoldername("phdTranscripts");
                    }else if($academicTranscripts[$i]->school_level_id == 8){
                        $supportingDocumentCrud->setFoldername("others");
                    }
                    $supportingDocumentCrud->setFolderpath(Crypt::decrypt($supportingDocument[0]->folderpath));
                    array_push($document_list,$supportingDocumentCrud);
                }
            }
            
        }
        return $document_list;
    }

    public function getPaymentSlip($id){
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);
        $paymentSlip = Payment::where('application_record_id',$APPLICATION_RECORD_ID->getDecryptedId())->get();
        $document_list = [];
        
        if ($paymentSlip->isNotEmpty()){
            $supportingDocumentCrud = new SupportingDocumentCrud();
            $supportingDocumentCrud->setFoldername("paymentSlip");
            $supportingDocumentCrud->setFilename(Crypt::decrypt($paymentSlip[0]->payment_slip));
            $supportingDocumentCrud->setFolderpath(Crypt::decrypt($paymentSlip[0]->folderpath));
            $supportingDocumentCrud->setApplicationrecordid($APPLICATION_RECORD_ID->getDecryptedId());
            array_push($document_list,$supportingDocumentCrud);
        }
        
        return $document_list;
    }

    public function removeSingleUserTemporaryFiles($applicationrecordid){
        //get all the temporary files based on profile id and application record id
        $temporary_file_list = TemporaryFile::where('application_record_id',$applicationrecordid)->get();
        //delete the tmp folders' pictures
        foreach($temporary_file_list as $temporary_file){
            if(Storage::disk('public')->exists('images/'.$temporary_file->folderdir.'/tmp/'.$temporary_file->folder)){
                // delete storage item
                Storage::deleteDirectory('/public/images/'.$temporary_file->folderdir.'/tmp/'.$temporary_file->folder);
            }

        }
        //delete the database entries
        $deleted_temporary_file = TemporaryFile::where('application_record_id',$applicationrecordid)->delete();
    }

    public function removeSingleUserTemporaryProfilePicture($applicantprofileid){
        $temporary_profile_picture = TemporaryFile::where('applicant_profile_id',$applicantprofileid)->get();
        if(count($temporary_profile_picture)>0){
            if(Storage::disk('public')->exists('images/'.$temporary_profile_picture[0]->folderdir.'/tmp/'.$temporary_profile_picture[0]->folder)){
                // delete storage item
                Storage::deleteDirectory('/public/images/'.$temporary_profile_picture[0]->folderdir.'/tmp/'.$temporary_profile_picture[0]->folder);
            }
        }
        
        $deleted_temporary_file = TemporaryFile::where('applicant_profile_id',$applicantprofileid)->delete();
    }
}
