<?php

namespace App\Livewire\Front;

use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;

class SubCategory extends Component
{


    public Category $parent;
    public $category;

    function mount($category) {
        $this->category = Category::with('category')->whereSlug($category)->firstOrFail();
    }

    public function render()
    {
        SEOTools::setTitle($this->category->title);
        SEOTools::setDescription($this->category->description);
        return view('livewire.front.sub-category')
            ->extends('layouts.app')
            ->section('content');
    }
}
