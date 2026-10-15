<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;

class FooterMenu extends Component
{
    public function render()
    {
        return view('livewire.front.footer-menu', [
            'footer_menu' => Category::with('subcategories')->whereNull('parent')
                ->where('footer_menu', TRUE)
                ->get(),
        ]);
    }
}
