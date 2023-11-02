<div class="grid md:grid-cols-2 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    <div class="my-0.5 md:flex md:items-center">{{ __('apply.draft_ec_1') }}</div>
    <div class="md:flex md:justify-end">
        <a href="{{ route('emergencyContact.edit') }}" class="md:w-2/12 text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
            {{ __('button.edit') }}
        </a>     
    </div>  
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_en_name') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['emergency_contact_user_detail1']->en_name }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_ch_name') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        @if ($data['emergency_contact_user_detail1']->ch_name != null)
            {{ $data['emergency_contact_user_detail1']->ch_name }}
        @else
            {{ __('-') }}
        @endif 
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_relationship') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['emergency_contact1']->guardianRelationship['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_tel') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['emergency_contact_user_detail1']->tel_hp }}
    </div>
</div>
<div class="grid md:grid-cols-1 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    <div class="my-0.5">{{ __('apply.draft_ec_2') }}</div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_en_name') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['emergency_contact_user_detail2']->en_name }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_ch_name') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        @if ($data['emergency_contact_user_detail2']->ch_name != null)
            {{ $data['emergency_contact_user_detail2']->ch_name }}
        @else
            {{ __('-') }}
        @endif 
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_relationship') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['emergency_contact2']->guardianRelationship['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_tel') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['emergency_contact_user_detail2']->tel_hp }}
    </div>
</div>