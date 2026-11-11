<?php

use Livewire\Component;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    #[Computed]
    public function categories(): LengthAwarePaginator
    {
        return Category::latest()->withCount('products')->paginate(5);
    }
};
?>

<div>
    <flux:table :paginate="$this->categories" class="w-full">
        <flux:table.columns>
            <flux:table.column class="w-1/5">Category</flux:table.column>
            <flux:table.column class="w-3/5">Description</flux:table.column>
            <flux:table.column class="w-1/5">Products</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($this->categories as $category)
                <flux:table.row wire:key="category-{{ $category->id }}" class="whitespace-normal wrap-break-word">
                    <flux:table.cell>{{ $category->name }}</flux:table.cell>
                    <flux:table.cell>{{ $category->description }}</flux:table.cell>
                    <flux:table.cell>{{ $category->products_count }}</flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell>No categories found.</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>
