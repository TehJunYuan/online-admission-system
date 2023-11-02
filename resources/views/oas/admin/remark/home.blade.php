<x-app-layout>

    <div class="px-4 py-2">
        <h2 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ __('Application of') }} <span class="font-bold">{{ $userDetail->en_name }}</span></h2>
        @if ($remarkDate)
            <p class="mb-3 text-gray-500 dark:text-gray-400">{{ __('Last Updated: ') }} {{ $remarkDate->updated_at }}</p>
        @else 
            <p class="mb-3 text-gray-500 dark:text-gray-400">{{ __('Last Updated: None') }} </p>
        @endif

        <form action="{{ route('remark.create') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <input type="hidden" id="application_record_id" name="application_record_id" value="{{ $APPLICATIONRECORDID }}">
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Your message') }} <span class="text-red-500">*</span></label>
                    <textarea id="content" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        <ol class="relative border-l border-gray-200 dark:border-gray-700" chat-content>     
            @for ($i = 0; $i < count($allRemarkData); $i++)
                @if ($allRemarkData[$i]->user->roles[0]['name'] == 'AFO')
                    <li class="mb-10 ml-4" chat-content>
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">{{ __('AFO') }}</span>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('d F Y h:iA', strtotime($allRemarkData[$i]->applicationRemark['created_at'])) }}</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('By: ') }}{{ $allRemarkData[$i]->user['name'] }}</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $allRemarkData[$i]->applicationRemark['content'] }}</p>
                    </li>
                @elseif ($allRemarkData[$i]->user->roles[0]['name'] == 'AARO')
                    <li class="mb-10 ml-4" chat-content>
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-indigo-400 border border-indigo-400">{{ __('AARO') }}</span>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('d F Y h:iA', strtotime($allRemarkData[$i]->applicationRemark['created_at'])) }}</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('By: ') }}{{ $allRemarkData[$i]->user['name'] }}</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $allRemarkData[$i]->applicationRemark['content'] }}</p>
                    </li>
                @elseif ($allRemarkData[$i]->user->roles[0]['name'] == 'SRO')
                    <li class="mb-10 ml-4" >
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-pink-400 border border-pink-400">{{ __('SRO') }}</span>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('d F Y h:iA', strtotime($allRemarkData[$i]->applicationRemark['created_at'])) }}</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('By: ') }}{{ $allRemarkData[$i]->user['name'] }}</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $allRemarkData[$i]->applicationRemark['content'] }}</p>
                    </li>
                @endif
            @endfor
        </ol>
    </div>
    <script>
        setInterval(function() {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url: "{{ url('getConversationMessage') }}",
            method: "get",
            data: {
                id: $("#application_record_id").val()
            },
            success: function(data){
                $('[chat-content]').html('');
                console.log(data);
                $.each(data, function(i, v) {
                    if(v.rolesname == "AFO")
                    {
                        $('[chat-content]').append(`
                    <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">{{ __('AFO') }}</span>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">${new Date(v.created_at).toLocaleString()}</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('By: ') }}${v.name}</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">${v.content}</p>
                    </li>
                    `);
                    }
                    else if(v.rolesname == "AARO"){
                        $('[chat-content]').append(`
                    <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-indigo-400 border border-indigo-400">{{ __('AARO') }}</span>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">${new Date(v.created_at).toLocaleString()}</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('By: ') }}${v.name}</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">${v.content}</p>
                    </li>
                    `);
                    }
                    else if(v.rolesname == "SRO"){
                        $('[chat-content]').append(`
                    <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-pink-400 border border-pink-400">{{ __('SRO') }}</span>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">${new Date(v.created_at).toLocaleString()}</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('By: ') }}${v.name}</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">${v.content}</p>
                    </li>
                    `);
                    }
                })
            }
        })
        }, 5000);
      

    </script>
</x-app-layout>

