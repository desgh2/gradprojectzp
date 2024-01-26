<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;

class PrimaryMenu extends Component
{
    public function render()
    {
        return view('livewire.front.primary-menu', [
            'primary_menu' => Category::getPrimaryMenu(),
        ]);
    }
}
