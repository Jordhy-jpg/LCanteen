<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:sidebar sticky collapsible="mobile"
        class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand :href="route('categories.index')" logo="/favicon.svg" name="LCanteen" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>
        <flux:sidebar.search placeholder="Search..." />
        <flux:sidebar.nav>
            <flux:sidebar.item icon="squares-2x2" :href="route('categories.index')"
                :current="request()->routeIs('categories.*')" wire:navigate>Categories</flux:sidebar.item>
            <flux:sidebar.item icon="utensils" :href="route('products.index')"
                :current="request()->routeIs('products.*', 'details.*')" wire:navigate>Products</flux:sidebar.item>
            {{-- <flux:sidebar.group expandable heading="Favorites" class="grid">
                <flux:sidebar.item href="#">Marketing site</flux:sidebar.item>
                <flux:sidebar.item href="#">Android app</flux:sidebar.item>
                <flux:sidebar.item href="#">Brand guidelines</flux:sidebar.item>
            </flux:sidebar.group> --}}
        </flux:sidebar.nav>
        <flux:modal.trigger name="add-item">
            <flux:button>Add Item</flux:button>
        </flux:modal.trigger>

        <flux:modal name="add-item" class="w-full max-w-2xl">
            <div class="space-y-6">
                {{-- <div>
                    <flux:heading size="lg">Add Item</flux:heading>
                </div> --}}
                <div x-data="{ tab: 'add_category' }">
                    <div role="group" aria-label="Choose item type">
                        <flux:button type="button" x-on:click="tab = 'add_category'"
                            x-bind:aria-pressed="tab === 'add_category'"
                            class="mb-4 aria-pressed:bg-zinc-900! aria-pressed:text-white! dark:aria-pressed:bg-white! dark:aria-pressed:text-zinc-900!">
                            Add Category
                        </flux:button>

                        <flux:button type="button" x-on:click="tab = 'add_product'"
                            x-bind:aria-pressed="tab === 'add_product'"
                            class="mb-4 aria-pressed:bg-zinc-900! aria-pressed:text-white! dark:aria-pressed:bg-white! dark:aria-pressed:text-zinc-900!">
                            Add Product
                        </flux:button>
                    </div>

                    <div x-show="tab === 'add_category'">
                        <livewire:categories.create />
                    </div>

                    <div x-show="tab === 'add_product'" x-cloak>
                        <livewire:products.create />
                    </div>
                </div>
            </div>
        </flux:modal>
        <flux:sidebar.spacer />
        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
            <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
        </flux:sidebar.nav>
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    <flux:menu.radio>Truly Delta</flux:menu.radio>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" alignt="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    <flux:menu.radio>Truly Delta</flux:menu.radio>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    <flux:main>
        {{ $slot }}

        @livewireScripts
    </flux:main>
    @fluxScripts
</body>

</html>
