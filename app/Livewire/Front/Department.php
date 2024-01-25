<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Department as DepartmentModel;

class Department extends Component
{

    public DepartmentModel $department;

    public function render()
    {
        SEOTools::setTitle($this->department->name);
        SEOTools::setDescription($this->department->description);
        return view('livewire.front.department')
            ->extends('layouts.app')
            ->section('content');
    }
}
