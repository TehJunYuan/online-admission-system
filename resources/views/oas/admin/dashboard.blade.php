<x-app-layout>
    @include('layouts.adminNavigation')
    <div class="p-4 mt-14">
        {{-- header --}}
        <h2 class="mx-2 my-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('admin.welcome') }} {{ Auth::user()->roles[0]['name'] }}</h2>
        {{-- end header --}}

        {{-- table --}}
        {{-- end table --}}
    </div>
</x-app-layout>