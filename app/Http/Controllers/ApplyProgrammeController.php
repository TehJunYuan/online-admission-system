<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\DecryptId;
use Illuminate\Http\Request;
use App\Models\ProgrammePicked;
use App\Models\ProgrammeRecord;
use App\Models\ApplicationRecord;
use App\Models\ApplicantStatusLog;
use App\Models\SemesterYearMapping;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Crypt;

class ApplyProgrammeController extends Controller
{
    /*
    |-----------------------------------
    | Return update page via back button from academic detail
    |-----------------------------------
    */
    public function index($id)
    {
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);

        // $getApplicationStatusLog = ApplicationStatusLog::where('user_id',Auth::id())->latest()->first();
        $get_application_status_id = 
            ApplicationStatusLog::select('application_status_id')
                ->where('user_id',Auth::id())
                ->latest()
                ->first();

        $getSemesterYearMappings = SemesterYearMapping::where('year','>=',date('Y'))->get();

        $getOfferProgrammes = ProgrammeRecord::where('semester_year_mapping_id',$getSemesterYearMappings[0]->id)->get();
        //if the user comes from the edit page of academic details using back button
        if($get_application_status_id != null && $get_application_status_id->application_status_id >= config('constants.APPLICATION_STATUS_CODE.COMPLETE_PROGRAM_SELECTION'))
        {
            $APPLICATION_RECORD_ID = $id;
            return view('oas.student.programmeSelection.update', compact('getSemesterYearMappings','getOfferProgrammes','APPLICATION_RECORD_ID'));
        }
        else{
            return redirect()->route('stu.dashboard');
        }
    }

    public function newApplication(){

        // $getApplicantStatusLog = ApplicantStatusLog::where('user_id',Auth::id())->first();
        $get_applicant_status_id =
            ApplicantStatusLog::select('applicant_profile_status_id')
                ->where('user_id', Auth::id())
                ->first();
        
        // $getApplicationStatusLog = ApplicationStatusLog::where('user_id',Auth::id())->latest()->first();
        $get_application_status_id = 
            ApplicationStatusLog::select('application_status_id')
                ->where('user_id',Auth::id())
                ->latest()
                ->first();

        //if the user is new and this is the first application
        if ($get_application_status_id == null && $get_applicant_status_id->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PROFILE_PICTURE'))
        {
            $get_semester_year_mappings = 
                SemesterYearMapping::where('year','>=',date('Y'))
                    ->get();

            $get_offer_programmes = 
                ProgrammeRecord::where('semester_year_mapping_id',$get_semester_year_mappings[0]->id)
                    ->get();


            return view('oas.student.programmeSelection.home', 
                compact([
                    'get_semester_year_mappings',
                    'get_offer_programmes'
                ])
            );
        }
        //if the user has more than one applications, but all of them are completed payment slip and we allow them to open more applications
        // TODO: change the status, after complete verified payment then allow them to open more applications
        else if ($get_application_status_id != null && $get_application_status_id->application_status_id >= config('constants.APPLICATION_STATUS_CODE.COMPLETE_PAYMENT'))
        {
            $get_semester_year_mappings = 
                SemesterYearMapping::where('year','>=',date('Y'))
                    ->get();

            $get_offer_programmes = 
                ProgrammeRecord::where('semester_year_mapping_id',$get_semester_year_mappings[0]->id)
                    ->get();

            return view('oas.student.programmeSelection.home', 
                compact([
                    'get_semester_year_mappings',
                    'get_offer_programmes'
                ])
            );
        }
        //if the user's latest application is not completed yet
        else if ($get_application_status_id != null && $get_application_status_id->application_status_id < config('constants.APPLICATION_STATUS_CODE.COMPLETE_PAYMENT'))
        {
            Session::flash('error', 'Please complete your previous application first.');
            return back();
        }
    }
    /*
    |-----------------------------------
    | Create function
    |-----------------------------------
    */
    public function create()
    {
        $r = request();

        //if the user access this via direct url call, redirect back to home page
        if (! $r->isMethod('post')) 
        {
            return redirect()->route('stu.dashboard');
        }

        $get_applicant_profile_id =
            ApplicantStatusLog::select('applicant_profile_id')
                ->where('user_id', Auth::id())
                ->first();
        
        $get_user_applicant_profile_id = $get_applicant_profile_id->applicant_profile_id;

        $arr_choice_priorities = 
            array(
                config('constants.CHOICE_PRIORITY.FIRST_CHOICE'),
                config('constants.CHOICE_PRIORITY.SECOND_CHOICE'),
                config('constants.CHOICE_PRIORITY.THIRD_CHOICE')
            );

        $get_current_date_time = DB::raw('CURRENT_TIMESTAMP');
        
        $get_all_postgraduate_programme_id = $r->postgraduate_programme_id;
        $get_all_undergraduate_programme_id = $r->undergraduate_programme_id;

        $get_new_application_record_id =
            ApplicationRecord::insertGetId([
                'user_id' => Auth::id(),
                'applicant_profile_id' => $get_user_applicant_profile_id,
                'created_at' => $get_current_date_time,
                'updated_at' => $get_current_date_time,
            ]);

        if ($get_all_undergraduate_programme_id == null) 
        {
            for ($i=0; $i < sizeof($arr_choice_priorities); $i++) { 
                ProgrammePicked::create([
                    'application_record_id' => $get_new_application_record_id,
                    'programme_record_id' => $get_all_postgraduate_programme_id[$i],
                    'choice_priority_id' => $arr_choice_priorities[$i],
                ]);
            }
        }
        else if ($get_all_postgraduate_programme_id == null)
        {
            for ($i=0; $i < sizeof($arr_choice_priorities); $i++) { 
                ProgrammePicked::create([
                    'application_record_id' => $get_new_application_record_id,
                    'programme_record_id' => $get_all_undergraduate_programme_id[$i],
                    'choice_priority_id' => $arr_choice_priorities[$i],
                ]);
            }
        }

        $create_new_application_status_log =
            ApplicationStatusLog::create([
                'user_id' => Auth::id(),
                'application_record_id' => $get_new_application_record_id,
                'application_status_id' => config('constants.APPLICATION_STATUS_CODE.COMPLETE_PROGRAM_SELECTION'),
            ]);
        
        return redirect()->route('academicDetail.home',['id'=> Crypt::encrypt($get_new_application_record_id)]);
    }

    /*
    |-----------------------------------
    | Update function
    |-----------------------------------
    */
    
    public function update($id){
        $r = request();
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);

        $choicePriorities = array(config('constants.CHOICE_PRIORITY.FIRST_CHOICE'),config('constants.CHOICE_PRIORITY.SECOND_CHOICE'),config('constants.CHOICE_PRIORITY.THIRD_CHOICE'));
        $getProgrammePicked = ProgrammePicked::where('application_record_id',$APPLICATION_RECORD_ID->getDecryptedId())->get();
        $getAllPostgraduateProgrammeId = $r->postgraduate_programme_id;
        $getAllUndergraduateProgrammeId = $r->undergraduate_programme_id;
        if($getAllUndergraduateProgrammeId == null){
            for($i=0; $i<sizeof($choicePriorities); $i++){
                $getProgrammePicked[$i]->programme_record_id = $getAllPostgraduateProgrammeId[$i];
                $getProgrammePicked[$i]->choice_priority_id = $choicePriorities[$i];
                $getProgrammePicked[$i]->save();
            }
        }elseif($getAllPostgraduateProgrammeId == null){
            for($i=0; $i<sizeof($choicePriorities); $i++){
                $getProgrammePicked[$i]->programme_record_id = $getAllUndergraduateProgrammeId[$i];
                $getProgrammePicked[$i]->choice_priority_id = $choicePriorities[$i];
                $getProgrammePicked[$i]->save();
            }
        }
        return back();
    }

    public function quickUpdate($id){
        $r = request();
        $APPLICATION_RECORD_ID = new DecryptId();
        $APPLICATION_RECORD_ID->setDecryptedId($id);

        $choicePriorities = array(config('constants.CHOICE_PRIORITY.FIRST_CHOICE'),config('constants.CHOICE_PRIORITY.SECOND_CHOICE'),config('constants.CHOICE_PRIORITY.THIRD_CHOICE'));
        $getProgrammePicked = ProgrammePicked::where('application_record_id',$APPLICATION_RECORD_ID->getDecryptedId())->get();
        $getAllPostgraduateProgrammeId = $r->postgraduate_programme_id;
        $getAllUndergraduateProgrammeId = $r->undergraduate_programme_id;
        if($getAllUndergraduateProgrammeId == null){
            for($i=0; $i<sizeof($choicePriorities); $i++){
                $getProgrammePicked[$i]->programme_record_id = $getAllPostgraduateProgrammeId[$i];
                $getProgrammePicked[$i]->choice_priority_id = $choicePriorities[$i];
                $getProgrammePicked[$i]->save();
            }
        }elseif($getAllPostgraduateProgrammeId == null){
            for($i=0; $i<sizeof($choicePriorities); $i++){
                $getProgrammePicked[$i]->programme_record_id = $getAllUndergraduateProgrammeId[$i];
                $getProgrammePicked[$i]->choice_priority_id = $choicePriorities[$i];
                $getProgrammePicked[$i]->save();
            }
        }
        return redirect()->route('academicDetail.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID->getDecryptedId())]);
    }
}
