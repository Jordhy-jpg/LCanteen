<?php

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $calories;
    public $ingridients;
    public $categories;

    public function mount(): void
    {
        $this->categories = Category::all();
    }

    public function store(): void
    {
        $validated_product = $this->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);
        $validated_detail = $this->validate([
            'calories' => ['required', 'numeric', 'min:0'],
            'ingridients' => ['required', 'string', 'min:0'],
        ]);

        DB::transaction(function () use ($validated_product, $validated_detail): void {
            $product = Product::create($validated_product);
            $product->details()->create($validated_detail);
        });
        $this->redirectRoute('products.index', navigate: true);
    }
};
?>

<div>
    <flux:fieldset>
        <div class="space-y-6">
            <flux:input wire:model="name" label="Product Name" class="w-full" />
            <flux:textarea wire:model="description" label="Description" />
            <flux:textarea wire:model="ingridients" label="Ingridients" />
            {{--  --}}
            <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                <flux:select wire:model="category_id" label="Category">
                    <option value="" selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </flux:select>
                <flux:input wire:model="price" label="Price" placeholder="$" />
                <flux:input wire:model="stock" label="Stock" placeholder="123" />
                <flux:input wire:model="calories" label="Calories" placeholder="1234" />
            </div>
        </div>
        <flux:button wire:click="store" class="mt-8">Add Product</flux:button>
    </flux:fieldset>
</div>
