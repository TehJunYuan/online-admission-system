<div class="mt-6">
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="semester_year_mapping_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('apply.semester_year') }} <span class="text-red-500">*</span></label>
            <select id="semester_year_mapping_id" name="semester_year_mapping_id" wire:model="selectedSemesterYearMappingId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option selected hidden>{{ __('Choose a semester and year') }}</option>
                @foreach ($semesterYearMappings as $semesterYearMapping)
                    <option value="{{ $semesterYearMapping->id }}">
                        {{ __('Intake: ') }}{{ $semesterYearMapping->semester['semester'] }} 
                        &nbsp;
                        {{ __('Year: ') }}{{ $semesterYearMapping->year }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="programme_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('apply.programme_level') }} <span class="text-red-500">*</span></label>
            <select id="programme_level" name="programme_level" wire:model="programmeLevelId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected hidden>{{ __('Choose a programme level') }}</option>
                <option value="1">{{ __('Postgraduate programme') }}</option>
                <option value="2">{{ __('Undergraduate programme') }}</option>
            </select>
        </div>
    </div>
    @if (!is_null($getOfferProgrammes))
        @if ($programmeLevelId == 1)
            {{-- postgraduate --}}
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="postgraduateProgramme1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select first priority programme') }} <span class="text-red-500">*</span></label>
                    <select name="postgraduate_programme_id[]" wire:model="postgraduateProgramme1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected>{{ __('Select programme') }}</option>
                        @foreach ($getOfferProgrammes->except([$postgraduateProgramme2, $postgraduateProgramme3]) as $programme)
                            @if ($programme->programme['programme_level_id'] <=2)
                                <option value="{{ $programme->id }}">{{ $programme->programme['en_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="postgraduateProgramme2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select second priority programme') }} <span class="text-red-500">*</span></label>
                    <select name="postgraduate_programme_id[]" wire:model="postgraduateProgramme2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected hidden>{{ __('Select programme') }}</option>
                        @foreach ($getOfferProgrammes->except([$postgraduateProgramme1, $postgraduateProgramme3]) as $programme)
                            @if ($programme->programme['programme_level_id'] <=2)
                                <option value="{{ $programme->id }}">{{ $programme->programme['en_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="postgraduateProgramme3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select third priority programme') }} <span class="text-red-500">*</span></label>
                    <select name="postgraduate_programme_id[]" wire:model="postgraduateProgramme3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected hidden>{{ __('Select programme') }}</option>
                        @foreach ($getOfferProgrammes->except([$postgraduateProgramme1, $postgraduateProgramme2]) as $programme)
                            @if ($programme->programme['programme_level_id'] <=2)
                                <option value="{{ $programme->id }}">{{ $programme->programme['en_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- end postgraduate --}}
        @elseif ($programmeLevelId == 2)   
            {{-- undergraduate --}}
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="undergraduateProgramme1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select first priority programme') }} <span class="text-red-500">*</span></label>
                    <select name="undergraduate_programme_id[]" id="undergraduateProgramme1" wire:model="undergraduateProgramme1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected>{{ __('Select programme') }}</option>
                        @foreach ($getOfferProgrammes->except([$undergraduateProgramme2, $undergraduateProgramme3]) as $programme)
                            @if ($programme->programme['programme_level_id'] >2)
                                <option value="{{ $programme->id }}">{{ $programme->programme['en_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="undergraduateProgramme2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select second priority programme') }} <span class="text-red-500">*</span></label>
                    <select name="undergraduate_programme_id[]" wire:model="undergraduateProgramme2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected hidden>{{ __('Select programme') }}</option>
                        @foreach ($getOfferProgrammes->except([$undergraduateProgramme1, $undergraduateProgramme3]) as $programme)
                            @if ($programme->programme['programme_level_id'] >2)
                                <option value="{{ $programme->id }}">{{ $programme->programme['en_name'] }}</option>                                            
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="undergraduateProgramme3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select third priority programme') }} <span class="text-red-500">*</span></label>
                    <select name="undergraduate_programme_id[]" wire:model="undergraduateProgramme3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option selected hidden>{{ __('Select programme') }}</option>
                        @foreach ($getOfferProgrammes->except([$undergraduateProgramme1, $undergraduateProgramme2]) as $programme)
                            @if ($programme->programme['programme_level_id'] >2)
                                <option value="{{ $programme->id }}">{{ $programme->programme['en_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- end undergraduate --}}
        @endif
    @endif
</div>