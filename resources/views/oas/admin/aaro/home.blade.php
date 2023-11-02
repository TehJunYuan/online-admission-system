<x-app-layout>
    @include('layouts.aaroNavigation')
    
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-12">
            {{-- header --}}
            <h2 class="mx-2 my-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('admin.welcome') }} {{ Auth::user()->name }}</h2>
            {{-- end header --}}

            <section class="bg-white dark:bg-gray-900">
                <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
                    <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-2 dark:text-white">
                        <div class="flex flex-col items-center justify-center dark:bg-gray-800 py-14">
                            <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $count['count_all_todo_for_aaro'] }}</dt>
                            <dd class="font-light text-gray-500 dark:text-gray-400">{{ __('admin.pending_verify') }}</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center dark:bg-gray-800 py-14 ">
                            <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $count['count_all_complete_checking_application_by_aaro'] }}</dt>
                            <dd class="font-light text-gray-500 dark:text-gray-400">{{ __('admin.verified') }}</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center dark:bg-gray-800 py-14">
                            <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $count['count_all_application_rejected_by_aaro'] }}</dt>
                            <dd class="font-light text-gray-500 dark:text-gray-400">{{ __('admin.rejected') }}</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center dark:bg-gray-800 py-14">
                            <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $count['count_all_uploaded_offer_letter_by_aaro'] }}</dt>
                            <dd class="font-light text-gray-500 dark:text-gray-400">{{ __('Complete Offer Letter') }}</dd>
                        </div>
                    </dl>
                </div>
            </section>

            {{-- table --}}
            <section class="my-8">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="myTable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.name_mykad') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.tempcode') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.intake') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.progress') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.form') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.document') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Offer Letter') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('admin.remark') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_candidate_profiles as $profile)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $profile->getEn_name() }}
                                    <br>
                                    {{ $profile->getIc() }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $profile->getTemp_code()->tempCode }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $profile->getSelected_Programme()->programmeRecord['programme']->en_name }}
                                    <br>
                                    {{ $profile->getSelected_Programme()->programmeRecord['semesterYearMapping']->year}}@if($profile->getSelected_Programme()->programmeRecord['semesterYearMapping']->semester['semester'] == "3"){{ __("A") }}@elseif($profile->getSelected_Programme()->programmeRecord['semesterYearMapping']->semester['semester'] == "5/6"){{ __("B") }}@elseif($profile->getSelected_Programme()->programmeRecord['semesterYearMapping']->semester['semester'] == "9/10"){{ __("C") }}@endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($profile->getCandidate_profile_status_id())
                                        @if ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_SUBMIT_PAYMENT'))
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                {{ __('stepper.pending_AFO') }}
                                            </span>
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_PAYMENT_SLIP'))
                                            @if (Auth::user()->roles[0]->name == 'AFO')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    {{ __('stepper.pending_SRO') }}
                                                </span>
                                            @else
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                    {{ __('stepper.pending_SRO') }}
                                                </span>
                                            @endif
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO'))
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                {{ __('stepper.rejected_AFO') }}
                                            </span>
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_APPLICATION'))
                                            @if (Auth::user()->roles[0]->name == 'SRO')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    {{ __('stepper.pending_AARO') }}
                                                </span>
                                            @else
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                    {{ __('stepper.pending_AARO') }}
                                                </span>
                                            @endif
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_SRO'))
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                {{ __('stepper.rejected_SRO') }}
                                            </span>
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.APPROVE_BECOME_STUDENT'))
                                            @if (Auth::user()->roles[0]->name == 'AARO')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    {{ __('stepper.complete_AARO') }}
                                                </span>
                                            @else
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                    {{ __('stepper.complete_AARO') }}
                                                </span>
                                            @endif
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_AARO'))
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                {{ __('stepper.rejected_AARO') }}
                                            </span>
                                        @elseif ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_OFFER_LETTER'))
                                            @if (Auth::user()->roles[0]->name == 'AARO')
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    {{ __('COMPLETE OFFER LETTER') }}
                                                </span>
                                            @else
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                    {{ __('COMPLETE OFFER LETTER') }}
                                                </span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('applicationForm.home',['id'=> Crypt::encrypt($profile->getApplication_record_id())]) }}" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>   
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('displaydocument.displaySingleApplicationSupportingDocumentForAARO',['id'=> Crypt::encrypt($profile->getApplication_record_id())]) }}" target="_blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1 text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg xmlns="http://www.w3.orlg/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </a>
                                </td>
                                @if ($profile->getCandidate_profile_status_id() == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_OFFER_LETTER'))
                                <td class="px-6 py-4">
                                    <a href="{{ route('applicationProgress.getOfferLetter',['id'=> Crypt::encrypt($profile->getApplication_record_id())]) }}" target="_blank" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 text-center inline-flex items-center mr-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </a>
                                </td>
                                @else
                                <td class="px-6 py-4">
                                    -
                                </td>
                                @endif
                                <td class="px-6 py-4">
                                    <a href="{{ route('remark.home', ['id' => Crypt::encrypt($profile->getApplication_record_id())]) }}" target="_blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1 text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="window.open(this.href, '_blank', 'width=500,height=500'); return false;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        &nbsp;
                                        {{ __('button.messages') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            {{-- end table --}}
        </div>
    </div>

    {{-- datatables --}}
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "dom": 'ftp',
                
                initComplete: function() {
                    var searchInput = $('div.dataTables_filter input');
                    var searchLabel = $('div.dataTables_filter label');

                    searchLabel.addClass('dark:text-white');
                    searchInput.addClass('block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4');
                    searchInput.attr('placeholder', 'Search Here');

                },
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                language: {
                    paginate: {
                        first: '<span class="px-2 py-1 rounded-md bg-red-200 text-red-700 cursor-pointer">First</span>',
                        previous: '<span class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&laquo;</span>',
                        next: '<span class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&raquo;</span>',
                        last: '<span class="px-2 py-1 rounded-md bg-gray-200 text-red-700 cursor-pointer">Last</span>',
                    }
                }
            });
        });
    </script>
</x-app-layout>