<?php

namespace App\Livewire\Crud;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormEdit extends Component
{
    use WithFileUploads;
    #[Layout('layouts.master')]

    public $name, $description, $price, $image, $product, $oldImage;

    public function mount($id)
    {
        $this->product = Product::find($id);
        // dd($product);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->oldImage = $this->product->image;
    }

    public function update()
    {
        $input = $this->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'price' => 'numeric',
            'image' => 'nullable|sometimes|max:1024|mimes:jpg,jpeg,png'
        ]);

        if ($this->image) {
            // delete old image
            if ($this->oldImage) {
                unlink(storage_path('app/public/assets/images/' . $this->product->image));
                // Storage::delete('public/assets/images/' . $this->product->image);
            }
            $imageName = date('YmdHis') . '-' . $this->image->getClientOriginalName();
            $this->image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        } else {
            $input['image'] = $this->oldImage;
        }

        $this->product->update($input);
        session()->flash('message', 'Product successfully updated.');
        return $this->redirect('/crud');
    }

    public function render()
    {
        return view('livewire.crud.form-edit');
    }
}
