<form class="m-auto block max-w-md" wire:submit.prevent="save" novalidate="novalidate">
    @include($inputsView)
    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button type="button"
            class="bg-green-600 hover:bg-green-700 focus:ring-green-500 inline-flex w-full justify-center rounded-md border border-transparent px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
            {{ __('Save') }}
        </button>
        <button type="button"
            class="bg-gray-200 text-gray-700 hover:bg-gray-50 mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 px-4 py-2 text-base font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            {{ __('Cancel') }}
        </button>
    </div>
</form>
