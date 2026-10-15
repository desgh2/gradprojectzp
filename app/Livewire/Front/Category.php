<?php

namespace App\Livewire\Front;

use App\Models\Category as CategoryModel;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;

class Category extends Component
{

    public CategoryModel $category;

    public function render()
    {
        SEOTools::setTitle($this->category->title);
        SEOTools::setDescription($this->category->description);
        return view('livewire.front.category')
            ->extends('layouts.app')
            ->section('content');
    }
}
