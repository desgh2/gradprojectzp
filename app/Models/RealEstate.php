<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    protected $table = 'real_estate';

    protected $fillable = ['title', 'description', 'name', 'heading', 'slug', 'district_id', 'place_id', 'lat', 'lon', 'text', 'poster', 'gallery', 'pasport', 'status', 'author'];

    //Статус
    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVE = 'deactive';

    //Райони
    public static $districts = [
        ['id' => 1, 'name' => 'Хортицький район'],
        ['id' => 2, 'name' => 'Дніпровський район'],
        ['id' => 3, 'name' => 'Олександрівський район'],
        ['id' => 4, 'name' => 'Вознесенівський район'],
        ['id' => 5, 'name' => 'Комунарський район'],
        ['id' => 6, 'name' => 'Шевченківський район'],
        ['id' => 7, 'name' => 'Заводський район'],
    ];

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

    //Назва района
    public function district()
    {
        return array_search($this->district_id, array_column(self::$districts, 'id', 'name'));
    }

	//автор запису
    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
