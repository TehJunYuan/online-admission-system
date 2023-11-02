<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Race;
use App\Models\User;
use App\Models\Gender;
use App\Models\Address;
use App\Models\Country;
use App\Models\Marital;
use App\Models\Religion;
use App\Models\UserDetail;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\AddressMapping;
use App\Models\ApplicantProfile;
use App\Models\ApplicantStatusLog;

class PersonalProfileController extends Controller
{
    /**
     * Undefined variable
     */

    private $finalIC;

    /**
     * Retrieve active races, religions, nationalities, genders, maritals, and countries
     * to populate the personal profile view for the applicant.
     * 
     * @return \Illuminate\Contracts\View\View
     */

    public function index ()
    {
        // Retrieve all active races
        $get_all_active_races = 
            Race::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  
        
        // Retrieve all active religions
        $get_all_active_religions = 
            Religion::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  
        
        // Retrieve all active nationalities
        $get_all_active_nationalities = 
            Nationality::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  

        // Retrieve all active genders
        $get_all_active_genders = 
            Gender::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();         

        // Retrieve all active maritals
        $get_all_active_maritals = 
            Marital::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();   

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
            'races' => $get_all_active_races,
            'religions' => $get_all_active_religions,
            'nationalities' => $get_all_active_nationalities,
            'genders' => $get_all_active_genders,
            'maritals' => $get_all_active_maritals,
            'countries' => $get_all_active_countries,
            'applicantStatusId' => $get_applicant_status_id,
        ];
        
        if($get_applicant_status_id) 
        {
            if ($get_applicant_status_id->applicant_profile_status_id >= config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PERSONAL_PARTICULARS')) 
            {
                return redirect()->route('stu.dashboard');
            }
        }

        // Return the view with the data
        return view('oas.student.applicantProfile.personalProfile', compact('data'));
    }

