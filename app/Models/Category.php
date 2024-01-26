<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['parent', 'title', 'description', 'name', 'heading', 'slug', 'text', 'status', 'author', 'primary_menu', 'footer_menu', 'in_order'];

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

    //головне меню сайта
    public static function getPrimaryMenu()
    {
        return self::whereNull('parent')
            ->where('primary_menu', TRUE)
            ->orderBy('in_order', 'asc')
            ->get();
    }

    //футер меню сайта
    public static function getFooterMenu()
    {
        return self::whereNull('parent')
            ->where('footer_menu', TRUE)
            ->get();
    }

    //батьківські категорії
    public static function getParentCategories() {
        return self::whereNull('parent')->get();
    }

    //батьківська категорія
    public function category()
    {
        return $this->belongsTo(Category::class, 'parent', 'id');
    }

    //дочірня категорія
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    //дочірня категорія
    public function related()
    {
        return Category::where('parent', '=', $this->parent)->where('status', 'active')->get();
    }

    //автор категорії
    public function user() {
        return $this->belongsTo(User::class, 'author', 'id');
    }


}
