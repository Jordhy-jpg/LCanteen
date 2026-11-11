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
    <flux:table :paginate="$this->categories">
        <flux:table.columns>
            <flux:table.column>Category</flux:table.column>
            <flux:table.column>Description</flux:table.column>
            <flux:table.column>Products</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($this->categories as $category)
                <flux:table.row>
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
