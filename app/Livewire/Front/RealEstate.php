<?php

namespace App\Livewire\Front;

use App\Models\RealEstate as EstateModel;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\WithPagination;
use Livewire\Component;

class RealEstate extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; //Тема пагинации
    public $title = 'Нерухоме майно';
    public $description = 'Нерухоме майно';
    public $heading = 'Нерухоме майно';
    public $limit = 10;

    public $queryString = ['area'];

    public $area;


    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        $query = EstateModel::query();
        $query->when($this->area, function ($q) {
            $q->where('district_id', $this->area);
        });
        $query->isActive();
        $rows = $query->paginate($this->limit);
        return view('livewire.front.real-estate', [
            'rows' => $rows,
            'districts' => EstateModel::$districts,
        ])
            ->extends('layouts.app')
            ->section('content');
    }



}
