<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.main')]

    #[Rule('required|string|max:255', message: 'nama harus diisi')]
    public $name;

    #[Rule('required|string|max:255')]
    public $description;

    #[Rule('required|numeric')]
    public $price;

    #[Rule('nullable|sometimes|image|max:1024|mimes:jpg,jpeg,png')]
    public $image;

    public function store()
    {
        $this->validate();
        $input = $this->all();

        if ($this->image) {
            $imageName = date('YmdHis') . '.' . $this->image->extension();
            $this->image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        }

        Product::create($input);
        session()->flash('message', 'Product successfully created.');
        return $this->redirect('products', navigate: true);
    }

    public function render()
    {
        return view('livewire.dashboard.product-create');
    }
}
