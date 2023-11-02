<x-app-layout>
    <!-- file pond css -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                        {{ __('stepper.applicant_profile') }}
                    </p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-white">{{ __('stepper.profile_edit_step_4') }}</span>
                    </div>
                </li>
                </ol>
            </nav>
            <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('stepper.profile_edit_step_4') }}</h2>
            {{-- end header --}}

            {{-- alert --}}
            <div class="flex p-4 my-4 text-sm text-blue-800 rounded-lg bg-blue-100 dark:bg-gray-800 dark:text-blue-400" role="alert" id="guideline1">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-bold">{{ __('setupProfile.guidelines') }}</span>
                    <ol class="mt-1.5 ml-4 list-disc list-inside">
                        <li>{{ __('setupProfile.guidelines_1') }}</li>
                        <li>{{ __('setupProfile.guidelines_2') }}</li>
                        <li>{{ __('setupProfile.guidelines_3') }}</li>
                        <li>{{ __('setupProfile.guidelines_4') }}</li>
                        <li>{{ __('setupProfile.guidelines_5') }}</li>
                    </ul>
                    <div class="flex flex-col items-start md:flex-row my-2">
                        <figure class="mx-4">
                            <img class="h-auto rounded-lg" src="/assets/images/photo_correct.png" alt="image description">
                        </figure>
                        <figure class="mx-4">
                            <img class="h-auto rounded-lg" src="/assets/images/photo_wrong.png" alt="image description">
                        </figure>
                    </div>
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-50 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" data-dismiss-target="#guideline1" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            {{-- end alert --}}

            <form action="{{ route('profilePicture.update') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="applicant_profile_picture_id" value="{{ $data['applicantProfilePicture']->id }}">
                <input type="hidden" name="applicant_profile_id" value="{{ $data['applicantProfilePicture']->applicant_profile_id }}">

                <div class="grid gap-6 my-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">{{ __('setupProfile.upload') }} <span class="text-red-500">*</span></label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="picturePond" name="picture" type="file" multiple data-max-file-size="5MB" data-max-files="1" data-allow-reorder="true" required>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300 mb-6" id="picturePond_help">{{ __('setupProfile.only_accepted') }}</p>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.submit') }}</button>
                    </div>
                    <div>
                        <img class="rounded-lg h-96 w-72 mx-auto" src="{{ $data['imagePath'] }}" alt="image description">
                    </div>
                </div>
            </form>


            
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
                const picturePond = FilePond.create(document.querySelector('input[id="picturePond"]'),{
                    acceptedFileTypes: ['image/png','image/jpeg'],
                    fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                        resolve(type);
                    }),
                });
            
                FilePond.setOptions({
                    server: {
                        process: '/applicant-profile/profile-picture/TmpUpload',
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
                        url: "/applicant-profile/profile-picture/TmpDelete",
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
            {{-- end script --}}  
       </div>
    </div>
</x-app-layout>