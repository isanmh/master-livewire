<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    #[Layout('components.layouts.main')]
    // #[Title('Products List')]

    public $search;

    use WithPagination;

    // updating+Search
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
        return $this->redirect('products', navigate: true);
    }

    public function render()
    {
        // $products = Product::all();
        // search by name
        $products = Product::where('name', 'like', '%' . $this->search . '%')->paginate(3);
        return view('livewire.dashboard.products-list', compact('products'));
    }
}
