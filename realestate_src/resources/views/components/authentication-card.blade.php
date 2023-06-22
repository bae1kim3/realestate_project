{{-- <header class="bg-white shadow dark:bg-gray-800">
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8 dark:text-gray-100">
        {{ 'Welcome' }}
    </div>
</header> --}}
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 dark:text-white">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-gray-800 dark:text-white">
        {{ $slot }}
    </div>
</div>


