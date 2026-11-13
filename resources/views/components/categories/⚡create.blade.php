<?php

use Livewire\Component;
use App\Models\Category;

new class extends Component {
    public $name;
    public $description;

    public function store(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
        Category::create($validated);
        $this->redirectRoute('categories.index', navigate: true);
    }
};
?>

<div>
    <flux:field class="mb-2">
        <flux:label>Name</flux:label>
        <flux:input wire:model="name" type="text" />
        <flux:error name="name" />
    </flux:field>
    <flux:field class="mb-4">
        <flux:label>Description</flux:label>
        <flux:textarea wire:model="description" />
        <flux:error name="description" />
    </flux:field>
    <flux:field>
        <flux:button wire:click="store">Add Category</flux:button>
    </flux:field>
</div>
