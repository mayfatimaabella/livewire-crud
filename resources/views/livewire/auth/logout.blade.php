<button type="button" class="dropdown-item" wire:click="logout">
    <span wire:loading.remove wire:target="logout">Logout</span>
    <span wire:loading wire:target="logout">Logging out...</span>
</button>
