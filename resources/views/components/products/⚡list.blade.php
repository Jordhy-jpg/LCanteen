<?php

use Livewire\Component;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    public $category;
    public $paginate = 15;

    #[Computed]
    public function products(): LengthAwarePaginator
    {
        if ($this->category) {
            return Product::where('category_id', $this->category)->latest()->orderByDesc('id')->paginate($this->paginate);
        }
        return Product::latest()->orderByDesc('id')->paginate($this->paginate);
    }
};
?>

<div>
    <flux:table :paginate="$this->products" class="w-full">
        <flux:table.columns>
            <flux:table.column class="w-1/10">Product</flux:table.column>
            <flux:table.column class="w-1/10">Category</flux:table.column>
            <flux:table.column class="w-3/5">Description</flux:table.column>
            <flux:table.column class="w-1/10">Price</flux:table.column>
            <flux:table.column class="w-1/10">Stock</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($this->products as $product)
                <flux:table.row wire:key="product-{{ $product->id }}" class="whitespace-normal wrap-break-word">
                    <flux:table.cell>
                        <flux:link :href="route('details.show', $product)" variant="subtle" wire:navigate>
                            {{ $product->name }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>
                        <flux:link :href="route('categories.show', $product->category)" variant="subtle" wire:navigate>
                            {{ $product->category->name }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>{{ $product->description }}</flux:table.cell>
                    <flux:table.cell>${{ $product->price }}</flux:table.cell>
                    <flux:table.cell>{{ $product->stock }}</flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4">No products found.</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>
