<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = ['name', 'surname', 'byfather', 'post', 'photo', 'phone', 'office_number', 'address', 'status', 'author', 'in_order'];

    //Статус
    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVE = 'deactive';

    //Статуси
    public static $statuses = [
        self::STATUS_ACTIVE => [
            'name'  => 'Увімкнено',
            'class' => 'success',
        ],
        self::STATUS_DEACTIVE => [
            'name'  => 'Вимкнено',
            'class' => 'danger',
        ],
    ];

    public function fullName() : string {
        return $this->surname . ' ' . $this->name . ' ' . $this->byfather;
    }

    //Всі записи з статусом active
    public function scopeIsActive()
    {
        return $this->where('status', self::STATUS_ACTIVE);
    }

    //Всі записи з статусом deactive
    public function scopeIsDeactive()
    {
        return $this->where('status', self::STATUS_DEACTIVE);
    }


}
