<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\ProgrammeRecord;
use App\Models\SemesterYearMapping;

class ProgrammeOfferController extends Controller
{
    /**
     * Display the index page.
     *
     * This function retrieves data from various database tables to be used in the view.
     * It fetches active programmes, all programmes, distinct semester-year mappings,
     * and programme offers. Based on the availability of different semester-year mappings,
     * it retrieves semester-year mappings accordingly. Finally, it renders the view,
     * passing the retrieved data to the view template.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function index()
    {
        // Initialize an array to store mapping results
        $mapping_results = array();

        // Fetch all active programmes with specific columns
        $get_all_active_programmes = 
            Programme::select('id','en_name','programme_level_id','programme_type_id')
                ->where('status', config('constants.STATUS.STATUS_ACTIVE')) // status active is 1
                ->get();

        // Fetch all programmes with specific columns
        $get_all_programmes = 
            Programme::select('id', 'en_name', 'programme_level_id', 'programme_type_id')
                ->get();

        // Fetch distinct semester-year mappings
        $get_different_semester_year_mappings = 
            ProgrammeRecord::select('semester_year_mapping_id')
                ->distinct()
                ->get();
        
        // Fetch all programme offers
        $get_programme_offers = 
            ProgrammeRecord::all();

        // Check if there are different semester-year mappings available
        if ($get_different_semester_year_mappings != null) 
        {
            // Iterate through the distinct semester-year mappings and store their IDs in the mapping_results array
            foreach ($get_different_semester_year_mappings as $item) {
                $mapping_results[] = $item->semester_year_mapping_id;
            }

            // Retrieve semester-year mappings that are not in the mapping_results array
            $semester_year_mappings = 
                SemesterYearMapping::whereNotIn('id', $mapping_results)
                    ->get();

            // Render the view, passing the retrieved data as compact variables
            return view('oas.admin.manageProgramme.addProgrammes', compact([
                'get_all_active_programmes',
                'get_all_programmes',
                'get_different_semester_year_mappings',
                'get_programme_offers',
                'semester_year_mappings',
            ]));        
        }

        // If no distinct semester-year mappings are available, fetch all semester-year mappings
        $semester_year_mappings = 
            SemesterYearMapping::all();

        // Render the view, passing the retrieved data as compact variables
        return view('oas.admin.manageProgramme.addProgrammes', compact([
            'get_all_active_programmes',
            'get_all_programmes',
            'get_different_semester_year_mappings',
            'get_programme_offers',
            'semester_year_mappings',
        ]));  
    }

    /**
     * Create new programme records.
     *
     * This function creates new programme records based on the selected programme IDs.
     * It retrieves the selected programme IDs from the request and iterates over each item.
     * For each item, a new ProgrammeRecord model is created with the specified semester year mapping ID and programme ID.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function create() 
    {
        $r = request();

        $get_all_selected_programme_items = $r->programme_id;

        foreach($get_all_selected_programme_items as $item)
        {

            ProgrammeRecord::create([
                'semester_year_mapping_id' => $r->semester_year_mapping_id,
                'programme_id' => $item,
            ]);

        }

        return back();
    }

    public function showList()
    {
        
        $get_all_offered_programme_lists = ProgrammeRecord::all();

        return view('oas.admin.manageProgramme.showProgrammeLists', compact('get_all_offered_programme_lists'));
    }

}
