<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Post;

class News extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; //Тема пагинации
    public $title = 'Новини';
    public $description = 'Новини';
    public $heading = 'Новини';
    public $text;
    public $limit = 10; //Лимит пагинации

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.news', [
            'news' => Post::isActive()->paginate($this->limit),
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
