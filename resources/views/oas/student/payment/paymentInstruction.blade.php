<div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">{{ __('apply.instruction_title') }}</h5>
    <div class="flex items-baseline text-gray-900 dark:text-white">
        <span class="text-2xl font-semibold">{{ __('apply.currency') }}</span>
        <span class="text-5xl font-extrabold tracking-tight">{{ __('apply.fee') }}</span>
        <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">{{ __('apply.only') }}</span>
    </div>
    <!-- List -->
    <h4 class="text-2xl font-bold dark:text-white my-7">{{ __('apply.instruction') }}</h4>
    <p class="mb-3 text-gray-500 dark:text-gray-400">{{ __('apply.instruction_1') }}</p>
    <ul role="list" class="space-y-5 my-7">
        <li class="flex space-x-3">
            <!-- Icon -->
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ __('apply.instruction_2') }}</span>
        </li>
        <li class="flex space-x-3">
            <!-- Icon -->
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ __('apply.instruction_3') }}</span>
        </li>
        <li class="flex space-x-3">
            <!-- Icon -->
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ __('apply.instruction_4') }}</span>
        </li>
        <li class="flex space-x-3">
            <!-- Icon -->
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ __('apply.instruction_5') }}</span>
        </li>
    </ul>
    <h4 class="text-2xl font-bold dark:text-white my-7">{{ __('apply.payment_method') }}</h4>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="text-gray-500 dark:text-gray-400">{{ __('apply.payee') }}</div>
        <div class="font-bold dark:text-white">{{ __('apply.payee_name') }}</div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="text-gray-500 dark:text-gray-400">{{ __('apply.current_acc') }}</div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="text-gray-500 dark:text-gray-400">{{ __('apply.pb_bank') }}</div>
        <div class="font-bold dark:text-white">{{ __('apply.pb_bank_no') }}</div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="text-gray-500 dark:text-gray-400">{{ __('apply.cimb') }}</div>
        <div class="font-bold dark:text-white">{{ __('apply.cimb_bank_no') }}</div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="text-gray-500 dark:text-gray-400">{{ __('apply.rhb') }}</div>
        <div class="font-bold dark:text-white">{{ __('apply.rhb_bank_no') }}</div>
    </div>
</div>