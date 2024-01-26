<?php

namespace App\Livewire;

use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Setting;
use App\Models\Department;
use App\Models\Post;
use Livewire\Component;


class HomePage extends Component
{

    public $title = 'Головна сторінка';
    public $description = 'Головна сторінка';
    public $heading = '';
    public $text;

    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->title = $setting->title;
            $this->description = $setting->description;
            $this->heading = $setting->heading;
            $this->text = $setting->text;
        }
    }

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.home-page', [
            'departments' => Department::isActive()->get(),
            'news' => Post::isActive()->take(6)->latest()->get(),

        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
