<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProductShow extends Component
{
    #[Layout('components.layouts.main')]

    public $name, $description, $price, $image;

    public function mount($id)
    {
        $product = Product::find($id);
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->image = $product->image;
    }

    public function render()
    {
        return view('livewire.dashboard.product-show');
    }
}
