<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = ['name', 'phone', 'email', 'text', 'files', 'status'];


    //Статус
    const STATUS_ACCEPT = 'accept';
    const STATUS_WORK = 'work';
    const STATUS_REJECT = 'reject';

    //Статуси
    public static $statuses = [
        self::STATUS_ACCEPT => [
            'name'  => 'Прийнятий',
            'class' => 'success',
        ],
        self::STATUS_WORK => [
            'name'  => 'В роботі',
            'class' => 'success',
        ],
        self::STATUS_REJECT => [
            'name'  => 'Відхилений',
            'class' => 'danger',
        ],
    ];

    public static function accept()
    {
        return self::where('status', self::STATUS_ACCEPT)->count();
    }

}
