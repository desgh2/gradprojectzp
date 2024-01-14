<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = ['title', 'description', 'name', 'heading', 'slug', 'text', 'poster', 'gallery', 'status', 'author'];

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

    //автор категорії
    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
