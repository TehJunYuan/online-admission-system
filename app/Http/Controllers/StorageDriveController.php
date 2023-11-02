<?php

namespace App\Http\Controllers;

use Image;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SupportingDocumentCrud;
use Illuminate\Support\Facades\Storage;

class StorageDriveController extends Controller
{
    //
    public function getImagesAttributesById($id){
        $supportingDocumentCrud = new SupportingDocumentCrud();
        $images_list = [];
        $identityDocuments = $supportingDocumentCrud->getSingleIdentityDocument($id);
        array_push($images_list,$identityDocuments);
        $supportingDocuments = $supportingDocumentCrud->getSingleApplicationSupportingDocument($id);
        array_push($images_list,$supportingDocuments);
        $paymentSlip = $supportingDocumentCrud->getPaymentSlip($id);
        array_push($images_list,$paymentSlip);
        return $images_list;
    }

    public function compileFilePath($document_list){
        $filepath_list = [];
        foreach($document_list as $document){
            $filepath = $document->getFoldername().'/'.$document->getFilename();
            array_push($filepath_list,$filepath);
        }
        return $filepath_list;
    }

    public function index($id){
        
        $images_list = $this->getImagesAttributesById($id);
        $display_image = [];
        foreach($images_list as $image_list){
            $filepath_list = $this->compileFilePath($image_list);
            foreach($filepath_list as $filename){
                $exists = Storage::disk('c-drive')->exists($filename);
                if($exists){
                    $content = Storage::disk('c-drive')->get($filename);
                    $image = 'data:image/jpeg;base64,' . base64_encode( $content);
                    array_push($display_image,$image);
                } 
            }
        }

        return view('oas.admin.supportingDocument.home',compact('display_image'));
    }
}
