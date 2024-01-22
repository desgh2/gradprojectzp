<?php

namespace App\Livewire\Front;

use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;

class Feedback extends Component
{

    public $title = 'Зворотній зв’язок';
    public $description = 'Зворотній зв’язок';

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.feedback')
            ->extends('layouts.app')
            ->section('content');
    }
}
