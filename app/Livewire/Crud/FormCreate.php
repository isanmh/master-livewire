<?php

namespace App\Livewire\Crud;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormCreate extends Component
{
    use WithFileUploads;

    #[Layout('layouts.master')]

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
            $imageName = date('YmdHis') . '-' . $this->image->getClientOriginalName();
            $this->image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        } else {
            $input['image'] = '';
        }

        Product::create($input);
        session()->flash('message', 'Product successfully created.');
        return $this->redirect('/crud', navigate: true);
    }

    public function render()
    {
        return view('livewire.crud.form-create');
    }
}
