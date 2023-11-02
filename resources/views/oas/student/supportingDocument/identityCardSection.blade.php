<div class="grid md:grid-cols-1 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    <div>
        {{ __('apply.IC') }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.IC_F') }} <span class="text-red-500">*</span>
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="icFront" id="icFront" multiple data-max-file-size="5MB" data-max-files="1" data-allow-reorder="true" required>
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400 my-1">
        {{ __('apply.IC_B') }} <span class="text-red-500">*</span>
    </div>
    <div class="my-1">
        <input type="file" class="filepond" name="icBack" id="icBack" multiple data-max-file-size="5MB" data-max-files="1" data-allow-reorder="true" required>
    </div>
</div>