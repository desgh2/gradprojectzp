<?php

namespace App\Livewire\Front;

use App\Models\Advert as AdvertModel;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Advert extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap'; //Тема пагинации
    public $title = 'Розташування зовнішньої реклами в місті Запоріжжя';
    public $description = 'Розташування зовнішньої реклами в місті Запоріжжя';
    public $heading = 'Розташування зовнішньої реклами в місті Запоріжжя';
    public $limit = 10;

    public $queryString = ['area', 'search'];

    public $area = '';
    public $search = '';

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        $query = AdvertModel::query();
        $query->when($this->area, function ($q) {
            $q->where('district_id', $this->area);
        });
        $query->when($this->search, function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%');
        });
        
        $query->latest();
    	$query->where('status', 'active');
        $rows = $query->paginate($this->limit);

        //leaflet
        $all = AdvertModel::select('id', 'name', 'slug', 'lat', 'lon')
            ->where('lat', '!=', null)
            ->where('lon', '!=', null)
            ->where('status', 'active')
            ->get();

        return view('livewire.front.advert', [
            'rows' => $rows,
            'all' => $all,
            'districts' => AdvertModel::$districts,
        ])
            ->extends('layouts.app')
            ->section('content');
    }
    
}
