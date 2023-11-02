<div class="grid md:grid-cols-2 p-4 text-sm font-medium uppercase text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    <div class="my-0.5 md:flex md:items-center">{{ __('apply.personal_info') }}</div>
    <div class="md:flex md:justify-end">
        <a href="{{ route('personalProfile.edit') }}" class="md:w-2/12 text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
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
        {{ $data['user_detail']->en_name }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_ch_name') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        @if ($data['user_detail']->ch_name == null)
            {{ __('-') }}
        @else
            {{ $data['user_detail']->ch_name }}
        @endif
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_IC') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['user_detail']->ic }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_race') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->race['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_religion') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->religion['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_nationality') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->nationality['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_birth') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->birth_date }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_POB') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->place_of_birth }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_gender') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->gender['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_marital') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['applicant_profile']->marital['name'] }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_email') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['user_detail']->email }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_tel_hp') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['user_detail']->tel_hp }}
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_tel_h') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        @if ($data['user_detail']->tel_h != null)
            {{ $data['user_detail']->tel_h }}
        @else
            {{ __('-') }}
        @endif
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_corresponding') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['c_address']->street1 }}, {{ $data['c_address']->street2 }}, {{ $data['c_address']->zipcode }}, {{ $data['c_address']->city }}, {{ $data['c_address']->state }}, {{ $data['c_address']->country['name'] }}.
    </div>
</div>
<div class="grid md:grid-cols-2 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700">
    <div class="text-gray-500 dark:text-gray-400">
        {{ __('apply.draft_permanent') }}
    </div>
    <div class="text-gray-600 dark:text-gray-300 font-medium">
        {{ $data['p_address']->street1 }}, {{ $data['p_address']->street2 }}, {{ $data['p_address']->zipcode }}, {{ $data['p_address']->city }}, {{ $data['p_address']->state }}, {{ $data['p_address']->country['name'] }}.
    </div>
</div>