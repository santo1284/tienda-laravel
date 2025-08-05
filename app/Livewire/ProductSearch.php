<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;


class ProductSearch extends Component
{
    use WithPagination;
    public $query = "";
    public $category = null;
    public $categories;

    public function mount(): void{
       $this->categories = Category::all(); 
    }
    public function updatedQuery(): void
    {
        $this->resetPage();
    }
    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $this->products = Product::query()
        ->when($this->query, function (Builder $query): void { //
        $query->where('name', 'like', '%' . $this->query . '%');
        })
        ->when($this->category, function (Builder $query): void { //
        $query->where('category_id', $this->category);
        })
        ->paginate(3);


        return View('livewire.product-search', ['products'=> $this->products]);
    }
}
