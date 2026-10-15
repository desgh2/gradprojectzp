<?php

namespace App\Livewire\Front;

use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;

class Contact extends Component
{

    public $title = 'Контакти';
    public $description = 'Контакти';

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.contact')
            ->extends('layouts.app')
            ->section('content');
    }
}
