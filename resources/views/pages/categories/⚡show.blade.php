<?php

use Livewire\Component;

new class extends Component {
    public $category;
};
?>

<div>
    <livewire:products.list :category="$category" />
</div>
