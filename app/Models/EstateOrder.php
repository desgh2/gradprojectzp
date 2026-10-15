<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateOrder extends Model
{
    use HasFactory;

     protected $table = 'estate_order';

    protected $fillable = ['slug', 'name', 'phone', 'comment', 'status'];


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
}
