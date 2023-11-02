<x-app-layout>
    @include('layouts.aaroNavigation')
    
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-12">
            {{-- header --}}
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/aaro/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <p class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-gray-400">{{ __('Offered Programme') }}</p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ __('Add programme') }}</span>
                    </div>
                </li>
                </ol>
            </nav>
            <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('Add Programme') }}</h2>
            <p class="text-gray-500 dark:text-gray-400">{{ __('If want to make any changes please contact CCO') }}</p>
            {{-- end header --}}
    
            {{-- form --}}
            <form action="{{ route('programmeOffered.add') }}" method="post">
                @csrf
                <div class="mt-8">
                    <label for="semester_year_mapping_id" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">{{ __('Select semester & year') }}</label>
                    <select name="semester_year_mapping_id" id="semester_year_mapping_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @foreach ($semester_year_mappings as $item)
                            <option value="{{ $item->id }}">Semester: {{ $item->semester['semester'] }}, Year: {{ $item->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container mx-auto mt-8">
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('PhD') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 1)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('Master') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 2)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('Bachelor') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 3)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('Diploma') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 4)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('Foundation') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 5)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('SITE') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 6)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <p class="text-lg font-medium text-gray-900 dark:text-gray-300">{{ __('SPACE') }}</p>
                    </div>
                    <div class="columns-1 md:columns-3 mb-4">
                        @foreach($get_all_active_programmes as $programme)
                            @if ($programme->programme_level_id == 7)
                                <div class="flex mb-4">
                                    <input checked id="checked-checkbox" type="checkbox" value="{{ $programme->id }}" id="programme[{{ $programme->id }}" name="programme_id[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $programme->en_name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="columns-1 md:columns-3 mb-2">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                    </div>
                </div>
            </form>
            {{-- end form --}}
        </div>
    </div>
</x-app-layout>