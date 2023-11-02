<form action="{{ route('emergencyContact.create') }}" method="POST" class="mt-8">
    @csrf

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="col-span-2">
            <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.ec_1') }}</h3>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="en_name1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.en_name') }} <span class="text-red-500">*</span></label>
            <input type="text" id="en_name1" name="en_name1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" onkeyup="if (/[^|A-Za-z\s\@]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z\s\@]+/g,'')" maxlength="70" required>
        </div>
        <div>
            <label for="ch_name1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.ch_name') }} <span class="text-gray-500">{{ __('setupProfile.any') }}</span></label>
            <input type="text" id="ch_name1" name="ch_name1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名字" maxlength="10">
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="tel_hp1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_hp') }} <span class="text-red-500">*</span></label>
            <input type="tel" id="tel_hp1" name="tel_hp1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required minlength="8" maxlength="20">
        </div> 
        <div>
            <label for="guardian_relationship_id1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.relationship') }} <span class="text-red-500">*</span></label>
            <select id="guardian_relationship_id1" name="guardian_relationship_id1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a relationship') }}</option>
                @foreach ($data['relationships'] as $relationship)
                    <option value="{{ $relationship->id }}">{{ $relationship->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="col-span-2">
            <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.ec_2') }}</h3>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="en_name2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.en_name') }} <span class="text-red-500">*</span></label>
            <input type="text" id="en_name2" name="en_name2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" onkeyup="if (/[^|A-Za-z\s\@]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z\s\@]+/g,'')" maxlength="70" required>
        </div>
        <div>
            <label for="ch_name2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.ch_name') }} <span class="text-gray-500">{{ __('setupProfile.any') }}</span></label>
            <input type="text" id="ch_name2" name="ch_name2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名字" maxlength="10">
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="tel_hp2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_hp') }} <span class="text-red-500">*</span></label>
            <input type="tel" id="tel_hp2" name="tel_hp2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required minlength="8" maxlength="20">
        </div> 
        <div>
            <label for="guardian_relationship_id2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.relationship') }} <span class="text-red-500">*</span></label>
            <select id="guardian_relationship_id2" name="guardian_relationship_id2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a relationship') }}</option>
                @foreach ($data['relationships'] as $relationship)
                    <option value="{{ $relationship->id }}">{{ $relationship->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.submit') }}</button>
</form>