<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Race;
use App\Models\Gender;
use App\Models\Income;
use App\Models\Address;
use App\Models\Country;
use App\Models\Disease;
use App\Models\Marital;
use App\Models\Religion;
use App\Models\Semester;
use App\Models\DecryptId;
use App\Models\Programme;
use App\Models\UserDetail;
use App\Models\Nationality;
use App\Models\SchoolLevel;
use Illuminate\Http\Request;
use App\Models\AcademicRecord;
use App\Models\AddressMapping;
use App\Models\GuardianDetail;
use App\Models\ProgrammeLevel;
use App\Models\StatusOfHealth;
use App\Models\ProgrammePicked;
use App\Models\ProgrammeRecord;
use App\Models\ApplicantProfile;
use App\Models\EmergencyContact;
use App\Models\ApplicationRecord;
use App\Models\ApplicantStatusLog;
use App\Models\SemesterYearMapping;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatusLog;
use App\Models\EmergencyContactList;
use App\Models\GuardianRelationship;
use App\Models\ApplicantGuardianList;
use Illuminate\Support\Facades\Crypt;
use App\Models\ApplicantProfilePicture;
use Illuminate\Support\Facades\Storage;

class DraftController extends Controller
{
    //
    public function index($id)
    {
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();
        
        session(['key'=>$APPLICATION_RECORD_ID]);

        //
        $getRelationships = GuardianRelationship::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getReligions = Religion::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getNationalities = Nationality::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        // $getIncomes = Income::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getCountries = Country::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getRaces = Race::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getGenders = Gender::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getMaritals = Marital::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getDiseases = Disease::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        $getSchoolLevels = SchoolLevel::where('status',config('constants.STATUS.STATUS_ACTIVE'))->get();
        // Applicant status log
        $getApplicantStatusLog = ApplicantStatusLog::where('user_id',Auth::id())->first();
        // Application status log
        $getApplicationStatusLog = ApplicationStatusLog::where('user_id', Auth::id())->where('application_record_id',$APPLICATION_RECORD_ID)->first();
        //programme selection
        $getSelectedCourses = ProgrammePicked::where('application_record_id',$APPLICATION_RECORD_ID)->get();
        // personal particulars
        $applicantProfile = ApplicantProfile::where('id',$getApplicantStatusLog->applicant_profile_id)->first();
        $userDetail = UserDetail::where('id',$applicantProfile->user_detail_id)->first();
        $getCorrespondenceAddressMapping = AddressMapping::where('user_detail_id',$userDetail->id)->where('address_type_id',config('constants.ADDRESS_TYPE.CORRESPONDENCE'))->first();
        $getCorrespondenceAddress = Address::where('id',$getCorrespondenceAddressMapping->address_id)->first();
        $getPermanentAddressMapping = AddressMapping::where('user_detail_id',$userDetail->id)->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))->first();
        $getPermanentAddress = Address::where('id',$getPermanentAddressMapping->address_id)->first();
        // parent/guardian particulars
        $getApplicantGuardianList = ApplicantGuardianList::where('applicant_profile_id',$getApplicantStatusLog->applicant_profile_id)->first();
        $getGuardianDetail = GuardianDetail::where('id',$getApplicantGuardianList->guardian_detail_id)->first();
        $getGuardianUserDetail = UserDetail::where('id',$getGuardianDetail->user_detail_id)->first();
        $getGuardianPermanentAddressMapping = AddressMapping::where('user_detail_id',$getGuardianDetail->user_detail_id)->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))->first();
        $getGuardianPermanentAddress = Address::where('id',$getGuardianPermanentAddressMapping->address_id)->first();
        //emergency contact
        $getEmergencyContactLists = EmergencyContactList::where('applicant_profile_id',$getApplicantStatusLog->applicant_profile_id)->get();
        $getEmergencyContact1 = EmergencyContact::where('id',$getEmergencyContactLists[0]->emergency_contact_id)->first();
        $getEmergencyContact2 = EmergencyContact::where('id',$getEmergencyContactLists[1]->emergency_contact_id)->first();
        $getEmergencyContactUserDetail1 = UserDetail::where('id',$getEmergencyContact1->user_detail_id)->first();
        $getEmergencyContactUserDetail2 = UserDetail::where('id',$getEmergencyContact2->user_detail_id)->first();
        //profile picture
        $applicant_profile_picture = ApplicantProfilePicture::where('applicant_profile_id',$getApplicantStatusLog->applicant_profile_id)->first();
        $profileimage = 'data:image/jpeg;base64,' . base64_encode(Storage::disk('c-drive')->get($applicant_profile_picture->folderdir.'/'.Crypt::decrypt($applicant_profile_picture->path)));
        //academic record
        $getAllAcademicRecord = AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID)->get();
        $getAcademicRecord = AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID)->where('status',1)->get();
        // status of health
        $getStatusOfHealth = StatusOfHealth::where('application_record_id',$APPLICATION_RECORD_ID)->get();

        $data = [
            'getApplicationStatusLog' =>$getApplicationStatusLog,
            'getApplicantStatusLog' => $getApplicantStatusLog,
            'getRaces' => $getRaces,
            'getReligions' => $getReligions,
            'getRelationships' => $getRelationships,
            'getNationalities' => $getNationalities,
            'getGenders' => $getGenders,
            'getMaritals' => $getMaritals,
            // 'getIncomes' => $getIncomes,
            'getCountries' => $getCountries,
            'getDiseases' => $getDiseases,
            'getSchoolLevels' => $getSchoolLevels,
            'getSelectedCourses' => $getSelectedCourses,
            'getAllAcademicRecord' => $getAllAcademicRecord,
            'applicant_profile' => $applicantProfile,
            'user_detail' => $userDetail,
            'c_address' => $getCorrespondenceAddress,
            'p_address' => $getPermanentAddress,
            'guardian_detail' => $getGuardianDetail,
            'guardian_user_detail' => $getGuardianUserDetail,
            'pg_p_address' => $getGuardianPermanentAddress,
            'emergency_contact1' => $getEmergencyContact1,
            'emergency_contact2' => $getEmergencyContact2,
            'emergency_contact_user_detail1' => $getEmergencyContactUserDetail1,
            'emergency_contact_user_detail2' => $getEmergencyContactUserDetail2,
            'profile_picture' => $applicant_profile_picture,
            'academic_record' => $getAcademicRecord,
            'status_of_health' => $getStatusOfHealth,
            'profile_image' => $profileimage,
        ];
        if($getApplicationStatusLog->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_AGREEMENT') || $getApplicationStatusLog->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_DRAFT')){
            return view('oas.student.draft.home', compact('data','APPLICATION_RECORD_ID'));
        }
        return redirect()->route('stu.dashboard');
        
    }

    public function create($id){
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();
        $r = request();
        //if the user access this via direct url call, redirect back to home page
        if (! $r->isMethod('post')) {
            return redirect()->route('stu.dashboard');
        }
        
        
        $getApplicationStatusLog = ApplicationStatusLog::where('user_id', Auth::id())->where('application_record_id',$APPLICATION_RECORD_ID)->first();
        //if user comes from back button of supporting document
        if($getApplicationStatusLog->application_status_id >= config('constants.APPLICATION_STATUS_CODE.COMPLETE_DRAFT')){
            return redirect()->route('supportingDocument.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]);
        }
        //if user somehow travelled to here without agreement
        else if($getApplicationStatusLog->application_status_id != config('constants.APPLICATION_STATUS_CODE.COMPLETE_AGREEMENT')){
            return redirect()->route('stu.dashboard');
        }
        //if user come after agreement
        $getApplicationStatusLog->application_status_id = config('constants.APPLICATION_STATUS_CODE.COMPLETE_DRAFT');
        $getApplicationStatusLog->save();
        
        return redirect()->route('supportingDocument.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]);
    }
}
