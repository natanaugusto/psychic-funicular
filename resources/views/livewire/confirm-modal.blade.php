<div
    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
            <div
                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: outline/exclamation -->
                <x-icon name="{{ $icon }}" class="text-{{ $iconColor }}-600 h-6 w-6" />
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">{{ __($title) }}</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">{{ __($description) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button wire:click="confirm" type="button"
            class="bg-{{ $confirmBtnColor }}-600 hover:bg-{{ $confirmBtnColor }}-700 focus:ring-{{ $confirmBtnColor }}-500 inline-flex w-full justify-center rounded-md border border-transparent px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
            {{ __($confirmBtnLabel) }}
        </button>
        <button wire:click="cancel" type="button"
            class="bg-{{ $cancelBtnColor }}-200 text-{{ $cancelBtnColor }}-700 hover:bg-{{ $cancelBtnColor }}-50 mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 px-4 py-2 text-base font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            {{ __($cancelBtnLabel) }}
        </button>
    </div>
</div>
