{{-- form --}}
<form action="{{ route('personalProfile.create') }}" method="POST" class="mt-8">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-3">
        <div>
            <label for="en_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.en_name') }} <span class="text-red-500">*</span></label>
            <input type="text" id="en_name" name="en_name" value="{{ Auth::user()->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" onkeyup="if (/[^|A-Za-z\s\@]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z\s\@]+/g,'')" maxlength="70" required>
        </div>
        <div>
            <label for="ch_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.ch_name') }} <span class="text-gray-500">{{ __('setupProfile.any') }}</span></label>
            <input type="text" id="ch_name" name="ch_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名字" maxlength="10">
        </div>
    </div>
    <div class="my-4">
        <label for="ic" class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.IC') }} <span class="text-red-500">*</span></label>
        <span class="text-gray-500">{{ __('setupProfile.IC_description') }}</span>
        <div class="flex items-center my-1">
            <input id="changeInput" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="changeInputMethod()">
            <label for="changeInput" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('setupProfile.No_IC') }}</label>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-12" id="ic_section">
        <div class="col-span-2">
            <input type="text" id="ic1" name="ic1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="800808" minlength="6" maxlength="6" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required>
        </div>
        <div>
            <input type="text" id="ic2" name="ic2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="08" minlength="2" maxlength="2" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required>
        </div>
        <div>
            <input type="text" id="ic3" name="ic3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="8888" minlength="4" maxlength="4" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required>
        </div>
    </div>
    <div class="mb-6" id="passport_section" style="display: none;">
        <input type="text" id="passport" name="passport" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Other identity document proof" onkeyup="if (/[^|A-Za-z0-9-/]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9-/]+/g,'')" maxlength="60" >
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-3">
        <div>
            <label for="race" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.race') }} <span class="text-red-500">*</span></label>
            <select id="race" name="race_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a race') }}</option>
                @foreach ($data['races'] as $race)
                    <option value="{{ $race->id }}">{{ $race->name }}</option>
                @endforeach
            </select>
        </div>  
        <div>
            <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.religion') }} <span class="text-red-500">*</span></label>
            <select id="religion" name="religion_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a religion') }}</option>
                @foreach ($data['religions'] as $religion)
                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.nationality') }} <span class="text-red-500">*</span></label>
            <select id="nationality" name="nationality_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a nationality') }}</option>
                @role('LOCAL_STUDENT')
                    <option value="131" selected>Malaysia</option>
                    <option value="161">Non-Malaysian</option>
                @else
                    @foreach ($data['nationalities'] as $nationality)
                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                    @endforeach
                @endrole
            </select>
        </div>
    </div>
    <div class="grid gap-6 my-1 md:grid-cols-3">
        <div>
            <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.birth') }} <span class="text-red-500">*</span></label>
            {{-- TODO: Make a validation --}}
            <input type="date" id="birth_date" name="birth_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" onchange="ageCalculator()">
        </div>  
        <div>
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.age') }} <span class="text-red-500">*</span></label>
            <input type="text" id="age" name="age" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" disabled>
        </div>
        <div>
            <label for="place_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.POB') }} <span class="text-red-500">*</span></label>
            <select id="place_of_birth" name="place_of_birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose place you birth') }}</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                <option value="Others">Others</option>
            </select>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-3">
        <div>
            <label for="marital" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.marital') }} <span class="text-red-500">*</span></label>
            <select id="marital" name="marital_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a marital') }}</option>
                @foreach ($data['maritals'] as $marital)
                    <option value="{{ $marital->id }}">{{ $marital->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.gender') }} <span class="text-red-500">*</span></label>
            <div class="flex flex-row">
                @foreach ($data['genders'] as $gender)
                    @if ($gender->id == 1)
                    <div class="flex items-center my-4 mr-4">
                        <input checked id="gender1" type="radio" value="{{ $gender->id }}" name="gender_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="gender_id_1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $gender->name }}</label>
                    </div>
                    @else
                    <div class="flex items-center my-4 mx-4">
                        <input id="gender1" type="radio" value="{{ $gender->id }}" name="gender_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="gender_id_2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $gender->name }}</label>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-3">
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.email') }} <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@email.com" onkeyup="if (/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$+/g.test(this.value)) this.value = this.value.replace(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$+/g,'')" maxlength="64" required>
        </div> 
        <div>
            <label for="tel_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_hp') }} <span class="text-red-500">*</span></label>
            <input type="text" id="tel_hp" name="tel_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" minlength="8" maxlength="20" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required>
        </div> 
        <div>
            <label for="tel_h" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_h') }}</label>
            <input type="text" id="tel_h" name="tel_h" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" minlength="8" maxlength="20" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')">
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="col-span-2">
            <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.corresponding') }}</h3>
        </div>
        <div>
            <label for="c_street1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.line_1') }} <span class="text-red-500">*</span></label>
            <input type="text" id="c_street1" name="c_street1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Input street/ building name') }}" onkeyup="if (/[^|A-Za-z0-9/.\s\-,]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9/.\s\-,]+/g,'')" required>
        </div>
        <div>
            <label for="c_street2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.line_2') }} <span class="text-red-500">*</span></label>
            <input type="text" id="c_street2" name="c_street2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Input unit/floor') }}" onkeyup="if (/[^|A-Za-z0-9/.\s\-,]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9/.\s\-,]+/g,'')" required>
        </div>
        <div>
            <label for="c_zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.zipcode') }} <span class="text-red-500">*</span></label>
            <input type="text" id="c_zipcode" name="c_zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" minlength="5" maxlength="15" required>
        </div>
        <div>
            <label for="c_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.city') }} <span class="text-red-500">*</span></label>
            <input type="text" id="c_city" name="c_city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|A-Za-z/.\s]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z/.\s]+/g,'')" required>
        </div>
        <div>
            <label for="c_state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.state') }} <span class="text-red-500">*</span></label>
            <select id="c_state" name="c_state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a state') }}</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div>
            <label for="c_country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.country') }} <span class="text-red-500">*</span></label>
            <select id="c_country" name="c_country_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a country') }}</option>
                @foreach ($data['countries'] as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="col-span-2">
            <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.permanent') }}</h3>
            <div class="flex items-center mt-2">
                <input id="sameAbove" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="copyAddress()">
                <label for="sameAbove" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('setupProfile.same_correspondence') }}</label>
            </div>
        </div>
        <div>
            <label for="p_street1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.line_1') }} <span class="text-red-500">*</span></label>
            <input type="text" id="p_street1" name="p_street1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Input street/ building name') }}" onkeyup="if (/[^|A-Za-z0-9/.\s\-,]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9/.\s\-,]+/g,'')" required>
        </div>
        <div>
            <label for="p_street2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.line_2') }} <span class="text-red-500">*</span></label>
            <input type="text" id="p_street2" name="p_street2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Input unit/floor') }}" onkeyup="if (/[^|A-Za-z0-9/.\s\-,]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9/.\s\-,]+/g,'')" required>
        </div>
        <div>
            <label for="p_zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.zipcode') }} <span class="text-red-500">*</span></label>
            <input type="text" id="p_zipcode" name="p_zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" minlength="5" maxlength="15" required>
        </div>
        <div>
            <label for="p_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.city') }} <span class="text-red-500">*</span></label>
            <input type="text" id="p_city" name="p_city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|A-Za-z/.\s]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z/.\s]+/g,'')" required>
        </div>
        <div>
            <label for="p_state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.state') }} <span class="text-red-500">*</span></label>
            <select id="p_state" name="p_state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a state') }}</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div>
            <label for="p_country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.country') }} <span class="text-red-500">*</span></label>
            <select id="p_country" name="p_country_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option disabled selected hidden value="">{{ __('Choose a country') }}</option>
                @foreach ($data['countries'] as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('button.submit') }}</button>
</form>
{{-- end form --}}
<script src="/js/noIdentityDocument.js"></script>
<script src="/js/copyAddress.js"></script>
<script src="/js/calculateAge.js"></script>
