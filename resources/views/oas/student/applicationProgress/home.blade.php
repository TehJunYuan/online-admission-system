<x-app-layout>
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
    
    <div class="p-4 sm:ml-64">
       <div class="p-4 mt-12">
            {{-- if don't have any application --}}
            @if (count($data['candidateProfile']) == 0)
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                        <div class="mx-auto max-w-screen-sm text-center">
                            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-600 dark:text-blue-500">{{ __('stepper.nothing_1') }}</h1>
                            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">{{ __('stepper.nothing_2') }}</p>
                            <a href="/dashboard" class="inline-flex text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-900 my-4">{{ __('button.back_home_page') }}</a>
                        </div>   
                    </div>
                </section>            
            @endif
            {{-- end if --}}
                
            @if (count($data['candidateProfile']) != 0)
                @foreach ($data['candidateProfile'] as $item)
                    <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center mb-14">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('stepper.application_progress') }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ __('stepper.current_status') }}
                            &nbsp;
                            @if ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_SUBMIT_PAYMENT'))
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                    {{ __('stepper.pending_verify') }}
                                </span>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_PAYMENT_SLIP'))
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    {{ __('stepper.payment_verified') }}
                                </span>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO'))
                                <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    {{ __('stepper.payment_rejected') }}
                                </span>
                                <p class="text-gray-700 dark:text-gray-400 my-2">
                                    {{ __('stepper.rejected_AFO') }}
                                    <a href="mailto:AccFin@sc.edu.my" class="text-gray-500 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">{{ __('department.AFO') }}</a>
                                </p>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_CHECKING_APPLICATION'))
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    {{ __('stepper.profile_verified') }}
                                </span>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_SRO'))
                                <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    {{ __('stepper.application_rejected') }}
                                </span>
                                <p class="text-gray-700 dark:text-gray-400">
                                    {{ __('stepper.rejected_SRO') }}
                                    <a href="mailto:marketing@sc.edu.my" class="text-gray-500 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">{{ __('department.SRO') }}</a>
                                </p>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.APPROVE_BECOME_STUDENT'))
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    {{ __('stepper.application_approved') }}  
                                </span>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_AARO'))
                                <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    {{ __('stepper.application_rejected') }}
                                </span>
                                <p class="text-gray-700 dark:text-gray-400"></p>
                                    {{ __('stepper.rejected_AARO') }}
                                    <a href="mailto:REG@sc.edu.my" class="text-gray-500 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">{{ __('department.AARO') }}</a>
                                </p>
                            @elseif ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_OFFER_LETTER'))
                                <span class="bg-green-100 text-green-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    {{ __('Offer Letter has been uploaded.') }}
                                </span>
                            @endif
                        </p>

                        @if ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO') || $item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_AARO') || $item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.APPLICATION_REJECTED_BY_SRO'))
                            @foreach ($Application_Object as $item2)
                                @if(!empty($item2->getReject_reason()->application_record_id) && ($item->application_record_id == $item2->getReject_reason()->application_record_id))
                                    <p class="mb-3 font-normal text-grey-400 dark:text-yellow-400">
                                        {{ __('stepper.rejected_reason') }}{{ $item2->getReject_reason()->rejectReason['content'] }}
                                    </p>
                                @endif
                            @endforeach
                        @endif
                        @if ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.PAYMENT_SLIP_REJECTED_BY_AFO'))
                            <a href="{{ route('resubmitPayment.home', ['id' => Crypt::encrypt($item->application_record_id)]) }}" type="button" data-modal-target="resubmitModal" data-modal-toggle="resubmitModal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                {{ __('stepper.apply_update_step_7') }}
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        @endif
                        @if ($item->candidate_profile_status_id == config('constants.CANDIDATE_PROFILE_STATUS.COMPLETE_OFFER_LETTER'))
                            <a href="{{ route('applicationProgress.getOfferLetter',['id'=> Crypt::encrypt($item->application_record_id)]) }}" target="_blank" class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1 text-center inline-flex items-center mr-2 dark:bg-yellow-500 dark:hover:bg-green-600 dark:focus:ring-green-400">
                                {{ 'View Your Offer Letter Here' }}
                            </a>
                        @endif
                    </div>
                @endforeach
            @endif
       </div>
    </div>

    {{-- filepond --}}
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateSize,
            FilePondPluginFileEncode,
            FilePondPluginImageExifOrientation,
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
        );
        const paymentPond = FilePond.create(document.querySelector('input[id="paymentPond"]'),{
            acceptedFileTypes: ['image/png','image/jpeg','application/pdf'],
            fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                resolve(type);
            }),
        });

        FilePond.setOptions({
            server: {
                process: '/payment/tmp-upload',
                revert:  (uniqueFileId, load, error) => {
                    deleteFile(uniqueFileId);
                    error('Error occur');
                    load();
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });


        function deleteFile(fileName){
            $.ajax({
                url: "/payment/tmp-delete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                data: {
                    file: fileName,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.log('error')
                },
            });

        }
    </script>
</x-app-layout>