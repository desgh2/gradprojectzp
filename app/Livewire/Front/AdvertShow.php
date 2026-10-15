<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Advert;

class AdvertShow extends Component
{
    public Advert $advert;

    public function render()
    {
        SEOTools::setTitle($this->advert->title);
        SEOTools::setDescription($this->advert->description);
        return view('livewire.front.advert-show')
            ->extends('layouts.app')
            ->section('content');
    }
}
