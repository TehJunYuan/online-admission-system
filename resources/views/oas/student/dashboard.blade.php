<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            {{-- error message --}}
            @if (Session::has('error'))
                <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div class="ml-3 text-sm font-medium">
                        {{ Session::get('error') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endif
            {{-- end error message --}}

            {{-- check applicant profile exists --}}
            @if($data['applicant_profile_status'])
                {{-- applicant profile --}}
                @if ($data['applicant_profile_status']->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PERSONAL_PARTICULARS'))
                    <div class="max-w-screen-2xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('stepper.profile_step_2') }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ __('setupProfile.description') }}</p>
                        <a href="{{ route('parentProfile.home') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('button.continue_parent') }}
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                @elseif ($data['applicant_profile_status']->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PARENT_GUARDIAN_PARTICULARS'))
                    <div class="max-w-screen-2xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('stepper.profile_step_3') }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ __('setupProfile.description') }}</p>
                        <a href="{{ route('emergencyContact.home') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('button.continue_ec') }}
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>  
                @elseif ($data['applicant_profile_status']->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_EMERGENCY_CONTACT'))
                    <div class="max-w-screen-2xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('stepper.profile_step_4') }}</h5> 
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ __('setupProfile.description') }}</p>
                        <a href="{{ route('profilePicture.home') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('button.continue_picture') }}
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                @endif
                {{-- finish applicant profile --}}
                @if ($data['applicant_profile_status']->applicant_profile_status_id == config('constants.APPLICANT_PROFILE_STATUS_CODE.COMPLETE_PROFILE_PICTURE'))
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        {{-- view applicant profile --}}
                        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                                {{ __('dashboard.title_1') }}
                            </h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"><span class="font-bold">{{ __('dashboard.attention') }}</span> {{ __('dashboard.title_1_description') }}</p>
                            <ul class="my-4 space-y-3">
                                <li>
                                    <a href="{{ route('personalProfile.edit') }}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-50 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ __('stepper.profile_step_1') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('parentProfile.edit') }}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-50 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ __('stepper.profile_step_2') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('emergencyContact.edit') }}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-50 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ __('stepper.profile_step_3') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profilePicture.edit') }}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-50 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ __('stepper.profile_step_4') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        {{-- end my profile --}}

                        {{-- apply programme --}}
                        <div class="col-span-2">    
                            <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('dashboard.title_2') }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ __('dashboard.title_2_description_1') }}</p>
                                <p class="mb-3 font-thin text-xs text-gray-500 dark:text-gray-400">{{ __('dashboard.title_2_description_2') }}</p>
                                <a href="{{ route('programmeSelect.newApplication') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    {{ __('button.apply_now') }}
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                        {{-- end apply programme --}}
                    </div>
                    @foreach ($data['application_status_logs'] as $application_status_log)
                        @if ($application_status_log->application_status_id != config('constants.APPLICATION_STATUS_CODE.COMPLETE_PAYMENT'))
                            <div class="grid md:grid-cols-6 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <div class="my-0.5 col-span-2">{{ __('stepper.programme') }}</div>
                                <div class="my-0.5 col-span-2">{{ __('stepper.current') }}</div>
                                <div class="my-0.5 col-span-2">{{ __('stepper.action') }}</div>
                            </div>
                            <div class="grid md:grid-cols-6 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <div class="col-span-2">
                                    @for ($i = 0; $i < count($data['programme_pickeds']); $i++)
                                        @if ($data['programme_pickeds'][$i]->application_record_id == $application_status_log->application_record_id)
                                            {{ __('dashboard.choice ') }}{{ $i % 3 + 1 }}: {{ $data['programme_pickeds'][$i]->programmeRecord['programme']->en_name }}
                                        @endif
                                    @endfor
                                </div>
                                <div class="col-span-2 my-2">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-2 rounded-full dark:bg-green-900 dark:text-green-300">{{ $application_status_log->applicationStatus['status'] }}</span>
                                </div>
                                <div class="col-span-2 flex flex-col">
                                    @if ($application_status_log->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_PROGRAM_SELECTION'))
                                        <a href="{{ route('academicDetail.home', ['id' => Crypt::encrypt($application_status_log->application_record_id) ]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.continue_academic') }}</a>
                                    @elseif($application_status_log->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_ACADEMIC_DETAIL'))
                                        <a href="{{ route('statusOfHealth.home', ['id' => Crypt::encrypt($application_status_log->application_record_id) ]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.continue_status') }}</a>
                                    @elseif($application_status_log->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_STATUS_OF_HEALTH'))
                                        <a href="{{ route('agreements.home', ['id' => Crypt::encrypt($application_status_log->application_record_id) ]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.continue_agreements') }}</a>
                                    @elseif($application_status_log->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_AGREEMENT'))
                                        <a href="{{ route('draft.home', ['id' => Crypt::encrypt($application_status_log->application_record_id) ]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.continue_data') }}</a>
                                    @elseif($application_status_log->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_DRAFT'))
                                        <a href="{{ route('supportingDocument.home', ['id' => Crypt::encrypt($application_status_log->application_record_id) ]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.continue_documents') }}</a>
                                    @elseif($application_status_log->application_status_id == config('constants.APPLICATION_STATUS_CODE.COMPLETE_SUPPORTING_DOCUEMENT'))
                                        <a href="{{ route('payment.home', ['id' => Crypt::encrypt($application_status_log->application_record_id) ]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.continue_payment') }}</a>
                                    @endif
                                    @if($application_status_log->application_status_id < config('constants.APPLICATION_STATUS_CODE.COMPLETE_PAYMENT'))
                                        <a href="{{ route('delete.DeleteApplication', ['id' => Crypt::encrypt($application_status_log->application_record_id)  ]) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">{{ __('button.delete') }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @else 
                <div class="max-w-screen-2xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('stepper.applicant_profile') }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ __('setupProfile.description') }}</p>
                    <button type="button" data-modal-target="agreementModal" data-modal-toggle="agreementModal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ __('button.setup_profile') }}
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    {{-- terms and conditions --}}
                    <div id="agreementModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y- md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ __('setupProfile.privacy') }}
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="agreementModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-6 space-y-6">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        {{ __('setupProfile.privacy_description') }}
                                    </p>
                                    <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="https://www.southern.edu.my/privacy-policy/">
                                        {{ __('setupProfile.privacy_learn') }}
                                    </a>
                                </div>
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <a href="{{ route('personalProfile.home') }}" data-modal-hide="agreementModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.accept') }}</a>
                                    <button data-modal-hide="agreementModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{ __('button.decline') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end terms and conditions --}}
                </div>
            @endif
            {{-- end applicant profile --}}
        </div>
    </div>
</x-app-layout>