{{-- Prevent Back Button --}}
<script type="text/javascript">
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>

<form action="{{ route('profilePicture.create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid gap-6 my-6 md:grid-cols-2">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">{{ __('setupProfile.upload') }} <span class="text-red-500">*</span></label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="picturePond" name="picture" type="file" multiple data-max-file-size="5MB" data-max-files="1" data-allow-reorder="true" required>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="picturePond_help">{{ __('setupProfile.only_accepted') }}</p>
        </div>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.submit') }}</button>
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