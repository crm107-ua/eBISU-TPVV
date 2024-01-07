<button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-700 transition ease-in-out duration-150'
    ]) }}
    onclick="window.location='/'">
    {{ $slot }}
</button>
