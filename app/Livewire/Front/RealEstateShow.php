<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\RealEstate;

class RealEstateShow extends Component
{

    public RealEstate $estate;

    public function render()
    {
        SEOTools::setTitle($this->estate->title);
        SEOTools::setDescription($this->estate->description);
        return view('livewire.front.real-estate-show')
            ->extends('layouts.app')
            ->section('content');
    }
}
