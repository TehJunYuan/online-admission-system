<div class="grid md:grid-cols-1 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    <div>
        {{ __('apply.transcript') }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_secondary') }} <span class="text-red-500">*</span>
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="secondarySchoolTranscripts" id="secondarySchoolTranscripts" multiple data-max-file-size="5MB" data-max-files="1" required>
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_upper') }}
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="upperSecondarySchoolTranscripts" id="upperSecondarySchoolTranscripts" multiple data-max-file-size="5MB" data-max-files="1">
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_foundation') }}
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="foundationTranscripts" id="foundationTranscripts" multiple data-max-file-size="5MB" data-max-files="1">
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_diploma') }}
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="diplomaTranscripts" id="diplomaTranscripts" multiple data-max-file-size="5MB" data-max-files="1">
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_degree') }}
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="degreeTranscripts" id="degreeTranscripts" multiple data-max-file-size="5MB" data-max-files="1">
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_master') }}
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="masterTranscripts" id="masterTranscripts" multiple data-max-file-size="5MB" data-max-files="1">
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.transcript_phd') }}
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="phdTranscripts" id="phdTranscripts" multiple data-max-file-size="5MB" data-max-files="1">
    </div>
</div>