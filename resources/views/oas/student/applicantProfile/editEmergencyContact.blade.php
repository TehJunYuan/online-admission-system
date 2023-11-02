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
                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-white">{{ __('stepper.profile_edit_step_3') }}</span>
                    </div>
                </li>
                </ol>
            </nav>
            {{-- end header --}}

            {{-- form --}}
            <form action="{{ route('emergencyContact.update') }}" method="post" class="mt-8">
                @csrf

                <input type="hidden" name="emergency_contact_id1" value="{{ $data['emergencyContact1']->id }}">
                <input type="hidden" name="emergency_contact_id2" value="{{ $data['emergencyContact2']->id }}">
                <input type="hidden" name="user_detail_id1" value="{{ $data['userDetail1']->id }}">
                <input type="hidden" name="user_detail_id2" value="{{ $data['userDetail2']->id }}">

                <div class="flex justify-between mb-4">
                    <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('stepper.profile_edit_step_3') }}</h2>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('button.save') }}</button>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="col-span-2">
                        <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.ec_1') }}</h3>
                    </div>
                    <div>
                        <label for="en_name1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.en_name') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="en_name1" name="en_name1" value="{{ $data['userDetail1']->en_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" onkeyup="if (/[^|A-Za-z\s\@]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z\s\@]+/g,'')" maxlength="70" required>
                    </div>
                    <div>
                        <label for="ch_name1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.ch_name') }} <span class="text-gray-500">{{ __('setupProfile.any') }}</span></label>
                        <input type="text" id="ch_name1" name="ch_name1" value="{{ $data['userDetail1']->ch_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名字" maxlength="10">
                    </div>
                    <div>
                        <label for="tel_hp1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_hp') }} <span class="text-red-500">*</span></label>
                        <input type="tel" id="tel_hp1" name="tel_hp1" value="{{ $data['userDetail1']->tel_hp }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required minlength="8" maxlength="20">
                    </div> 
                    <div>
                        <label for="guardian_relationship_id1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.relationship') }} <span class="text-red-500">*</span></label>
                        <select id="guardian_relationship_id1" name="guardian_relationship_id1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="{{ $data['emergencyContact1']->guardian_relationship_id }}" seleced>{{ $data['emergencyContact1']->guardianRelationship['name'] }}</option>
                            @foreach ($data['relationships'] as $relationship)
                                @if ($relationship->id !== $data['emergencyContact1']->guardian_relationship_id)
                                    <option value="{{ $relationship->id }}">{{ $relationship->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="col-span-2">
                        <h3 class="block text-base font-bold text-gray-900 dark:text-white">{{ __('setupProfile.ec_2') }}</h3>
                    </div>
                    <div>
                        <label for="en_name2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.en_name') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="en_name2" name="en_name2" value="{{ $data['userDetail2']->en_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" onkeyup="if (/[^|A-Za-z\s\@]+/g.test(this.value)) this.value = this.value.replace(/[^|A-Za-z\s\@]+/g,'')" maxlength="70" required>
                    </div>
                    <div>
                        <label for="ch_name2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.ch_name') }} <span class="text-gray-500">{{ __('setupProfile.any') }}</span></label>
                        <input type="text" id="ch_name2" name="ch_name2" value="{{ $data['userDetail2']->ch_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名字" maxlength="10">
                    </div>
                    <div>
                        <label for="tel_hp2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.tel_hp') }} <span class="text-red-500">*</span></label>
                        <input type="tel" id="tel_hp2" name="tel_hp2" value="{{ $data['userDetail2']->tel_hp }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" onkeyup="if (/[^|0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|0-9]+/g,'')" required minlength="8" maxlength="20">
                    </div> 
                    <div>
                        <label for="guardian_relationship_id2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('setupProfile.relationship') }} <span class="text-red-500">*</span></label>
                        <select id="guardian_relationship_id2" name="guardian_relationship_id2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="{{ $data['emergencyContact2']->guardian_relationship_id }}" selected>{{ $data['emergencyContact2']->guardianRelationship['name'] }}</option>
                            @foreach ($data['relationships'] as $relationship)
                                @if ($relationship->id !== $data['emergencyContact2']->guardian_relationship_id)
                                    <option value="{{ $relationship->id }}">{{ $relationship->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            {{-- end form --}}
       </div>
    </div>
</x-app-layout> 