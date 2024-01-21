<?php

namespace App\Livewire\Front;

use App\Models\Project as ProjectModel;
use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;

class Project extends Component
{

    public ProjectModel $project;


    public function render()
    {
        SEOTools::setTitle($this->project->title);
        SEOTools::setDescription($this->project->description);
        return view('livewire.front.project')
            ->extends('layouts.app')
            ->section('content');
    }
}
