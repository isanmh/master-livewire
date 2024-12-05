<?php

namespace App\Livewire\Crud;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CardDetail extends Component
{
    #[Layout('layouts.master')]

    public $name, $description, $price, $image, $product;

    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->image = $this->product->image;
    }

    public function render()
    {
        return view('livewire.crud.card-detail');
    }
}
