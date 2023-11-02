<?php

namespace App\Http\Controllers;

use App\Mail\SubmitEmail;
use Illuminate\Support\Facades\Mail;
use DB;
use Auth;
use DateTime;
use App\Models\Race;
use App\Models\User;
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
use App\Models\CandidateProfile;
use App\Models\CmsApplicantDetail;
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

class DataFlowController extends Controller
{
    //
    /*
    |
    |-----------------------------------------------------------
    | Data flow mapping 
    | 'new country code' => 'old country code',
    | 
    |-----------------------------------------------------------
    |
    */

    /* this array performs mapping for the OAS's 
     * country code -> CMS's country code. The complete
     * listing is available at: ____ 
     * whereas the old CMS code aren't documented so one will
     * have to refer to the raw tables.
     */
    public $getOldCourseCode = [
        '1' => 'D1106',
        '2' => 'D1002',
        '3' => 'D1003',
        '4' => 'D1004',
        '5' => 'D1006',
        '6' => 'D1102',
        '7' => '',
        '8' => 'B1105',
        '9' => 'B1011',
        '10' => 'B1104',
        '11' => 'D3003',
        '12' => 'D3004',
        '13' => 'D6001',
        '14' => 'B3007',
        '15' => 'B6007',
        '16' => '',
        '18' => 'D8001',
        '19' => 'D8002',
        '20' => 'D8006',
        '21' => 'D8003',
        '22' => 'B8007',
        '23' => 'D5001',
        '24' => 'D4001',
        '25' => 'D9001',
        '26' => '',
        '28' => 'B5002',
        '29' => 'B4002',
        '30' => '',
        '31' => 'B9003',
        '32' => '',
        '33' => '',
        '34' => '',
        '35' => 'F5801',
        '36' => 'F7204',
        '37' => 'F7203',
        '38' => 'D5102',
        '39' => 'B1001',
        '40' => 'M1012',
        '41' => 'B8685',
        '42' => 'B1013',
        '43' => 'M5003',
        '44' => 'M4003',
        '45' => 'B5803',
        '46' => 'B5103',
        '47' => 'D8609',
        '48' => 'B5108',
        '49' => 'B5110',
        '50' => 'B5104',
        '51' => 'M9004',
        '52' => 'P1001',
        '53' => 'TE30001',
        '54' => 'TE30002',
        '55' => 'TE30103',
        '56' => 'EP8915',
        '57' => 'EP8911',
        '58' => 'EP8914',
        '59' => 'EP8912',
        '60' => 'EP8913',
        '61' => 'EP8909',
        '62' => 'EP89ED02',
        '63' => 'EP8903',
        '64' => 'EP8904',
        '65' => 'EP8908',
        '66' => 'EP8907',
        '67' => 'EP8916',
        '68' => 'EP8905',
        '69' => 'EP8906',
        '70' => 'EP8910',
        '71' => 'P5005',
        '72' => 'B8009',
        '73' => 'B1016',
        '74' => 'M3009',
        '75' => 'F7203',
        '76' => 'P1003',
        '77' => 'M3010',
        '78' => 'M9005',
        '79' => 'M1017',
        '80' => 'M5008',
        '81' => 'M5004',
        '82' => 'P5006',
        '83' => 'P1002',
        '84' => 'P1004',
    ];

    public  $getOldCountryCode = [
        '46' => '086',
        '217' => '886',
        '101' => '062',
        '207' => '082',
        '131' => '060',
        '200' => '065',
    ];

    public $getOldNationalityCode = [
        '46' => '086',
        '222' => '886',
        '101' => '062',
        '212' => '082',
        '131' => '060',
        '205' => '065',
        '167' => '0',
        '161' => '0',
    ];

    public $getOldRaceCode = [
        '1' => '01',
        '2' => '02',
        '3' => '03',
        '4' => '17',
    ];

    public $getOldReligionCode = [
        '1' => '04',
        '2' => '05',
        '3' => '01',
        '4' => '07',
        '6' => '03',
        '10' => '02',
        '11' => '08',
    ];

    public $getOldGenderCode = [
        '1' => 'M',
        '2' => 'F',
    ];

