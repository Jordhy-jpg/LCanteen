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
        return Category::latest()->orderByDesc('id')->withCount('products')->paginate(5);
    }
};
?>

<div>
    <flux:table :paginate="$this->categories" class="w-full">
        <flux:table.columns>
            <flux:table.column class="w-1/5"><flux:text size="lg" variant="strong">Category</flux:text></flux:table.column>
            <flux:table.column class="w-3/5"><flux:text size="lg" variant="strong">Description</flux:text></flux:table.column>
            <flux:table.column class="w-1/5"><flux:text size="lg" variant="strong">Products</flux:text></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($this->categories as $category)
                <flux:table.row wire:key="category-{{ $category->id }}" class="whitespace-normal wrap-break-word">
                    <flux:table.cell>
                        <flux:link :href="route('categories.show', $category)" variant="subtle" wire:navigate>
                            {{ $category->name }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>{{ $category->description }}</flux:table.cell>
                    <flux:table.cell>{{ $category->products_count }}</flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="3">No categories found.</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>
