<form class="m-auto block max-w-md" wire:submit.prevent="save" novalidate="novalidate">
    @include($inputsView)
    @include('livewire.modals.action-buttons', compact('confirmBtnColor','confirmBtnColor','cancelBtnColor','cancelBtnColor'))
</form>
