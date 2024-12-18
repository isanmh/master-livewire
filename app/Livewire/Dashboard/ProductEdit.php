<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.main')]

    #[Rule('required|string|max:255', message: 'nama harus diisi')]
    public $name;

    #[Rule('required|string|max:255')]
    public $description;

    #[Rule('required|numeric')]
    public $price;

    #[Rule('nullable|sometimes|max:1024|mimes:jpg,jpeg,png')]
    public $image;

    public $oldImage;

    public $product;

    public function mount($id)
    {
        $this->product = Product::find($id);
        // dd($product);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->oldImage = $this->product->image;
    }

    public function edit($id)
    {
        $this->product = Product::find($id);
        // dd($product);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->image = $this->product->image;
    }

    public function update()
    {
        $this->validate();
        $input = $this->all();

        if ($this->image) {
            // delete old image
            if ($this->oldImage) {
                unlink(storage_path('app/public/assets/images/' . $this->product->image));
            }
            $imageName = date('YmdHis') . '-' . $this->image->getClientOriginalName();
            $this->image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        } else {
            $input['image'] = $this->oldImage;
        }

        $this->product->update($input);
        session()->flash('message', 'Product successfully updated.');
        return $this->redirect('/products', navigate: true);
    }

    public function render()
    {
        return view('livewire.dashboard.product-edit');
    }
}