    public $getOldStudentCode = [
        '1' => 'LS',
        '2' => 'IS',
    ];

    public $getOldCourseLevel = [
        '1' => 'P',
        '2' => 'M',
        '3' => 'B',
        '4' => 'D',
        '5' => 'F',
        '6' => 'TE',
        '7' => 'S',
        '8' => 'QB',
    ];

    public $getOldMarital = [
        '1' => '2',
        '2' => '1',
    ];

    public $getOldState = [
        'Johor' => '01',
        'Kedah' => '07',
        'Kelantan' => '09',
        'Kuala Lumpur' => '14',
        'Melaka' => '02',
        'Negeri Sembilan' => '03',
        'Others' => '99',
        'Pahang' => '11',
        'Perak' => '05',
        'Perlis' => '08',
        'Pulau Pinang' => '06',
        'Sabah' => '13',
        'Sarawak' => '12',
        'Selangor' => '04',
        'Terengganu' => '10',
        'Wilayah Persekutuan' => '15',
    ];

    public $convertSemester = [
        '3' => 'A',
        '5/6' => 'B',
        '9/10' => 'C',
    ];

    public $convertIntakeBatch = [
        '3' => '1',
        '5/6' => '2',
        '9/10' => '3',
    ];

    // calculate age
    public function calAge($year){
        $dob = new DateTime($year);
        $now = new DateTime();
        $diff = $now->diff($dob);
        return $diff->y;
    }

    /**
     * Generates a temporary code based on the provided year.
     *
     * @param int|string $year The year for which the temporary code should be generated.
     * @return string The generated temporary code.
     */
    public function generateTemp($year){
        $defaultCode = 0;
        $formattedYear = substr($year,2);
        $getLatestTempCode = CmsApplicantDetail::where('tempCode','like',$formattedYear.'%')->latest()->first();
        $getLatestCMSTempCode = DB::connection('mysql2')->table('applicant')->where('tempCode','like',$formattedYear.'%')->orderBy('tempCode', 'DESC')->first();
        if($getLatestTempCode == null && $getLatestCMSTempCode == null)
        {
            $defaultCode++;
            return sprintf($formattedYear.'-%04d',$defaultCode);
        }
        $latestTempCode = $getLatestCMSTempCode->TempCode;
        $code = (int)substr($latestTempCode,4);
        $code++;
        return sprintf($formattedYear.'-%04d',$code);
    }

    public function checkExistingStudent($ic){
        $checkIc = DB::connection('mysql2')->table('person')->where('IC',$ic)->exists();
        if($checkIc == true){
            $getPersonCode = DB::connection('mysql2')->table('person')->where('IC',$ic)->first('PersonCode');
            $personCode = $getPersonCode->PersonCode;
            return $personCode;
        }
        return false;
    }

