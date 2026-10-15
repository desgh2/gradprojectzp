<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    protected $fillable = ['person_id', 'name', 'description', 'heading', 'slug', 'cabinet', 'phone', 'telephone', 'email', 'text', 'icon', 'status', 'author'];

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

    //Керівник відділу
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    //Проєкти відділу
    public function projects()
    {
        return $this->hasMany(Project::class, 'department_id', 'id');
    }

    //Автор проєкту
    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
