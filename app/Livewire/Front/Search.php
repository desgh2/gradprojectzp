<?php

namespace App\Livewire\Front;

use App\Models\Project;
use App\Models\Post;
use App\Models\Category;
use App\Models\Person;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class Search extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; //Тема пагинации
    public $title = 'Пошук на сайті';
    public $description = '';
    public $heading = 'Пошук';
    public $limit = 10; //Лимит пагинации
    //public $search;

    /* function mount(Request $request) {
        dd($request->s);
    } */


    public function render()
    {

        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.search', [
            'projects' => Project::where('name', 'like', '%' . request('s') . '%')->paginate($this->limit),
            'news' => Post::where('name', 'like', '%' . request('s') . '%')->paginate($this->limit),
            //'persons' => Person::where('name', 'like', '%' . request('s') . '%')->isActive()->paginate($this->limit),
            //'departments' => Department::where('name', 'like', '%' . request('s') . '%')->isActive()->paginate($this->limit),
        ])->extends('layouts.app')
        ->section('content');

    }
}
