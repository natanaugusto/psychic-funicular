<div class="float-left">
    <button type="button" wire:click.prevent="$emit('openModal', 'form-modal', {{ json_encode(['inputsView' => 'companies.inputs']) }})"
        class="inline-block rounded border border-gray-300 bg-yellow-300 p-1 text-xs text-gray-800 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2">
        <x-icon name="pencil-alt" />
    </button>
    <button type="button" wire:click.prevent="$emit('openModal', 'confirm-modal', {{ json_encode([ 'title' => __('Are you sure?'), 'description' => __('Do you realy sure that you want to exclude this register'), 'confirmAction' => $confirmAction ]) }});delete({{ $id }})"
        class="inline-block rounded border border-gray-300 bg-red-300 p-1 text-xs text-gray-800 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2">
        <x-icon name="trash" />
    </button>
</div>
