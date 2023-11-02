<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\ApplicationRecord;
use App\Models\ApplicantStatusLog;
use Illuminate\Support\Facades\Crypt;
use App\Models\SupportingDocumentCrud;
use App\Models\ApplicantProfilePicture;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    /**
     * Remove the specified session data.
     *
     * This method removes the 'picture_file_name' and 'picture_folder' from the session.
     */
    public function removeSession()
    {
        Session::forget(['picture_file_name','picture_folder']);
    }

    /**
     * Show the profile picture view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Remove any existing session data
        $this->removeSession();
        
        // Instantiate the SupportingDocumentCrud class
        $supportingDocumentCrud = new SupportingDocumentCrud();

        // Retrieve the applicant status ID and applicant profile ID for the current user
        $get_applicant_status_id = 
            ApplicantStatusLog::select('applicant_profile_status_id', 'applicant_profile_id')->where('user_id', Auth::id())
                ->first();

        // Prepare the data to pass to the view
        $data = [
            'applicantStatusId' => $get_applicant_status_id,
        ];

        if($get_applicant_status_id)
        {
            if ($get_applicant_status_id->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_EMERGENCY_CONTACT')) 
            {
                // Remove the temporary profile picture for the current user's profile
                $supportingDocumentCrud->removeSingleUserTemporaryProfilePicture($get_applicant_status_id->applicant_profile_id);
                // Return the view with the data
                return view('oas.student.applicantProfile.profilePicture', compact('data'));
            }
        }

        return redirect()->route('stu.dashboard');
    }
    
    /**
     * Create a new profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Request $request)
    {
        // Check if the request method is not POST
        if (! $request->isMethod('post')) 
        {
            return redirect()->route('stu.dashboard');
        }
        // Retrieve the applicant status log for the current user
        $get_applicant_status_log = 
            ApplicantStatusLog::where('user_id',Auth::id())
                ->first();

        // Retrieve session data
        $get_picture_folder = Session::get('picture_folder');
        $get_picture_file_name = Session::get('picture_file_name');

        // Loop through the picture folders and file names
        for($i=0; $i < count($get_picture_folder); $i++) 
        {
            // Find the temporary file
            $get_temporary_file = TemporaryFile::where('folder',$get_picture_folder[$i])->where('file',$get_picture_file_name[$i])->first();

            // Check if the temporary file exists
            if($get_temporary_file){

                // Create a new applicant profile picture entry
                ApplicantProfilePicture::create([
                    'applicant_profile_id' => $get_applicant_status_log->applicant_profile_id,
                    'path' => Crypt::encrypt($get_picture_folder[$i].'/'. $get_picture_file_name[$i]),
                    'folderdir' => 'profile_picture',
                    'foldername' => Crypt::encrypt($get_picture_folder[$i]),
                ]);

                // Retrieve the temporary image
                $get_temporary_image = 
                    Storage::get('/public/images/profile_picture/tmp/'.$get_picture_folder[$i].'/'.$get_picture_file_name[$i]);

                // Store the temporary image in the new directory
                Storage::disk('c-drive')
                    ->put('/profile_picture/'.$get_picture_folder[$i].'/'.$get_picture_file_name[$i],$get_temporary_image);

                // Delete the temporary picture directory
                Storage::deleteDirectory('/public/images/profile_picture/tmp/'. $get_picture_folder[$i]);

                // Delete the temporary file
                $get_temporary_file->delete();
            }
        }

        // Remove any existing session data
        $this->removeSession();
        
        // Update the applicant profile status to complete the profile picture
        $get_applicant_status_log->applicant_profile_status_id = config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PROFILE_PICTURE');
        $get_applicant_status_log->save();

        // Redirect back to the previous page
        return redirect()->route('stu.dashboard');
    }

    /**
     * Show the form for editing the profile picture.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */

    public function edit()
    {

        // Retrieve the applicant profile status ID and applicant profile ID
        $get_applicant_profile_status_id_and_applicant_profile_id = 
            ApplicantStatusLog::select('applicant_profile_status_id', 'applicant_profile_id')
                ->where('user_id', Auth::id())
                ->first();

        if($get_applicant_profile_status_id_and_applicant_profile_id)
        {
            // Check if the applicant profile status is less than the required status for editing the profile picture
            if ($get_applicant_profile_status_id_and_applicant_profile_id->applicant_profile_status_id != config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PROFILE_PICTURE')) 
            {
                // Redirect to the student dashboard
                return redirect()->route('stu.dashboard');
            }       
        }
        else
        {
            // Redirect to the student dashboard
            return redirect()->route('stu.dashboard');
        }

        // Remove any existing session data
        $this->removeSession();
            
        // Instantiate the SupportingDocumentCrud class
        $supportingDocumentCrud = new SupportingDocumentCrud();

        // Remove the temporary profile picture for the current user's profile
        $supportingDocumentCrud->removeSingleUserTemporaryProfilePicture($get_applicant_profile_status_id_and_applicant_profile_id->applicant_profile_id);
        
        // Retrieve the applicant profile picture for the current user
        $get_applicant_profile_picture = 
            ApplicantProfilePicture::where('applicant_profile_id',$get_applicant_profile_status_id_and_applicant_profile_id->applicant_profile_id)
                ->first();

        // Get the image path for the profile picture
        $get_image_path = 
            'data:image/jpeg;base64,' . base64_encode(Storage::disk('c-drive')->get($get_applicant_profile_picture->folderdir.'/'.Crypt::decrypt($get_applicant_profile_picture->path)));

        // Prepare the data to be passed to the view
        $data =[
            'applicantProfilePicture' => $get_applicant_profile_picture,
            'imagePath' => $get_image_path,
        ]; 

        // Render the view for editing the profile picture
        return view('oas.student.applicantProfile.editProfilePicture', compact('data'));
    }

    /**
     * Update the profile pictures in database and storage
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        // Check if the request method is not POST
        if (! $request->isMethod('post')) 
        {
            return redirect()->route('stu.dashboard');
        }

        // Retrieve session data
        $get_picture_folder = Session::get('picture_folder');
        $get_picture_file_name = Session::get('picture_file_name');

        // Get the IDs from the request
        $get_applicant_profile_picture_id = $request->applicant_profile_picture_id;
        $get_applicant_profile_id = $request->applicant_profile_id;

        // Find the applicant profile picture by ID
        $get_applicant_profile_picture =
            ApplicantProfilePicture::find($get_applicant_profile_picture_id);

        // Loop through the picture folders and file names
        for($i=0; $i < count($get_picture_folder); $i++) 
        {
            // Find the temporary file
            $get_temporary_file = 
                TemporaryFile::where('folder',$get_picture_folder[$i])
                    ->where('file',$get_picture_file_name[$i])
                    ->first();
            
            // Check if the temporary file exists
            if($get_temporary_file)
            {
                // Decrypt the previous picture folder and path
                $get_previous_picture_foldername = 
                    Crypt::decrypt($get_applicant_profile_picture->foldername);
                $get_previous_picture_path = 
                    Crypt::decrypt($get_applicant_profile_picture->path);
                
                // Delete the previous picture directory
                Storage::disk('c-drive')
                    ->deleteDirectory('/profile_picture/'.$get_previous_picture_foldername);

                // Get the temporary picture path
                $temporary_picture_path = 
                    Storage::get('/public/images/profile_picture/tmp/'.$get_picture_folder[$i].'/'.$get_picture_file_name[$i]);

                // Update the picture folder and file name
                $get_applicant_profile_picture->path = Crypt::encrypt($get_picture_folder[$i].'/'.$get_picture_file_name[$i]);
                $get_applicant_profile_picture->foldername = Crypt::encrypt($get_picture_folder[$i]);

                // Save the changes to the applicant profile picture
                $get_applicant_profile_picture->save();

                // Store the temporary picture in the new directory
                Storage::disk('c-drive')
                    ->put('/profile_picture/'.$get_picture_folder[$i].'/'.$get_picture_file_name[$i],$temporary_picture_path);

                // Delete the temporary picture directory
                Storage::deleteDirectory('/public/images/profile_picture/tmp/'. $get_picture_folder[$i]);
                
                // Delete the temporary file
                $get_temporary_file->delete();

            }
        }

        // Remove session data
        $this->removeSession();

        // Redirect back to the previous page
        return back();
    }

    /**
     * Handle the temporary upload of a profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string  The folder name of the uploaded picture
     */

    public function TmpUpload(Request $request)
    {
        $folderName = '';

        // Check if the request has a file named 'picture'
        if($request->hasFile('picture'))
        {
            $picture = $request->file('picture');

            // Generate a unique file name for the picture
            $picture_file_name = 'picture_'.Auth::user()->name.'_'.date('YmdHii').'_'.$picture->getClientOriginalName();

            // Generate a unique folder name for the picture
            $picture_folder = uniqid('picture', true);

            // Store the picture file name and folder name in the session
            Session::push('picture_file_name', $picture_file_name);
            Session::push('picture_folder', $picture_folder);

            // Retrieve the applicant status log for the current user
            $applicant_status_log = ApplicantStatusLog::where('user_id',Auth::id())->first();

            // Store the picture in the temporary directory
            $picture->storeAs('/public/images/profile_picture/tmp/' . $picture_folder, $picture_file_name);

            // Create a new temporary file entry
            TemporaryFile::create([
                'folder' => $picture_folder,
                'file' => $picture_file_name,
                'folderdir' => 'profile_picture',
                'applicant_profile_id' => $applicant_status_log->applicant_profile_id,
                'application_record_id' => '',
            ]);

            // Set the folder name to be returned
            $folderName = $picture_folder;
        }
        return $folderName;
    }

    /**
     * Handle the deletion of a temporary profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string  The result of the deletion operation ('not found' or 'success')
     */

    public function TmpDelete(Request $request)
    {
        // Find the temporary file based on the provided folder name
        $pictureTmpFile = TemporaryFile::where('folder', $request->file)->first();

        $result = 'not found';

        // Check if the temporary file exists
        if($pictureTmpFile)
        {
            $picture_folderArr = array();
            $picture_file_nameArr = array();

            // Check if the picture folder is stored in the session
            if(Session::has('picture_folder'))
            {
                // Loop through the picture folders in the session
                for($i=0; $i < count(Session::get('picture_folder')); $i++)
                {
                    // Exclude the folder that matches the temporary file's folder
                    if(Session::get('picture_folder')[$i] != $pictureTmpFile->folder)
                    {
                        array_push($picture_folderArr, Session::get('picture_folder')[$i]);
                    }
                }

                // Loop through the picture file names in the session
                for($i=0; $i < count(Session::get('picture_file_name')); $i++)
                {
                    // Exclude the file name that matches the temporary file's file name
                    if(Session::get('picture_file_name')[$i] != $pictureTmpFile->file)
                    {
                        array_push($picture_file_nameArr, Session::get('picture_file_name')[$i]);
                    }
                }

                // Remove existing session data
                $this->removeSession();

                // Push the updated picture folders back to the session
                for($i=0; $i< sizeof($picture_folderArr); $i++)
                {
                    Session::push('picture_folder', $picture_folderArr[$i]);
                } 

                // Push the updated picture file names back to the session
                for($i=0; $i< sizeof($picture_file_nameArr); $i++){
                    Session::push('picture_file_name', $picture_file_nameArr[$i]);
                } 

                // Delete the temporary picture directory
                Storage::deleteDirectory('/public/images/profile_picture/tmp/'. $pictureTmpFile->folder);

                // Delete the temporary file entry
                $pictureTmpFile->delete();

                // Set the result to 'success'
                $result = 'success';
            }
        }
        
        return $result;
    }
}
