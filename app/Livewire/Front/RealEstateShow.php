<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\RealEstate;
use App\Models\EstateOrder;
use Mail;

class RealEstateShow extends Component
{

    public RealEstate $estate;
    public $callback_name, $callback_phone;
    public $show_message = false; //показати повідомлення

    public function send()
    {
        //Валідація
       $validated = $this->validate([
            'callback_name' => 'required|min:3|max:30',
            'callback_phone' => 'required|min:3|max:30',
        ]);

        //Створення фидбеку
        $estate_order = EstateOrder::create([
            'title'  => $this->estate->name,
            'slug'  => $this->estate->slug,
            'name'  => $this->callback_name,
            'phone' => $this->callback_phone,
            'status'  => EstateOrder::STATUS_ACCEPT,
        ]);

        $this->reset(['callback_name', 'callback_phone']); //скинути на дефолт
        $this->show_message = true; //показати повідомлення

        Mail::send('emails.estateorder', ['order' => $estate_order], function ($message) {
            $message->to('gradproj@zp.gov.ua', 'КП Градпроект')
            // $message->to('wdesgit@gmail.com', 'КП Градпроект')
                ->subject('Нова заявка на оренду нерухомості');
                $message->from('gradproekt.zp.ua@gmail.com', 'Форма оренди нерухомості');
        });
    }


    public function render()
    {
        SEOTools::setTitle($this->estate->title);
        SEOTools::setDescription($this->estate->description);
        return view('livewire.front.real-estate-show')
            ->extends('layouts.app')
            ->section('content');
    }
}
