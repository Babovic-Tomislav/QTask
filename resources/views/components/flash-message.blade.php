@if ($message = Session::get('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 text-center" role="alert">
        <span class="font-medium">{{ $message }}</span>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 text-center" role="alert">
        <span class="font-medium">{{ $message }}</span>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800 text-center" role="alert">
        <span class="font-medium">{{ $message }}</span>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800 text-center" role="alert">
        <span class="font-medium">{{ $message }}</span>
    </div>
@endif