<?php

namespace App\Livewire\Front;

use App\Models\Person;
use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;

class Persons extends Component
{

    protected $paginationTheme = 'bootstrap'; //Тема пагинации
    public $title = 'Керівництво';
    public $description = 'Керівництво';
    public $heading = 'Керівництво';

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.persons', [
            'persons' => Person::isActive()->get(),
        ])
            ->extends('layouts.app')
            ->section('content');

    }
}
