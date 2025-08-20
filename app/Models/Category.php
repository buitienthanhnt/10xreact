<?php

namespace App\Models;

use App\Events\CategorySaved;
use App\Helper\StringHelper;
use App\Models\ShareAction\ActiveAttrModel;
use App\Models\ShareAction\FormField;
use App\Models\ShareAction\ImageManualAttr;
use App\Models\Types\CategoryInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model implements CategoryInterface
{
    use HasFactory;
    use SoftDeletes;

    use ActiveAttrModel;
    use FormField;
    use ImageManualAttr;

    protected $dispatchesEvents = [
        'saved' => CategorySaved::class
    ];

    /**
     * thuộc tính cần cho: FormField trait để lấy form update field.
     */
    protected $formFields = self::FORM_FIELDS;

    /**
     * 
     */
    protected static function booted()
    {
        /**
         * define action after delete category
         * delete folder of category image path.
         */
        static::deleted(function (Category $category): void {
            /**
             * if null skip
             */
            if (!$category->{self::IMAGE_PATH}) {
                return;
            }
            /**
             * get path folder and delete it by Storage.
             */
            $dirPathCategory = 'categories/' . $category->id;
            Storage::deleteDirectory($dirPathCategory);
        });
    }

    /**
     * function return options value for select option field
     * the function must be static function because in interface form field define can not define model object.
     * @return array ['label' => string, 'value' => number][]
     */
    public static function parentOptions(): array
    {
        return [
            ['label' => 'phim', 'value' => 1],
            ['label' => 'audio', 'value' => 3]
        ];
    }

    public function alias(): Attribute
    {
        return Attribute::make(set: function (string $input) {
            return Str::snake(StringHelper::vn_to_str($input, true), '-');
        });
    }

    public function parent(): Attribute
    {
        return Attribute::make(set: function (int|null $input) {
            return is_numeric($input) ? $input : 0;
        });
    }
}

// php artisan make:model category.

// INFO  Model [app/Models/Category.php] created successfully.  

// INFO  Factory [database/factories/CategoryFactory.php] created successfully.  

// INFO  Migration [database/migrations/2025_08_19_150247_create_categories_table.php] created successfully.  

// INFO  Seeder [database/seeders/CategorySeeder.php] created successfully.  

// INFO  Request [app/Http/Requests/StoreCategoryRequest.php] created successfully.  

// INFO  Request [app/Http/Requests/UpdateCategoryRequest.php] created successfully.  

// INFO  Controller [app/Http/Controllers/CategoryController.php] created successfully.  

// INFO  Policy [app/Policies/CategoryPolicy.php] created successfully.