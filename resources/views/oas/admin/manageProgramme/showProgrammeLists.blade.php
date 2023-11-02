<x-app-layout>
    @include('layouts.aaroNavigation')
    
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-12">
            {{-- header --}}
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/aaro/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <p class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-gray-400">{{ __('Offered Programme') }}</p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ __('Offered programme lists') }}</span>
                    </div>
                </li>
                </ol>
            </nav>
            <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('Offered Programme Lists') }}</h2>
            <p class="text-gray-500 dark:text-gray-400">{{ __('If want to make any changes please contact CCO') }}</p>
            {{-- end header --}}
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-8" id="offeredProgrammeTable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Programme name') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Semester & Year') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($get_all_offered_programme_lists as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->programme['en_name'] }}
                            </th>
                            <td class="px-6 py-4">
                                Semester: {{ $item->semesterYearMapping['semester']->semester }}, Year: {{ $item->semesterYearMapping['year'] }}
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ __('Nothing here') }}
                            </th>
                            <td class="px-6 py-4">
                                {{ __('Nothing here') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#offeredProgrammeTable').DataTable({
            "dom": 'ftp',
            
            initComplete: function() {
                var searchInput = $('div.dataTables_filter input');
                var searchLabel = $('div.dataTables_filter label');

                searchLabel.addClass('dark:text-white');
                searchInput.addClass('block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4');
                searchInput.attr('placeholder', 'Search programme name, semester, year');

            },
            lengthMenu: [[15, 25, 50, 100], [15, 25, 50, 100]],
            language: {
                paginate: {
                    first: '<span class="px-2 py-1 rounded-md bg-red-200 text-red-700 cursor-pointer">First</span>',
                    previous: '<span class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&laquo;</span>',
                    next: '<span class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&raquo;</span>',
                    last: '<span class="px-2 py-1 rounded-md bg-red-200 text-red-700 cursor-pointer">Last</span>',
                }
            }
        });
    });
</script>
</x-app-layout>