    /**
     * Create a new personal profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create() 
    {
        $r = request();

        // If the user accesses this via direct URL call, redirect back to the student dashboard

        // Determine the final value of the IC (either the passport number or concatenated IC parts)
        if($r->passport == '')
        {
            $this->finalIC = $r->ic1.'-'.$r->ic2.'-'.$r->ic3;
        }
        else
        {
            $this->finalIC = $r->passport;
        }

        // Create a new user detail and retrieve the generated ID
        $user_detail_id = 
            UserDetail::insertGetId([
                'en_name' => ucwords($r->en_name),
                'ch_name' => $r->ch_name,
                'ic' => $this->finalIC,
                'email' => $r->email,
                'tel_h' => $r->tel_h,
                'tel_hp' => $r->tel_hp,
            ]);

        // Create a new applicant profile and retrieve the generated ID
        $applicant_profile_id = 
            ApplicantProfile::insertGetId([
                'birth_date' => $r->birth_date,
                'place_of_birth' => $r->place_of_birth,
                'gender_id' => $r->gender_id,
                'marital_id' => $r->marital_id,
                'race_id' => $r->race_id,
                'nationality_id' => $r->nationality_id,
                'religion_id' => $r->religion_id,
                'user_detail_id' => $user_detail_id,
            ]);

        // Create a new correspondence address and retrieve the generated ID
        $c_address_id = 
            Address::insertGetId([
                'street1' => $r->c_street1,
                'street2' => $r->c_street2,
                'zipcode' => $r->c_zipcode,
                'city' => $r->c_city,
                'state' => $r->c_state,
                'country_id' => $r->c_country_id,
            ]);

        // Create a new permanent address and retrieve the generated ID
        $p_address_id = 
            Address::insertGetId([
                'street1' => $r->p_street1,
                'street2' => $r->p_street2,
                'zipcode' => $r->p_zipcode,
                'city' => $r->p_city,
                'state' => $r->p_state,
                'country_id' => $r->p_country_id,
            ]);

        // Create a correspondence address mapping
        $c_address_mapping = 
            AddressMapping::create([
                'user_detail_id' => $user_detail_id,
                'address_id' => $c_address_id,
                'address_type_id' => config('constants.ADDRESS_TYPE.CORRESPONDENCE'),
            ]);

        
        // Create a permanent address mapping
        $p_address_mapping = 
            AddressMapping::create([        
                'user_detail_id' => $user_detail_id,
                'address_id' => $p_address_id,
                'address_type_id' => config('constants.ADDRESS_TYPE.PERMANENT'),
            ]);

        // Create a new applicant status log
        $applicant_status_log = 
            ApplicantStatusLog::create([
                'user_id' => Auth::id(),
                'applicant_profile_id' => $applicant_profile_id,
                'applicant_profile_status_id' => config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PERSONAL_PARTICULARS'),
            ]);

        // Redirect to the parent profile home page
        return redirect()->route('parentProfile.home');
    }

    /**
     * Edit the personal profile.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function edit()
    {
        $get_applicant_status_log = 
            ApplicantStatusLog::where('user_id',Auth::id())
                ->first();

        // If the applicant profile is not yet completed until the profile picture stage, redirect to the student dashboard
        if($get_applicant_status_log)
        {
            if ($get_applicant_status_log->applicant_profile_status_id != config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PROFILE_PICTURE')) 
            {
                return redirect()->route('stu.dashboard');
            }
        }
        else{
            return redirect()->route('stu.dashboard');
        }

        // Retrieve all active races
        $get_all_active_races = 
            Race::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  
        
        // Retrieve all active religions
        $get_all_active_religions = 
            Religion::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  
        
        // Retrieve all active nationalities
        $get_all_active_nationalities = 
            Nationality::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  

        // Retrieve all active genders
        $get_all_active_genders = 
            Gender::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();         

        // Retrieve all active maritals
        $get_all_active_maritals = 
            Marital::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();   

        // Retrieve all active countries
        $get_all_active_countries = 
            Country::select('id', 'name')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();  

        // get applicant profile
        $get_current_user_applicant_profile_id = $get_applicant_status_log->applicant_profile_id;
        $get_current_user_applicant_profile = 
            ApplicantProfile::where('id',$get_current_user_applicant_profile_id)
                ->first();

        // get user detail
        $get_current_user_detail_id = $get_current_user_applicant_profile->user_detail_id;
        $get_user_detail = UserDetail::where('id',$get_current_user_detail_id)->first();

        // Get the corresponding address mapping 
        $get_corresponding_address_mapping = 
            AddressMapping::where('user_detail_id',$get_current_user_detail_id)
                ->where('address_type_id',config('constants.ADDRESS_TYPE.CORRESPONDENCE'))
                ->first();

        // Get the permanent address mapping
        $get_permanent_address_mapping = 
            AddressMapping::where('user_detail_id',$get_current_user_detail_id)
                ->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))
                ->first();

        $get_corresponding_address_id = $get_corresponding_address_mapping->address_id;
        $get_permanent_address_id = $get_permanent_address_mapping->address_id;

        // Get the corresponding address
        $get_corresponding_address = 
            Address::where('id', $get_corresponding_address_id)
                ->first();
              
        // Get the permanent address
        $get_permanent_address = 
            Address::where('id', $get_permanent_address_id)
                ->first();

        // Prepare the data to pass to the view
        $data = [
            'races' => $get_all_active_races,
            'religions' => $get_all_active_religions,
            'nationalities' => $get_all_active_nationalities,
            'genders' => $get_all_active_genders,
            'maritals' => $get_all_active_maritals,
            'countries' => $get_all_active_countries,
            'applicantProfile' => $get_current_user_applicant_profile,
            'userDetail' => $get_user_detail,
            'cAddress' => $get_corresponding_address,
            'pAddress' => $get_permanent_address,
        ];

        return view('oas.student.applicantProfile.editPersonalProfile', compact('data'));
    }

    /**
     * Update the personal profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $r = request();

         // If the user accesses this via direct URL call, redirect back to the student dashboard
        if (! $r->isMethod('post')) 
        {
            return redirect()->route('stu.dashboard');
        }

        $get_user_detail_id = $r->user_detail_id;
        $get_applicant_profile_id = $r->applicant_profile_id;
        $get_corresponding_address_id = $r->c_address_id;
        $get_permanent_address_id = $r->p_address_id;

        // Determine the IC or passport value
        if($r->passport == '')
        {
            $this->finalIC = $r->ic1.'-'.$r->ic2.'-'.$r->ic3;
        }
        else
        {
            $this->finalIC = $r->passport;
        }

        // Update the user detail
        $user_detail = UserDetail::find($get_user_detail_id);
        $user_detail->en_name = ucwords($r->en_name);
        $user_detail->ch_name = $r->ch_name;
        $user_detail->ic = $this->finalIC;
        $user_detail->email = $r->email;
        $user_detail->tel_h =  $r->tel_h;
        $user_detail->tel_hp = $r->tel_hp;

         // Update the applicant profile
        $applicant_profile = ApplicantProfile::find($get_applicant_profile_id);
        $applicant_profile->birth_date = $r->birth_date;
        $applicant_profile->place_of_birth = $r->place_of_birth;
        $applicant_profile->gender_id = $r->gender_id;
        $applicant_profile->marital_id = $r->marital_id;
        $applicant_profile->race_id = $r->race_id;
        $applicant_profile->nationality_id = $r->nationality_id;
        $applicant_profile->religion_id = $r->religion_id;
        $applicant_profile->user_detail_id = $get_user_detail_id;

        // Update the corresponding address
        $c_address = Address::find($get_corresponding_address_id);
        $c_address->street1 = $r->c_street1;
        $c_address->street2 = $r->c_street2;
        $c_address->zipcode = $r->c_zipcode;
        $c_address->city = $r->c_city;
        $c_address->state = $r->c_state;
        $c_address->country_id = $r->c_country_id;

        // Update the permanent address
        $p_address = Address::find($get_permanent_address_id);
        $p_address->street1 = $r->p_street1;
        $p_address->street2 = $r->p_street2;
        $p_address->zipcode = $r->p_zipcode;
        $p_address->city = $r->p_city;
        $p_address->state = $r->p_state;
        $p_address->country_id = $r->p_country_id;

        // Save the updated records
        $user_detail->save();
        $applicant_profile->save();
        $c_address->save();
        $p_address->save();

        // Redirect back to the previous page
        return back();
    }

}
