<?php

namespace App\Livewire\Front;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Artesaos\SEOTools\Facades\SEOTools;

class Projects extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; //Тема пагинации
    public $title = 'Проєкти';
    public $description = 'Проєкти';
    public $heading = 'Проєкти';
    public $text;
    public $limit = 10; //Лимит пагинации



    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.projects', [
            'projects' => Project::isActive()->paginate($this->limit),
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
