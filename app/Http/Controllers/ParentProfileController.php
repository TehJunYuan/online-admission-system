<?php

namespace App\Http\Controllers;

use Auth;
// use App\Models\Income;
use App\Models\Address;
use App\Models\Country;
use App\Models\UserDetail;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\AddressMapping;
use App\Models\GuardianDetail;
use App\Models\ApplicantStatusLog;
use App\Models\GuardianRelationship;
use App\Models\ApplicantGuardianList;

class ParentProfileController extends Controller
{
    /**
     * Undefined variable
     */
    private $finalIC;

    /**
     * Retrieve active nationalities, relationships, incomes, countries and applicant profile status
     * to populate the parent profile view for the applicant.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index ()
    {
        // Retrieve all active nationalities
        $get_all_active_nationalities = 
            Nationality::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  

        // Retrieve all active relationships
        $get_all_active_relationships = 
        GuardianRelationship::select('id', 'name')
            ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
            ->get();  

        // Retrieve all active income range
        // $get_all_active_incomes = 
        // Income::select('id', 'range')
        //     ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
        //     ->get();  

        // Retrieve all active countries
        $get_all_active_countries = 
            Country::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();      
                
        $get_applicant_status_id = 
            ApplicantStatusLog::select('applicant_profile_status_id')->where('user_id', Auth::id())
                ->first();

        // Prepare the data to pass to the view
        $data = [
            'nationalities' => $get_all_active_nationalities,
            'countries' => $get_all_active_countries,
            'relationships' => $get_all_active_relationships,
            // 'incomes' => $get_all_active_incomes,
            'applicantStatusId' => $get_applicant_status_id,
        ];

        if ($get_applicant_status_id) 
        {
            if ($get_applicant_status_id->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PERSONAL_PARTICULARS')) 
            {
                // Return the view with the data
                return view('oas.student.applicantProfile.parentProfile', compact('data'));
            }
        }

        return redirect()->route('stu.dashboard');
    }

    public function create()
    {
        $r = request();

        //if the user access this via direct url call, redirect back to home page
        if (!$r->isMethod('post')) {
            return redirect()->route('stu.dashboard');
        }

        $applicant_status_log = 
            ApplicantStatusLog::where('user_id',Auth::id())
                ->first();

        if($r->passport == ''){
            $this->finalIC = $r->ic1.'-'.$r->ic2.'-'.$r->ic3;
        }else{
            $this->finalIC = $r->passport;
        }

        $user_detail_id = 
            UserDetail::insertGetId([
                'en_name' => ucwords($r->en_name),
                'ch_name' => $r->ch_name,
                'ic' => $this->finalIC,
                'email' => $r->email,
                'tel_hp' => $r->tel_hp,
            ]);

        $guardian_detail_id = 
            GuardianDetail::insertGetId([
                'occupation' => $r->occupation,
                // 'income_id' => $r->income_id,
                'income' => $r->income,
                'guardian_relationship_id' => $r->guardian_relationship_id,
                'nationality_id' => $r->nationality_id,
                'user_detail_id' => $user_detail_id,
            ]);

        $address_id = 
            Address::insertGetId([
                'street1' => $r->p_street1,
                'street2' => $r->p_street2,
                'zipcode' => $r->p_zipcode,
                'city' => $r->p_city,
                'state' => $r->p_state,
                'country_id' => $r->p_country_id,
            ]);

        $address_mapping = 
            AddressMapping::create([
                'user_detail_id' => $user_detail_id,
                'address_id' => $address_id,
                'address_type_id' => config('constants.ADDRESS_TYPE.PERMANENT'),
            ]);
        $applicant_guardian_list = 
            ApplicantGuardianList::create([
                'applicant_profile_id' => $applicant_status_log->applicant_profile_id,
                'guardian_detail_id' => $guardian_detail_id,
            ]);

        $applicant_status_log->applicant_profile_status_id = config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PARENT_GUARDIAN_PARTICULARS');

        $applicant_status_log->save();
        
        return redirect()->route('emergencyContact.home');
    }

    public function edit()
    {
        // Retrieve all active nationalities
        $get_all_active_nationalities = 
            Nationality::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  

        // Retrieve all active relationships
        $get_all_active_relationships = 
        GuardianRelationship::select('id', 'name')
            ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
            ->get();  

        // Retrieve all active income range
        // $get_all_active_incomes = 
        // Income::select('id', 'range')
        //     ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
        //     ->get();  

        // Retrieve all active countries
        $get_all_active_countries = 
            Country::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();      

        $get_current_user_applicant_status_log = 
            ApplicantStatusLog::where('user_id',Auth::id())
                ->first();

        // Check if the applicant profile status is less than the required status for editing the profile picture
        if($get_current_user_applicant_status_log) 
        {
            if ($get_current_user_applicant_status_log->applicant_profile_status_id != config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PROFILE_PICTURE')) 
            {
                // Redirect to the student dashboard
                return redirect()->route('stu.dashboard');
            }    
        }
        else{
            return redirect()->route('stu.dashboard');
        }

        $get_applicant_guardian_list = 
            ApplicantGuardianList::where('applicant_profile_id',$get_current_user_applicant_status_log->applicant_profile_id)
                ->first();

        $get_guardian_detail_id = $get_applicant_guardian_list->guardian_detail_id;

        $get_guardian_detail = 
            GuardianDetail::where('id',$get_guardian_detail_id)->first();

        $get_user_detail_id = $get_guardian_detail->user_detail_id;

        $get_user_detail = 
            UserDetail::where('id',$get_user_detail_id)
                ->first();

        // address
        $get_permanent_address_mapping = 
            AddressMapping::where('user_detail_id',$get_user_detail_id)
                ->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))
                ->first();

        $get_permanent_address_id = $get_permanent_address_mapping->address_id;

        $get_permanent_address = 
            Address::where('id', $get_permanent_address_id)
                ->first();
        
        // Prepare the data to pass to the view
        $data = [
            'nationalities' => $get_all_active_nationalities,
            'countries' => $get_all_active_countries,
            'relationships' => $get_all_active_relationships,
            // 'incomes' => $get_all_active_incomes,
            'pAddress' => $get_permanent_address,
            'guardianDetail' => $get_guardian_detail,
            'userDetail' => $get_user_detail,
        ];   

        return view('oas.student.applicantProfile.editParentProfile', compact('data'));
    }

    public function update() 
    {
        $r = request();
        
        //if the user access this via direct url call, redirect back to home page
        if (! $r->isMethod('post')) {
            return redirect()->route('stu.dashboard');
        }
        
        $USER_DETAIL_ID = $r->user_detail_id;
        $GUARDIAN_DETAIL_ID = $r->guardian_detail_id;
        $P_ADDRESS_ID = $r->p_address_id;
        
        if($r->passport == ''){
            $this->finalIC = $r->ic1.'-'.$r->ic2.'-'.$r->ic3;
        }else{
            $this->finalIC = $r->passport;
        }

        $user_detail = UserDetail::find($USER_DETAIL_ID);
        $user_detail->en_name = ucwords($r->en_name);
        $user_detail->ch_name = $r->ch_name;
        $user_detail->ic = $this->finalIC;
        $user_detail->email = $r->email;
        $user_detail->tel_hp = $r->tel_hp;

        $guardian_detail = GuardianDetail::find($GUARDIAN_DETAIL_ID);
        $guardian_detail->occupation = $r->occupation;
        // $guardian_detail->income_id = $r->income_id;
        $guardian_detail->income = $r->income;
        $guardian_detail->guardian_relationship_id = $r->guardian_relationship_id;
        $guardian_detail->nationality_id = $r->nationality_id;
        $guardian_detail->user_detail_id = $USER_DETAIL_ID;

        $p_address = Address::find($P_ADDRESS_ID);
        $p_address->street1 = $r->p_street1;
        $p_address->street2 = $r->p_street2;
        $p_address->zipcode = $r->p_zipcode;
        $p_address->city = $r->p_city;
        $p_address->state = $r->p_state;
        $p_address->country_id = $r->p_country_id;

        $user_detail->save();
        $guardian_detail->save();
        $p_address->save();
        
        return back();
    }
    
}
