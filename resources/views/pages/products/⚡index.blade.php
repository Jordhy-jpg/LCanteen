<?php

use Livewire\Component;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    #[Computed]
    public function products(): LengthAwarePaginator
    {
        return Product::latest()->orderByDesc('id')->paginate(15);
    }
};
?>

<div>
    <livewire:products.list />
</div>