    public function index($id){
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();

        // get programme picked
        $getSelectedCourses = ProgrammePicked::where('application_record_id',$APPLICATION_RECORD_ID)->get();
        $getApplicantProfileId = ApplicationRecord::where('id',$APPLICATION_RECORD_ID)->first();
        $getUserRole = User::where('id',$getApplicantProfileId->user_id)->first();
        //personal particulars
        $applicantProfile = ApplicantProfile::where('id',$getApplicantProfileId->applicant_profile_id)->first();
        $userDetail = UserDetail::where('id',$applicantProfile->user_detail_id)->first();
        $age = $this->calAge($applicantProfile->birth_date);
        $getCorrespondenceAddressMapping = AddressMapping::where('user_detail_id',$userDetail->id)->where('address_type_id',config('constants.ADDRESS_TYPE.CORRESPONDENCE'))->first();
        $getCorrespondenceAddress = Address::where('id',$getCorrespondenceAddressMapping->address_id)->first();
        $getPermanentAddressMapping = AddressMapping::where('user_detail_id',$userDetail->id)->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))->first();
        $getPermanentAddress = Address::where('id',$getPermanentAddressMapping->address_id)->first();
        // parent guardian particulars
        $getApplicantGuardianList = ApplicantGuardianList::where('applicant_profile_id',$getApplicantProfileId->applicant_profile_id)->first();
        $getGuardianDetail = GuardianDetail::where('id',$getApplicantGuardianList->guardian_detail_id)->first();
        $getGuardianUserDetail = UserDetail::where('id',$getGuardianDetail->user_detail_id)->first();
        $getGuardianPermanentAddressMapping = AddressMapping::where('user_detail_id',$getGuardianDetail->user_detail_id)->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))->first();
        $getGuardianPermanentAddress = Address::where('id',$getGuardianPermanentAddressMapping->address_id)->first();
        // emergency contact
        $getEmergencyContactLists = EmergencyContactList::where('applicant_profile_id',$getApplicantProfileId->applicant_profile_id)->get();
        $getEmergencyContact1 = EmergencyContact::where('id',$getEmergencyContactLists[0]->emergency_contact_id)->first();
        $getEmergencyContact2 = EmergencyContact::where('id',$getEmergencyContactLists[1]->emergency_contact_id)->first();
        $getEmergencyContactUserDetail1 = UserDetail::where('id',$getEmergencyContact1->user_detail_id)->first();
        $getEmergencyContactUserDetail2 = UserDetail::where('id',$getEmergencyContact2->user_detail_id)->first();
        // academic record
        $getApplicationRecordSec = AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID)->where('school_level_id',config('constants.SCHOOL_LEVEL.SECONDARY'))->first();
        // status of health
        $getStatusOfHealth = StatusOfHealth::where('application_record_id',$APPLICATION_RECORD_ID)->get();
        // temp code 
        $tempCode = $this->generateTemp($getSelectedCourses[0]->programmeRecord['semesterYearMapping']->year);
        // 回流
        if($this->checkExistingStudent($userDetail->ic) != false){
            $personCode = $this->checkExistingStudent($userDetail->ic);
            $updatePerson = DB::connection('mysql2')->table('person')->where('PersonCode',$personCode)->update([
                'IC' => $userDetail->ic,
                'EnglishName' => ucwords($userDetail->en_name),
                'ChineseName' => $userDetail->ch_name,
                'Birthplace' => $applicantProfile->place_of_birth,
                'Gender' => $this->getOldGenderCode[$applicantProfile->gender_id],
                'BirthDate' => $applicantProfile->birth_date,
                'Birthplace' => $applicantProfile->place_of_birth,
                'Nationality' => $this->getOldNationalityCode[$applicantProfile->nationality_id],
                'CountryOfBirth' => $this->getOldNationalityCode[$applicantProfile->nationality_id],
                'Religion' => $this->getOldReligionCode[$applicantProfile->religion_id],
                'Race' => $this->getOldRaceCode[$applicantProfile->race_id],
                'ContactAddress1' => $getCorrespondenceAddress->street1,
                'ContactAddress2' => $getCorrespondenceAddress->street2,
                'ContactPostCode' => $getCorrespondenceAddress->zipcode,
                'ContactCity' => $getCorrespondenceAddress->city,
                'ContactState' => $this->getOldState[$getCorrespondenceAddress->state],
                'ContactCountry' => $this->getOldCountryCode[$getCorrespondenceAddress->country_id],
                'ContactTel' => ($userDetail->tel_h == null)? null: $userDetail->tel_h,
                'ContactHandPhone' => $userDetail->tel_hp,
                'ContactEmail' => $userDetail->email,
                'PermanentAddress1' => $getPermanentAddress->street1,
                'PermanentAddress2' => $getPermanentAddress->street2,
                'PermanentPostCode' => $getPermanentAddress->zipcode,
                'PermanentCity' => $getPermanentAddress->city,
                'PermanentState' => $this->getOldState[$getPermanentAddress->state],
                'PermanentCountry' => $this->getOldCountryCode[$getPermanentAddress->country_id],
                'MaritalStatus' =>  $this->getOldMarital[$applicantProfile->marital_id],
                'EmergencyEnglishName1' => ucwords($getEmergencyContactUserDetail1->en_name),
                'EmergencyRelationship1' => $getEmergencyContact1->guardianRelationship['name'],
                'EmergencyHandPhone1' => $getEmergencyContactUserDetail1->tel_hp,
                'EmergencyEnglishName2' => ucwords($getEmergencyContactUserDetail2->en_name),
                'EmergencyRelationship2' => $getEmergencyContact2->guardianRelationship['name'],
                'EmergencyHandPhone2' => $getEmergencyContactUserDetail2->tel_hp,
                'Mgename' => ucwords($getGuardianUserDetail->en_name),
                'Mgrelation' => $getGuardianDetail->guardianRelationship['name'],
                'Mgoccupation' => $getGuardianDetail->occupation,
                'Mgic' =>  $getGuardianUserDetail->ic,
                'Mgnationality' => $this->getOldNationalityCode[$getGuardianDetail->nationality_id],
                'Mgaddress1' => $getGuardianPermanentAddress->street1,
                'Mgaddress2' => $getGuardianPermanentAddress->street2,
                'Mgcode' => $getGuardianPermanentAddress->zipcode,
                'Mgtown' => $getGuardianPermanentAddress->city,
                'Mgstate' => $this->getOldState[$getGuardianPermanentAddress->state],
                'Mgcountry' => $this->getOldCountryCode[$getGuardianPermanentAddress->country_id],
                'Mghandphone' => $getGuardianUserDetail->tel_hp,
                'Mgemail' => ($getGuardianUserDetail->email == null)?null: $getGuardianUserDetail->email,
            ]);
            $createApplicant = DB::connection('mysql2')->table('applicant')->insert([
                'TempCode' => $tempCode,
                'PersonCode' => $personCode,
                'IntakeYear' => $getSelectedCourses[0]->programmeRecord['semesterYearMapping']->year,
                'IntakeBatch'=> $this->convertIntakeBatch[$getSelectedCourses[0]->programmeRecord['semesterYearMapping']->semester['semester']],
                'Choice1' => $this->getOldCourseCode[$getSelectedCourses[0]->programmeRecord['programme']->id],
                'Choice2' => $this->getOldCourseCode[$getSelectedCourses[1]->programmeRecord['programme']->id],
                'Choice3' => $this->getOldCourseCode[$getSelectedCourses[2]->programmeRecord['programme']->id],
                'CISBESRebate' => 'N',
                'FamilyLoyaltyRebate' => 'N',
                'OpenDayRebate' => 'N',
                'SITEOPENDAYRebate' => 'N',
                'FullPaymentRebate' => 'N',
            ]);
        }
        elseif($this->checkExistingStudent($userDetail->ic) == false)
        {
            $getNewPersonCode = DB::connection('mysql2')->table('person')->insertGetId([
                'IC' => $userDetail->ic,
                'EnglishName' => ucwords($userDetail->en_name),
                'ChineseName' => $userDetail->ch_name,
                'Birthplace' => $applicantProfile->place_of_birth,
                'Gender' => $this->getOldGenderCode[$applicantProfile->gender_id],
                'BirthDate' => $applicantProfile->birth_date,
                'Birthplace' => $applicantProfile->place_of_birth,
                'Nationality' => $this->getOldNationalityCode[$applicantProfile->nationality_id],
                'CountryOfBirth' => $this->getOldNationalityCode[$applicantProfile->nationality_id],
                'Religion' => $this->getOldReligionCode[$applicantProfile->religion_id],
                'Race' => $this->getOldRaceCode[$applicantProfile->race_id],
                'ContactAddress1' => $getCorrespondenceAddress->street1,
                'ContactAddress2' => $getCorrespondenceAddress->street2,
                'ContactPostCode' => $getCorrespondenceAddress->zipcode,
                'ContactCity' => $getCorrespondenceAddress->city,
                'ContactState' => $this->getOldState[$getCorrespondenceAddress->state],
                'ContactCountry' => $this->getOldCountryCode[$getCorrespondenceAddress->country_id],
                'ContactTel' => ($userDetail->tel_h == null)? null: $userDetail->tel_h,
                'ContactHandPhone' => $userDetail->tel_hp,
                'ContactEmail' => $userDetail->email,
                'PermanentAddress1' => $getPermanentAddress->street1,
                'PermanentAddress2' => $getPermanentAddress->street2,
                'PermanentPostCode' => $getPermanentAddress->zipcode,
                'PermanentCity' => $getPermanentAddress->city,
                'PermanentState' => $this->getOldState[$getPermanentAddress->state],
                'PermanentCountry' => $this->getOldCountryCode[$getPermanentAddress->country_id],
                'MaritalStatus' =>  $this->getOldMarital[$applicantProfile->marital_id],
                'EmergencyEnglishName1' => ucwords($getEmergencyContactUserDetail1->en_name),
                'EmergencyRelationship1' => $getEmergencyContact1->guardianRelationship['name'],
                'EmergencyHandPhone1' => $getEmergencyContactUserDetail1->tel_hp,
                'EmergencyEnglishName2' => ucwords($getEmergencyContactUserDetail2->en_name),
                'EmergencyRelationship2' => $getEmergencyContact2->guardianRelationship['name'],
                'EmergencyHandPhone2' => $getEmergencyContactUserDetail2->tel_hp,
                'Mgename' => ucwords($getGuardianUserDetail->en_name),
                'Mgrelation' => $getGuardianDetail->guardianRelationship['name'],
                'Mgoccupation' => $getGuardianDetail->occupation,
                'Mgic' =>  $getGuardianUserDetail->ic,
                'Mgnationality' => $this->getOldNationalityCode[$getGuardianDetail->nationality_id],
                'Mgaddress1' => $getGuardianPermanentAddress->street1,
                'Mgaddress2' => $getGuardianPermanentAddress->street2,
                'Mgcode' => $getGuardianPermanentAddress->zipcode,
                'Mgtown' => $getGuardianPermanentAddress->city,
                'Mgstate' => $this->getOldState[$getGuardianPermanentAddress->state],
                'Mgcountry' => $this->getOldCountryCode[$getGuardianPermanentAddress->country_id],
                'Mghandphone' => $getGuardianUserDetail->tel_hp,
                'Mgemail' => ($getGuardianUserDetail->email == null)?null: $getGuardianUserDetail->email,
            ]);
            $createApplicant = DB::connection('mysql2')->table('applicant')->insert([
                'TempCode' => $tempCode,
                'PersonCode' => $getNewPersonCode,
                'IntakeYear' => $getSelectedCourses[0]->programmeRecord['semesterYearMapping']->year,
                'IntakeBatch'=> $this->convertIntakeBatch[$getSelectedCourses[0]->programmeRecord['semesterYearMapping']->semester['semester']],
                'Choice1' => $this->getOldCourseCode[$getSelectedCourses[0]->programmeRecord['programme']->id],
                'Choice2' => $this->getOldCourseCode[$getSelectedCourses[1]->programmeRecord['programme']->id],
                'Choice3' => $this->getOldCourseCode[$getSelectedCourses[2]->programmeRecord['programme']->id],
                'CISBESRebate' => 'N',
                'FamilyLoyaltyRebate' => 'N',
                'OpenDayRebate' => 'N',
                'SITEOPENDAYRebate' => 'N',
                'FullPaymentRebate' => 'N',
            ]);
        }
        
        $get_cms_applicant_detail_id = CmsApplicantDetail::insertGetId([
            'application_record_id' => $APPLICATION_RECORD_ID,
            'tempCode' => $tempCode,
        ]);

        $data = [
            'subject' => 'New Application',
            'name' => 'Applicant Name : '.ucwords($userDetail->en_name)."",
            'ic' => 'IC : '.$userDetail->ic."",
            'tempCode' => $tempCode,
            'status' => 'Status : New Application',
        ];
        
        $sendEmail = array('cco@sc.edu.my');
        $ccEmail = array('cco@sc.edu.my','cco@sc.edu.my');

        //send email (you can change the email depends on the department needed)
        Mail::to($sendEmail)->cc($ccEmail)->send(new SubmitEmail($data));

        CandidateProfile::create([
            'user_id' => Auth::user()->id,
            'application_record_id' => $APPLICATION_RECORD_ID,
            'applicant_profile_id' => $getApplicantProfileId->applicant_profile_id,
            'cms_applicant_detail_id' => $get_cms_applicant_detail_id,
            'candidate_profile_status_id' => config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_SUBMIT_PAYMENT'),
        ]);
    }

    public function updateProfiel($id){
        $DECRYPTED_RECORD_ID = new DecryptId();
        $DECRYPTED_RECORD_ID->setDecryptedId($id);
        $APPLICATION_RECORD_ID = $DECRYPTED_RECORD_ID->getDecryptedId();
        // get programme picked
        $getSelectedCourses = ProgrammePicked::where('application_record_id',$APPLICATION_RECORD_ID)->get();
        $getApplicantProfileId = ApplicationRecord::where('id',$APPLICATION_RECORD_ID)->first();
        $getUserRole = User::where('id',$getApplicantProfileId->user_id)->first();
        //personal particulars
        $applicantProfile = ApplicantProfile::where('id',$getApplicantProfileId->applicant_profile_id)->first();
        $userDetail = UserDetail::where('id',$applicantProfile->user_detail_id)->first();
        $age = $this->calAge($applicantProfile->birth_date);
        $getCorrespondenceAddressMapping = AddressMapping::where('user_detail_id',$userDetail->id)->where('address_type_id',config('constants.ADDRESS_TYPE.CORRESPONDENCE'))->first();
        $getCorrespondenceAddress = Address::where('id',$getCorrespondenceAddressMapping->address_id)->first();
        $getPermanentAddressMapping = AddressMapping::where('user_detail_id',$userDetail->id)->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))->first();
        $getPermanentAddress = Address::where('id',$getPermanentAddressMapping->address_id)->first();
        // parent guardian particulars
        $getApplicantGuardianList = ApplicantGuardianList::where('applicant_profile_id',$getApplicantProfileId->applicant_profile_id)->first();
        $getGuardianDetail = GuardianDetail::where('id',$getApplicantGuardianList->guardian_detail_id)->first();
        $getGuardianUserDetail = UserDetail::where('id',$getGuardianDetail->user_detail_id)->first();
        $getGuardianPermanentAddressMapping = AddressMapping::where('user_detail_id',$getGuardianDetail->user_detail_id)->where('address_type_id',config('constants.ADDRESS_TYPE.PERMANENT'))->first();
        $getGuardianPermanentAddress = Address::where('id',$getGuardianPermanentAddressMapping->address_id)->first();
        // emergency contact
        $getEmergencyContactLists = EmergencyContactList::where('applicant_profile_id',$getApplicantProfileId->applicant_profile_id)->get();
        $getEmergencyContact1 = EmergencyContact::where('id',$getEmergencyContactLists[0]->emergency_contact_id)->first();
        $getEmergencyContact2 = EmergencyContact::where('id',$getEmergencyContactLists[1]->emergency_contact_id)->first();
        $getEmergencyContactUserDetail1 = UserDetail::where('id',$getEmergencyContact1->user_detail_id)->first();
        $getEmergencyContactUserDetail2 = UserDetail::where('id',$getEmergencyContact2->user_detail_id)->first();
        // academic record
        $getApplicationRecordSec = AcademicRecord::where('application_record_id',$APPLICATION_RECORD_ID)->where('school_level_id',config('constants.SCHOOL_LEVEL.SECONDARY'))->first();
        // status of health
        $getStatusOfHealth = StatusOfHealth::where('application_record_id',$APPLICATION_RECORD_ID)->get();
        // temp code 
        $tempCode = $this->generateTemp($getSelectedCourses[0]->programmeRecord['semesterYearMapping']->year);
        //update the data in old database
        $personCode = $this->checkExistingStudent($userDetail->ic);
        $updatePerson = DB::connection('mysql2')->table('person')->where('PersonCode',$personCode)->update([
            'IC' => $userDetail->ic,
            'EnglishName' => ucwords($userDetail->en_name),
            'ChineseName' => $userDetail->ch_name,
            'Birthplace' => $applicantProfile->place_of_birth,
            'Gender' => $this->getOldGenderCode[$applicantProfile->gender_id],
            'BirthDate' => $applicantProfile->birth_date,
            'Birthplace' => $applicantProfile->place_of_birth,
            'Nationality' => $this->getOldNationalityCode[$applicantProfile->nationality_id],
            'CountryOfBirth' => $this->getOldNationalityCode[$applicantProfile->nationality_id],
            'Religion' => $this->getOldReligionCode[$applicantProfile->religion_id],
            'Race' => $this->getOldRaceCode[$applicantProfile->race_id],
            'ContactAddress1' => $getCorrespondenceAddress->street1,
            'ContactAddress2' => $getCorrespondenceAddress->street2,
            'ContactPostCode' => $getCorrespondenceAddress->zipcode,
            'ContactCity' => $getCorrespondenceAddress->city,
            'ContactState' => $this->getOldState[$getCorrespondenceAddress->state],
            'ContactCountry' => $this->getOldCountryCode[$getCorrespondenceAddress->country_id],
            'ContactTel' => ($userDetail->tel_h == null)? null: $userDetail->tel_h,
            'ContactHandPhone' => $userDetail->tel_hp,
            'ContactEmail' => $userDetail->email,
            'PermanentAddress1' => $getPermanentAddress->street1,
            'PermanentAddress2' => $getPermanentAddress->street2,
            'PermanentPostCode' => $getPermanentAddress->zipcode,
            'PermanentCity' => $getPermanentAddress->city,
            'PermanentState' => $this->getOldState[$getPermanentAddress->state],
            'PermanentCountry' => $this->getOldCountryCode[$getPermanentAddress->country_id],
            'MaritalStatus' =>  $this->getOldMarital[$applicantProfile->marital_id],
            'EmergencyEnglishName1' => ucwords($getEmergencyContactUserDetail1->en_name),
            'EmergencyRelationship1' => $getEmergencyContact1->guardianRelationship['name'],
            'EmergencyHandPhone1' => $getEmergencyContactUserDetail1->tel_hp,
            'EmergencyEnglishName2' => ucwords($getEmergencyContactUserDetail2->en_name),
            'EmergencyRelationship2' => $getEmergencyContact2->guardianRelationship['name'],
            'EmergencyHandPhone2' => $getEmergencyContactUserDetail2->tel_hp,
            'Mgename' => ucwords($getGuardianUserDetail->en_name),
            'Mgrelation' => $getGuardianDetail->guardianRelationship['name'],
            'Mgoccupation' => $getGuardianDetail->occupation,
            'Mgic' =>  $getGuardianUserDetail->ic,
            'Mgnationality' => $this->getOldNationalityCode[$getGuardianDetail->nationality_id],
            'Mgaddress1' => $getGuardianPermanentAddress->street1,
            'Mgaddress2' => $getGuardianPermanentAddress->street2,
            'Mgcode' => $getGuardianPermanentAddress->zipcode,
            'Mgtown' => $getGuardianPermanentAddress->city,
            'Mgstate' => $this->getOldState[$getGuardianPermanentAddress->state],
            'Mgcountry' => $this->getOldCountryCode[$getGuardianPermanentAddress->country_id],
            'Mghandphone' => $getGuardianUserDetail->tel_hp,
            'Mgemail' => ($getGuardianUserDetail->email == null)?null: $getGuardianUserDetail->email,
        ]);

        $updateApplicant = DB::connection('mysql2')->table('applicant')->where('PersonCode',$personCode)->update([
            'TempCode' => $tempCode,
            'PersonCode' => $personCode,
            'IntakeYear' => $getSelectedCourses[0]->programmeRecord['semesterYearMapping']->year,
            'IntakeBatch'=> $this->convertIntakeBatch[$getSelectedCourses[0]->programmeRecord['semesterYearMapping']->semester['semester']],
            'Choice1' => $this->getOldCourseCode[$getSelectedCourses[0]->programmeRecord['programme']->id],
            'Choice2' => $this->getOldCourseCode[$getSelectedCourses[1]->programmeRecord['programme']->id],
            'Choice3' => $this->getOldCourseCode[$getSelectedCourses[2]->programmeRecord['programme']->id],
            'CISBESRebate' => 'N',
            'FamilyLoyaltyRebate' => 'N',
            'OpenDayRebate' => 'N',
            'SITEOPENDAYRebate' => 'N',
            'FullPaymentRebate' => 'N',
        ]);
    }
}
