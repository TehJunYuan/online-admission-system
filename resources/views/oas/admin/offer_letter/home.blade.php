<x-app-layout>
    @include('layouts.aaroNavigation')
        {{-- Prevent Back Button --}}
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>

    <!-- file pond css -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-12">
            {{-- header --}}
            <h2 class="mx-2 my-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('admin.welcome') }} {{ Auth::user()->name }}</h2>
            {{-- end header --}}

            <section class="bg-white dark:bg-gray-900">
                <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
                    <div class="flex items-center justify-center dark:bg-gray-800 py-12">
                        <div class="font-semibold text-5xl text-gray-700 dark:text-gray-100">{{ __('Please upload the offer letter here') }}</div>
                    </div>
                    <div class="flex items-center justify-center dark:bg-gray-800">
                        <div class="font-light text-4xl text-gray-500 dark:text-gray-400">{{ __('Student Name: ') }}</div>
                        <strong class="font-semibold text-4xl text-gray-900 dark:text-gray-100" name="en_name">{{ $get_user_detail->en_name }}</strong>
                    </div>
                    <div class="flex items-center justify-center dark:bg-gray-800">
                        <div class="font-light text-4xl text-gray-500 dark:text-gray-400">{{ __('Temp Code:') }}</div>
                        <strong class="font-semibold text-4xl text-gray-900 dark:text-gray-100">{{ $get_cms_detail->tempCode }}</strong>
                    </div>     
                </div>
            </section>
        </div>
        <div class="px-6 col-6">
            <form action="{{ route('offer_letter.create',['id'=>Crypt::encrypt($APPLICATION_RECORD_ID)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">{{ __('Upload Offer Letter Here') }} <span class="text-red-500">*</span></label>
                <input type="file" name="offerLetter" multiple data-max-file-size="5MB" data-max-files="1" data-allow-reorder="true" class="block  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" accept=".pdf" required>
                <br>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.submit') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>