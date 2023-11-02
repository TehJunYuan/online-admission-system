<x-app-layout>
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
                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-white">{{ __('stepper.profile_edit_step_2') }}</span>
                    </div>
                </li>
                </ol>
            </nav>
            {{-- end header --}}
            <form action="{{ route('parentProfile.update') }}" method="post" class="mt-8">
                @csrf

                <input type="hidden" name="guardian_detail_id" value="{{ $data['guardianDetail']->id }}">
                <input type="hidden" name="user_detail_id" value="{{ $data['userDetail']->id }}">
                <input type="hidden" name="p_address_id" value="{{ $data['pAddress']->id }}">

                <div class="flex justify-between mb-4">
                    <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('stepper.profile_edit_step_2') }}</h2>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('button.save') }}</button>
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="en_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.en_name') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="en_name" name="en_name" value="{{ $data['userDetail']->en_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" onkeyup="if (/[^|A-Za-z\s\@]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z\s\@]+/g,'')" maxlength="70" required>
                    </div>
                    <div>
                        <label for="ch_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.ch_name') }} <span class="text-gray-500">(if any)</span></label>
                        <input type="text" id="ch_name" name="ch_name" value="{{ $data['userDetail']->ch_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名字" maxlength="10">
                    </div>
                </div>
                <div class="my-4">
                    <label for="ic" class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.IC') }} <span class="text-red-500">*</span></label>
                    <span class="text-gray-500">{{ __('setupProfile.IC_description') }}</span>
                    <div class="flex items-center my-1">
                        <input id="changeInput" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="changeInputMethod()">
                        <label for="changeInput" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('setupProfile.No_IC') }}</label>
                    </div>
                    <input type="hidden" id="read_ic" value="{{ $data['userDetail']->ic }}">
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
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="relationship" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.relationship') }} <span class="text-red-500">*</span></label>
                        <select id="relationship" name="guardian_relationship_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="{{ $data['guardianDetail']->guardian_relationship_id }}" selected>{{ $data['guardianDetail']->guardianRelationship['name'] }}</option>
                            @foreach ($data['relationships'] as $relationship)
                                @if ($relationship->id !== $data['guardianDetail']->guardian_relationship_id)
                                    <option value="{{ $relationship->id }}">{{ $relationship->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.nationality') }} <span class="text-red-500">*</span></label>
                        <select id="nationality" name="nationality_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="{{ $data['guardianDetail']->nationality_id }}" selected>{{ $data['guardianDetail']->nationality['name'] }}</option>
                            @foreach ($data['nationalities'] as $nationality)
                                @if ($nationality->id !== $data['guardianDetail']->nationality_id)
                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.occupation') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="occupation" name="occupation" value="{{ $data['guardianDetail']->occupation }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Job title" onkeyup="if (/[^|A-Za-z0-9\s/.]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9\s/.]+/g,'')" maxlength="70" required>
                    </div>
                    <div>
                        <label for="income" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.income') }} <span class="text-red-500">*</span></label>
                        {{-- <select id="income" name="income_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="{{ $data['guardianDetail']->income_id }}" selected>{{ $data['guardianDetail']->income['range']  }}</option>
                            @foreach ($data['incomes'] as $income)
                                @if ($income->id !== $data['guardianDetail']->income_id)
                                    <option value="{{ $income->id }}">{{ $income->range }}</option>
                                @endif
                            @endforeach
                        </select> --}}
                        <input type="text" id="income" name="income" value="{{ $data['guardianDetail']->income }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Job title" onkeyup="if (/[^|A-Za-z0-9\s/.]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9\s/.]+/g,'')" maxlength="70" required>
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="tel_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_hp') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="tel_hp" name="tel_hp" value="{{ $data['userDetail']->tel_hp }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" minlength="8" maxlength="20" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required>
                    </div> 
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.email') }}</label>
                        <input type="email" id="email" name="email" value="{{ $data['userDetail']->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@email.com" onkeyup="if (/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$+/g.test(this.value)) this.value = this.value.replace(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$+/g,'')" maxlength="64">
                    </div> 
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="col-span-2">
                        <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.permanent') }}</h3>
                    </div>
                    <div>
                        <label for="p_street1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.line_1') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="p_street1" name="p_street1" value="{{ $data['pAddress']->street1 }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Input street/ building name') }}" onkeyup="if (/[^|A-Za-z0-9/.\s\-,]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9/.\s\-,]+/g,'')" required>
                    </div>
                    <div>
                        <label for="p_street2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.line_2') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="p_street2" name="p_street2" value="{{ $data['pAddress']->street2 }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Input unit/floor') }}" onkeyup="if (/[^|A-Za-z0-9/.\s\-,]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z0-9/.\s\-,]+/g,'')" required>
                    </div>
                    <div>
                        <label for="p_zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.zipcode') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="p_zipcode" name="p_zipcode" value="{{ $data['pAddress']->zipcode }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" minlength="5" maxlength="15" required>
                    </div>
                    <div>
                        <label for="p_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.city') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="p_city" name="p_city" value="{{ $data['pAddress']->city }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|A-Za-z/.\s]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z/.\s]+/g,'')" required>
                    </div>
                    <div>
                        <label for="p_state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.state') }} <span class="text-red-500">*</span></label>
                        <select id="p_state" name="p_state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="{{ $data['pAddress']->state }}" selected>{{ $data['pAddress']->state }}</option>
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
                            <option value="{{ $data['pAddress']->country_id }}" selected>{{ $data['pAddress']->country['name'] }}</option>
                            @foreach ($data['countries'] as $country)
                                @if ($country->id !== $data['pAddress']->country_id)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <script src="/js/noIdentityDocument.js"></script>
       </div>
    </div>

    <script>
                                
        let text = document.getElementById('read_ic').value;
        const myArray = text.split("-");
        const changeInput = document.getElementById('changeInput');
        const ic_section = document.getElementById('ic_section');
        const passport_section = document.getElementById('passport_section');
        const ic1 = document.getElementById('ic1');
        const ic2 = document.getElementById('ic2');
        const ic3 = document.getElementById('ic3');
        const passport = document.getElementById('passport');

        if(myArray.length != 3){
            document.getElementById("passport").value = myArray[0];
            changeInput.checked = true;
            ic_section.style.display = 'none';
            passport_section.style.display = 'block';
        }else{
            document.getElementById("ic1").value = myArray[0]; 
            document.getElementById("ic2").value = myArray[1]; 
            document.getElementById("ic3").value = myArray[2]; 

        }

        function changeInputMethod(){
            if(changeInput.checked){
                ic_section.style.display = 'none';
                passport_section.style.display = 'block';
                passport.setAttribute('required','');
                ic1.removeAttribute('required');
                ic2.removeAttribute('required');
                ic3.removeAttribute('required');
                ic1.value = '';
                ic2.value = '';
                ic3.value = '';

            }else{
                ic_section.style.removeProperty('display');
                passport_section.style.display = 'none';
                passport.removeAttribute('required');
                ic1.setAttribute('required','');
                ic2.setAttribute('required','');
                ic3.setAttribute('required','');
                passport.value = '';
            }
        }
    </script>
</x-app-layout>