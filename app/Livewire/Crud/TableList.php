<?php

namespace App\Livewire\Crud;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class TableList extends Component
{
    use WithPagination;

    #[Layout('layouts.master')]

    public $search;

    // updating+Search lifecycle
    public function updatingSearch()
    {
        // $this->resetPage();
        $this->gotoPage(1);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        // delete image
        if ($product->image) {
            unlink(storage_path('app/public/assets/images/' . $product->image));
        }

        $product->delete();
        session()->flash('message', 'Product successfully deleted.');
        return redirect()->to('/crud');
    }

    // show by id
    public function show($id)
    {
        return redirect()->to('/crud/show/' . $id);
    }

    public function render()
    {
        // $products = Product::all();
        $products = Product::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(3);
        return view('livewire.crud.table-list', compact('products'));
    }
}
