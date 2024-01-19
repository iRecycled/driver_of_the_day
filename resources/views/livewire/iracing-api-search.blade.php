<div>
    <form wire:submit.prevent="search">
        <input type="text" wire:model="searchQuery">
        <button class="bg-blue-500 font-bold py-2 px-4 rounded" type="submit">Submit</button>
    </form>
</div>
