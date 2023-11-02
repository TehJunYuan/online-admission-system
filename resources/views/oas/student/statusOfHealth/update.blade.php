<x-app-layout>
    <div class="p-4 sm:ml-64">
       <div class="p-4 mt-12">
            {{-- header --}}
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('stu.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-400 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <p class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-400">
                        {{ __('stepper.apply_programme') }}
                    </p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-white">{{ __('stepper.apply_edit_step_3') }}</span>
                    </div>
                </li>
                </ol>
            </nav>
            <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('stepper.apply_edit_step_3') }}</h2>
            {{-- end header --}}
            {{-- stepper --}}
            <ol class="flex flex-wrap items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4">
                <li class="flex items-center my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        1
                    </span>
                    {{ __('stepper.apply_step_1') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </li>
                <li class="flex items-center my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        2
                    </span>
                    {{ __('stepper.apply_step_2') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </li>
                <li class="flex items-center text-blue-600 dark:text-blue-500 my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                        3
                    </span>
                    {{ __('stepper.apply_step_3') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </li>
                <li class="flex items-center my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        4
                    </span>
                    {{ __('stepper.apply_step_4') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </li>
                <li class="flex items-center my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        5
                    </span>
                    {{ __('stepper.apply_step_5') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </li>
                <li class="flex items-center my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        6
                    </span>
                    {{ __('stepper.apply_step_6') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </li>
                <li class="flex items-center my-1">
                    <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        7
                    </span>
                    {{ __('stepper.apply_step_7') }}
                </li>
            </ol>
            {{-- end stepper --}}

            {{-- form --}}
            <form action="{{route('statusOfHealth.update',['id' => Crypt::encrypt($APPLICATION_RECORD_ID)])}}" method="post" class="mt-6" enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-3 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="my-0.5">{{ __('apply.disease') }}</div>
                    <div class="my-0.5">{{ __('apply.status') }}</div>
                    <div class="my-0.5">{{ __('apply.remark') }}</div>
                </div>
                @for ($i = 0; $i < count($data['activeDisease']); $i++)  
                    <div class="grid md:grid-cols-3 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
                        <div class="text-gray-500 dark:text-gray-400">{{ $data['activeDisease'][$i]->name }}</div>
                        <input type="hidden" name="disease_id[]" value="{{ $data['activeDisease'][$i]->id }}">
                        <div class="my-1">
                            <select name="disease_status[]" id="disease_status[{{ $data['activeDisease'][$i]->id }}]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="setRequired(this,'disease_remark[{{ $data['activeDisease'][$i]->id }}]')">
                                @if ($data['statusOfHealth'][$i]->disease_status == 0)
                                <option value="0" selected>{{ __('No, I don\'t have') }}</option>
                                <option value="1">{{ __('Yes') }}</option>
                                @else
                                <option value="1" selected>{{ __('Yes') }}</option>
                                <option value="0">{{ __('No, I don\'t have') }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="my-1">
                            @if ($data['statusOfHealth'][$i]->disease_remark == null)
                                <textarea name="disease_remark[]" id="disease_remark[{{ $data['activeDisease'][$i]->id }}]" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                            @else 
                                <textarea name="disease_remark[]" id="disease_remark[{{ $data['activeDisease'][$i]->id }}]" value="{{ $data['statusOfHealth'][$i]->disease_remark }}" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $data['statusOfHealth'][$i]->disease_remark }}</textarea>
                            @endif
                        </div>
                    </div>
                @endfor
                <div class="mt-6">
                    <a href="{{ route('academicDetail.home',['id'=>Crypt::encrypt($APPLICATION_RECORD_ID)]) }}" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">{{ __('button.back') }}</a>
                    <button type="submit" class="mr-2 mb-2 mt-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('button.save') }}</button>
                    <a href="{{ route('agreements.home',['id'=> Crypt::encrypt($APPLICATION_RECORD_ID)]) }}" class="mr-2 mb-2 mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.next') }}</a>
                </div>
            </form>
            {{-- end form --}}
       </div>
    </div>
    {{-- Prevent Back Button --}}
    <script type="text/javascript">
        window.history.forward();

        function noBack() 
        {
            window.history.forward();
        }

        // 1 = no, 2 = yes 
        // refer to dropdown above
        function setRequired(select, remark_id)
        {
            (select.value == 1)?document.getElementById(remark_id).setAttribute('required',''):document.getElementById(remark_id).removeAttribute('required');
        }
    </script>
</x-app-layout>