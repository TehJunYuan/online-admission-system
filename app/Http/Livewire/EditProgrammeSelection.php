<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SemesterYearMapping;
use App\Models\ProgrammeRecord;
use App\Models\ProgrammePicked;
use Illuminate\Support\Facades\Crypt;

class EditProgrammeSelection extends Component
{
    public $selectedSemesterYearMappingId = null;
    public $getOfferProgrammes = null;
    public $selectedProgramme = null;
    public $programmeLevelId = null;
    public $undergraduateProgramme1 = null;
    public $undergraduateProgramme2 = null;
    public $undergraduateProgramme3 = null;
    public $postgraduateProgramme1 = null;
    public $postgraduateProgramme2 = null;
    public $postgraduateProgramme3 = null;
    public $APPLICATION_RECORD_ID = null;
    public $getProgrammePicked = null;

    public function mount($APPLICATION_RECORD_ID){
        $this->APPLICATION_RECORD_ID = $APPLICATION_RECORD_ID;
        $this->getProgrammePicked = ProgrammePicked::where('application_record_id',$this->APPLICATION_RECORD_ID)->get();
        $this->selectedSemesterYearMappingId = $this->getProgrammePicked[0]->programmeRecord['semesterYearMapping']->id;
        $this->getOfferProgrammes = ProgrammeRecord::where('semester_year_mapping_id',$this->selectedSemesterYearMappingId)->get();
        if($this->getProgrammePicked[0]->programmeRecord['programme']->programme_level_id == 1 || $this->getProgrammePicked[0]->programmeRecord['programme']->programme_level_id == 2){
            $this->programmeLevelId = 1;
            $this->postgraduateProgramme1 = $this->getProgrammePicked[0]->programmeRecord->id;
            $this->postgraduateProgramme2 = $this->getProgrammePicked[1]->programmeRecord->id;
            $this->postgraduateProgramme3 = $this->getProgrammePicked[2]->programmeRecord->id;
        }elseif ($this->getProgrammePicked[0]->programmeRecord['programme']->programme_level_id == 3 || $this->getProgrammePicked[0]->programmeRecord['programme']->programme_level_id == 4 || $this->getProgrammePicked[0]->programmeRecord['programme']->programme_level_id == 5){
            $this->programmeLevelId = 2;
            $this->undergraduateProgramme1 = $this->getProgrammePicked[0]->programmeRecord->id;
            $this->undergraduateProgramme2 = $this->getProgrammePicked[1]->programmeRecord->id;
            $this->undergraduateProgramme3 = $this->getProgrammePicked[2]->programmeRecord->id;
        }

    }

    public function render()
    {
        return view('livewire.edit-programme-selection',[
            'semesterYearMappings' => SemesterYearMapping::where('year','>=',date('Y'))->get(),
            'getProgrammePicked' => ProgrammePicked::where('application_record_id',$this->APPLICATION_RECORD_ID)->get(),
        ]);
    }

    public function updatedSelectedSemesterYearMappingId($semester_year_mapping_id)
    {
        $this->getOfferProgrammes = ProgrammeRecord::where('semester_year_mapping_id',$semester_year_mapping_id)->get();
    }

    public function updatedProgrammeLevelId($programme_level_id)
    {
        $this->programmeLevelId =$programme_level_id;
    }
}
