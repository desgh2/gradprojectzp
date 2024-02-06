<?php

namespace App\Livewire\Front;

use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\WithFileUploads;
use App\Models\Feedback as FeedbackModel;
use Livewire\Component;

class Feedback extends Component
{

    use WithFileUploads;

    public $title = 'Зворотній зв’язок';
    public $description = 'Зворотній зв’язок';
    public $name, $phone, $email, $text;
    public $files = []; //файли
    public $files_count = 1; //кількість файлів
    public $show_message = false; //показати повідомлення

    public function send()
    {
        ///Валідація
        $validated = $this->validate([
            'name' => 'required|min:3',
            'text' => 'required|min:3',
            'email' => 'required|min:3|email',
        ]);

        //Створення фидбеку
        $feedback = FeedbackModel::create([
            'name'  => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'text'  => $this->text,
            'status'  => FeedbackModel::STATUS_ACCEPT,
        ]);

        //Додавання файлів
        if ($this->files) {
            $files_name = [];
            foreach ($this->files as $file) {
                $files_name[] = $file->store('feedback/' . $feedback->id);
            }
            //Збереження файлів
            $feedback->update(['files' => json_encode($files_name)]);
        }

        $this->files_count++; //обнулити кількість файлів
        $this->reset(['name', 'phone', 'email', 'text']); //скинути на дефолт
        $this->show_message = true; //показати повідомлення
    }

    public function render()
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        return view('livewire.front.feedback')
            ->extends('layouts.app')
            ->section('content');
    }
}
