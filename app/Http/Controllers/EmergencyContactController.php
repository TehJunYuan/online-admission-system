<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\EmergencyContact;
use App\Models\ApplicantStatusLog;
use App\Models\EmergencyContactList;
use App\Models\GuardianRelationship;

class EmergencyContactController extends Controller
{
    /**
     * Retrieve relationships and applicant status log
     * to populate the emergency contact view for the applicant.
     * 
     * @return \Illuminate\Contracts\View\View
     */

    public function index ()
    {
        // Retrieve all active nationalities
        $get_all_active_relationships = 
        GuardianRelationship::select('id', 'name')
            ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
            ->get();  
                
        $get_applicant_status_id = 
            ApplicantStatusLog::select('applicant_profile_status_id')->where('user_id', Auth::id())
                ->first();

        // Prepare the data to pass to the view
        $data = [
            'relationships' => $get_all_active_relationships,
            'applicantStatusId' => $get_applicant_status_id,
        ];

        if ($get_applicant_status_id)
        {
            if($get_applicant_status_id->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PARENT_GUARDIAN_PARTICULARS')) 
            {
                // Return the view with the data
                return view('oas.student.applicantProfile.emergencyContact', compact('data'));
            }
        }
        
        return redirect()->route('stu.dashboard');
    }

    /**
     * Create a new applicant profile.
     *
     * Handles the creation of a new applicant profile by saving user details and emergency contact information.
     * If the method is not accessed via a POST request, the user is redirected to the student dashboard.
     * After saving the necessary data, the applicant profile status is updated, and the user is redirected to the profile picture upload page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create()
    {
        $r = request();

        // Redirect to home page if accessed via direct URL call
        if (! $r->isMethod('post')) {
            return redirect()->route('stu.dashboard');
        }

        $applicant_status_log = 
            ApplicantStatusLog::where('user_id',Auth::id())
                ->first();

        // Save user details
        $user_detail_id1 = 
            UserDetail::insertGetId([
                'en_name' => ucwords($r->en_name1),
                'ch_name' => $r->ch_name1,
                'tel_hp' => $r->tel_hp1,
            ]);

        $user_detail_id2 = 
            UserDetail::insertGetId([
                'en_name' => ucwords($r->en_name2),
                'ch_name' => $r->ch_name2,
                'tel_hp' => $r->tel_hp2,
            ]);

        // Save emergency contacts
        $emergency_contact_id1 = 
            EmergencyContact::insertGetId([
                'guardian_relationship_id' => $r->guardian_relationship_id1,
                'user_detail_id' => $user_detail_id1,
            ]);

        $emergency_contact_id2 = 
            EmergencyContact::insertGetId([
                'guardian_relationship_id' => $r->guardian_relationship_id2,
                'user_detail_id' => $user_detail_id2,
            ]);

        // Create emergency contact list entries
        $emergency_contact_list1 = 
            EmergencyContactList::create([
                'applicant_profile_id' => $applicant_status_log->applicant_profile_id,
                'emergency_contact_id' => $emergency_contact_id1,
            ]);

        $emergency_contact_list2 = 
            EmergencyContactList::create([
                'applicant_profile_id' => $applicant_status_log->applicant_profile_id,
                'emergency_contact_id' => $emergency_contact_id2,
            ]);

        // Update applicant profile status
        $applicant_status_log->applicant_profile_status_id = config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_EMERGENCY_CONTACT');
        $applicant_status_log->save();

        return redirect()->route('profilePicture.home');
    }

    /**
     * Edit emergency contact information.
     *
     * Retrieves necessary data to edit the emergency contact information for the applicant profile.
     * Retrieves active guardian relationships, the applicant profile status and ID, emergency contact lists,
     * emergency contact IDs, emergency contact details, and user details.
     * The retrieved data is prepared and passed to the view for rendering.
     * If the applicant profile status is not at the required status for editing the profile picture,
     * the user is redirected to the student dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function edit()
    {
        // Retrieve all active nationalities
        $get_all_active_relationships = 
            GuardianRelationship::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  
                    
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

        $get_emergency_contact_lists = 
            EmergencyContactList::where('applicant_profile_id',$get_applicant_profile_status_id_and_applicant_profile_id->applicant_profile_id)
                ->get();
        
        $get_emergency_contact_id1 = 
            $get_emergency_contact_lists[0]->emergency_contact_id; // 0 - for first emergency contact

        $get_emergency_contact_id2 = 
            $get_emergency_contact_lists[1]->emergency_contact_id; // 1 - for second emergency contact

        $get_emergency_contact_1 = 
            EmergencyContact::where('id',$get_emergency_contact_id1)
                ->first();

        $get_emergency_contact2 = 
            EmergencyContact::where('id',$get_emergency_contact_id2)
                ->first();

        $get_user_detail_id1 = 
            $get_emergency_contact_1->user_detail_id;

        $get_user_detail_id2 = 
            $get_emergency_contact2->user_detail_id;

        $get_user_detail1 = 
            UserDetail::where('id',$get_user_detail_id1)
                ->first();
        $get_user_detail2 = 
            UserDetail::where('id',$get_user_detail_id2)
                ->first();

        // Prepare the data to pass to the view
        $data = [
            'relationships' => $get_all_active_relationships,
            'emergencyContact1' => $get_emergency_contact_1,
            'emergencyContact2' => $get_emergency_contact2,
            'userDetail1' => $get_user_detail1,
            'userDetail2' => $get_user_detail2,
        ];   

        return view('oas.student.applicantProfile.editEmergencyContact', compact('data'));
    }

    /**
     * Update emergency contact information.
     *
     * This method handles the updating of emergency contact information for the applicant profile.
     * If the method is not accessed via a POST request, the user is redirected to the home page.
     * The provided data is used to update the emergency contact and user detail records.
     * After saving the changes, the user is redirected back to the previous page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update()
    {
        $r = request();

        //if the user access this via direct url call, redirect back to home page
        if (! $r->isMethod('post')) {
            return redirect()->route('stu.dashboard');
        }

        $USER_DETAIL_ID1 = $r->user_detail_id1;
        $USER_DETAIL_ID2 = $r->user_detail_id2;
        $EMERGENCY_CONTACT_ID1 = $r->emergency_contact_id1;
        $EMERGENCY_CONTACT_ID2 = $r->emergency_contact_id2;

        $emergency_contact1 = EmergencyContact::find($EMERGENCY_CONTACT_ID1);
        $emergency_contact1->guardian_relationship_id = $r->guardian_relationship_id1;
        $emergency_contact1->user_detail_id = $USER_DETAIL_ID1;

        $emergency_contact2 = EmergencyContact::find($EMERGENCY_CONTACT_ID2);
        $emergency_contact2->guardian_relationship_id = $r->guardian_relationship_id2;
        $emergency_contact2->user_detail_id = $USER_DETAIL_ID2;

        $user_detail1 = UserDetail::find($USER_DETAIL_ID1);
        $user_detail1->en_name = ucwords($r->en_name1);
        $user_detail1->ch_name = $r->ch_name1;
        $user_detail1->tel_hp = $r->tel_hp1;

        $user_detail2 = UserDetail::find($USER_DETAIL_ID2);
        $user_detail2->en_name = ucwords($r->en_name2);
        $user_detail2->ch_name = $r->ch_name2;
        $user_detail2->tel_hp = $r->tel_hp2;

        $emergency_contact1->save();
        $user_detail1->save();
        $emergency_contact2->save();
        $user_detail2->save();
        
        return back();
    }
}
