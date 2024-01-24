<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Post as PostModel;

class Post extends Component
{

    public PostModel $post;

    public function render()
    {
        SEOTools::setTitle($this->post->title);
        SEOTools::setDescription($this->post->description);
        return view('livewire.front.post')
        ->extends('layouts.app')
        ->section('content');
    }
}
