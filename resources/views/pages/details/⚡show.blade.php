<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component {
    public Product $product;
};
?>

<div class="flex max-w-3xl flex-col gap-8">
    <flux:heading size="2xl" level="1" class="mt-2 wrap-break-word">{{ $this->product->name }}</flux:heading>

    <flux:separator />

    <dl class="grid gap-8 sm:grid-cols-[10rem_minmax(0,1fr)]">
        <div class="flex min-w-0 flex-col gap-3">
            <dt class="font-semibold text-zinc-800 dark:text-white">Calories</dt>
            <dd class="text-base tabular-nums text-zinc-800 dark:text-white">
                {{ $this->product->details?->calories ?? 'Not provided' }}
            </dd>
        </div>

        <div class="flex min-w-0 flex-col gap-3">
            <dt class="font-semibold text-zinc-800 dark:text-white">Ingredients</dt>
            <dd class="whitespace-pre-line wrap-break-word text-base leading-relaxed text-zinc-600 dark:text-zinc-300">{{ $this->product->details?->ingridients ?? 'Not provided' }}</dd>
        </div>
    </dl>
</div>
